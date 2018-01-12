<?php
declare(strict_types=1);

namespace Simulator;

use Config\Config;
use Filesystem\Filesystem;
use Genetic\IndividualInterface;
use Simulator\Serializer\Model\ModelSerializerInterface;
use Simulator\Serializer\Model\TextModelSerializer;
use Simulator\Serializer\MotorDrive\MotorDriveSerializerInterface;
use Simulator\Serializer\MotorDrive\TextMotorDriveSerializer;

/**
 * Class Simulator
 * @package Simulator
 */
class Simulator implements SimulatorInterface
{
    /** @var MotorDriveSerializerInterface */
    private $motorSerializer;

    /**
     * Simulator constructor.
     *
     * @param MotorDriveSerializerInterface $motorSerializer
     */
    public function __construct(MotorDriveSerializerInterface $motorSerializer)
    {
        $this->motorSerializer = $motorSerializer;
    }





    /**
     * Evaluate the individuals
     *
     * [0]program name
     * [1] /some/dir/to/fitnesses/
     * [2] /some/dir/model.xml
     * [3] /some/dir/1
     * [4] /some/dir/2 ...
     *
     * @param IndividualInterface[] $individuals
     * @param string                $modelFilePath
     * @param string                $fitnessDir
     * @param string                $motorsDir
     */
    public function evaluate(array $individuals, string $modelFilePath, string $fitnessDir, string $motorsDir)
    {
        $filesystem = new Filesystem();

        $motorFiles = '';
        foreach ($individuals as $individual) {
            $motorsString = $this->motorSerializer->serializeArray($individual->getMotorDrives());
            $motorFileName = $motorsDir . '/' . $individual->getId();
            file_put_contents($motorFileName, $motorsString);
            $motorFiles .= $motorFileName . ' ';
        }

        shell_exec(Config::getBinDir() . "/bp_compute 4 $fitnessDir $modelFilePath $motorFiles");

        foreach ($individuals as $individual) {
            $content = (float)$filesystem->readFromFile($fitnessDir . '/' . $individual->getId());

            $individual->setFitness($content);
        }
    }
}
