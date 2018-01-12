<?php
declare(strict_types=1);

namespace Simulator;

use Config\Config;
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
    /** @var ModelSerializerInterface */
    private $modelSerializer;

    /** @var MotorDriveSerializerInterface */
    private $motorSerializer;

    /**
     * Simulator constructor.
     *
     * @param ModelSerializerInterface $modelSerializer
     * @param MotorDriveSerializerInterface $motorSerializer
     */
    public function __construct(
        ModelSerializerInterface $modelSerializer,
        MotorDriveSerializerInterface $motorSerializer
    ) {
        $this->modelSerializer = $modelSerializer;
        $this->motorSerializer = $motorSerializer;
    }

    /**
     * Evaluate the individual and return it's fitness
     *
     * @param IndividualInterface $individual
     *
     * @return int
     */
    public function evaluate(IndividualInterface $individual): int
    {
        $modelFile = Config::getBinDir() . '/model.txt';
        $motorsFile = Config::getBinDir() . '/motors.txt';

        file_put_contents($modelFile, $this->modelSerializer->serialize($individual->getModelXMl()), FILE_NO_DEFAULT_CONTEXT);
        file_put_contents($motorsFile, $this->motorSerializer->serializeArray($individual->getMotorDrives()));

        shell_exec(Config::getBinDir() . "/bp_compute 29 $modelFile $motorsFile");

        return 1;
    }
}
