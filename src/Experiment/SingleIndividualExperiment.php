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
//        $model = new FixedModelXml();
//        $generation = new Generation(1, []);
//
//        $individual = new Individual($generation, $model, [], 0);
//        $individual->randomizeGenotype();
//
//        $simulator = new Simulator(new TextMotorDriveSerializer());
//        $simulator->evaluate($individual);
    }
}
