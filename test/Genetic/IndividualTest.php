<?php
declare(strict_types=1);

namespace Test\Genetic;

use Config\Config;
use Genetic\GenerationInterface;
use Genetic\Individual;
use PHPUnit\Framework\TestCase;
use Simulator\Model\ModelXmlInterface;
use Simulator\Model\MotorDriveInterface;

class IndividualTest extends TestCase
{
    public function testGetMotorDrives()
    {
        $modelMock = static::createMock(ModelXmlInterface::class);

        $motorCount = 12;
        $genotype = [];

        for ($i = 0; $i < $motorCount * Config::getMotorDriveValuesCount(); $i++) {
            $genotype[] = $i;
        }

        $generationMock = static::createMock(GenerationInterface::class);

        $individual = new Individual($generationMock, $modelMock, $genotype, 0);

        $drives = $individual->getMotorDrives();

        static::assertCount($motorCount, $drives);

        for ($i = 0; $i < $motorCount; $i++) {
            static::assertEquals('motor_' . $i, $drives[$i]->getMotorName());

            $driveArray = $drives[$i]->getAsArray();
            $testArray = \array_slice(
                $genotype,
                $i * Config::getMotorDriveValuesCount(),
                Config::getMotorDriveValuesCount()
            );

            static::assertEquals($testArray, $driveArray);
        }
    }

    public function testOnePointCrossover()
    {
        $modelMock = static::createMock(ModelXmlInterface::class);

        Config::setMotorDriveValuesCount(5);

        $generationMock = static::createMock(GenerationInterface::class);

        $individualA = new Individual($generationMock, $modelMock, [1, 2, 3, 4, 5], 0);
        $individualB = new Individual($generationMock, $modelMock, [6, 7, 8, 9, 10], 0);
        
        list($individualC, $individualD) = $individualA->onePointCrossover($individualB, 2);

        $this->assertEquals([1,2,8,9,10], $individualC->getGenotype());
        $this->assertEquals([6,7,3,4,5], $individualD->getGenotype());

        Config::setMotorDriveValuesCount(Config::DEFAULT_MOTOR_DRIVE_VALUES_COUNT);
    }

    public function testMutate()
    {
        $generationMock = static::createMock(GenerationInterface::class);
        $modelMock = static::createMock(ModelXmlInterface::class);

        $oldGenotype = [1, 2, 3, 4, 5];
        $individualA = new Individual($generationMock, $modelMock, $oldGenotype, 0);
        $individualA->mutate(true);

        self::assertNotEquals($individualA->getGenotype(), $oldGenotype);
    }
}
