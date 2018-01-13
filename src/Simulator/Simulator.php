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
     * [1] thread count
     * [2] /some/dir/model.xml
     * [3] /some/dir/to/generation
     *
     * @param IndividualInterface[] $individuals
     * @param string                $modelFilePath
     * @param string                $generationDirectory
     */
    public function evaluate(array $individuals, string $modelFilePath, string $generationDirectory): void
    {
        $filesystem = new Filesystem();

        $motorsString = '';

        for ($i = 0, $iMax = \count($individuals); $i < $iMax; $i++) {
            $motorsString .= $this->motorSerializer->serializeArray($individuals[$i]->getMotorDrives());

            if ($i !== $iMax - 1) {
                $motorsString .= '*' . PHP_EOL;
            }
        }

        $filesystem->writeToFile($generationDirectory . '/individuals.txt', $motorsString);

        shell_exec(Config::getBinDir() . "/bp_compute 4 $modelFilePath $generationDirectory");

        $content = $filesystem->readFromFile($generationDirectory . '/fitnesses.txt');
        $fitnesses = explode("\n", $content);

        if (\count($fitnesses) !== \count($individuals)) {
            throw new \Exception('The fitnesses count is not the same as the individuals!');
        }

        for ($i = 0, $iMax = \count($individuals); $i < $iMax; $i++) {
            $individuals[$i]->setFitness((double)$fitnesses[$i]);
        }
    }
}
