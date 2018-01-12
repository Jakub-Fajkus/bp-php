<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;
use Genetic\Generation;
use Genetic\Individual;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\Model\TextModelSerializer;
use Simulator\Serializer\MotorDrive\TextMotorDriveSerializer;
use Simulator\Simulator;

/**
 * Class SingleIndividualExperiment
 * @package Experiment
 */
class SingleIndividualExperiment implements ExperimentInterface
{
    /**
     * Run the whole experiment
     */
    public function run(): void
    {
        $model = new FixedModelXml();
        $generation = new Generation();

        $genotype = [];

        for ($i = 0; $i < Config::getMotorDriveValuesCount() * 12; $i++) {
            $genotype[] = random_int(Config::getMotorDriveMinimum(), Config::getMotorDriveMaximum());
        }

        $individual = new Individual($generation, $model, $genotype, 0);

        $simulator = new Simulator(new TextModelSerializer(), new TextMotorDriveSerializer());
        $simulator->evaluate($individual);
    }
}
