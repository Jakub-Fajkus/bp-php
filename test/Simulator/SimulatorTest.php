<?php
declare(strict_types=1);

namespace Test\Simulator;

use Config\Config;
use Simulator\Serializer\Model\ModelSerializerInterface;
use Simulator\Serializer\MotorDrive\MotorDriveSerializerInterface;
use PHPUnit\Framework\TestCase;
use Simulator\Simulator;

class SimulatorTest extends TestCase
{
    public function testEvaluate()
    {
        $generation = static::createMock(\Genetic\GenerationInterface::class);
        $model = new \Simulator\Model\FixedModelXml();

        $individual = new \Genetic\Individual($generation, $model, array_fill(0, Config::DEFAULT_MOTOR_DRIVE_VALUES_COUNT * 12, 50), 0);

        $modelSerializer = static::createMock(ModelSerializerInterface::class);
        $modelSerializer
            ->method('serialize')
            ->with($individual->getModelXMl())
            ->willReturn('model xml');

        $motorSerializer = static::createMock(MotorDriveSerializerInterface::class);
        $motorSerializer
            ->method('serializeArray')
            ->with($individual->getMotorDrives())
            ->willReturn('motors');


        $simulator = new Simulator($modelSerializer, $motorSerializer);
//        $simulator->evaluate($individual);

        $modelFile = Config::getBinDir() . '/model.txt';
        $motorsFile = Config::getBinDir() . '/motors.txt';

        static::assertFileExists($modelFile);
        static::assertFileExists($motorsFile);

        static::assertEquals('model xml', file_get_contents($modelFile));
        static::assertEquals('motors', file_get_contents($motorsFile));

        unlink($modelFile);
        unlink($motorsFile);
    }
}
