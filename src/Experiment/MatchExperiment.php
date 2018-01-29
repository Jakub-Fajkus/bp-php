<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;
use Genetic\Generator\GenerationGenerator;
use Simulator\MatchSimulator;
use Statistics\IndividualStatistics;

/**
 * Class MatchExperiment
 * @package Experiment
 */
class MatchExperiment implements ExperimentInterface
{
    /**
     * Run the whole experiment
     */
    public function run(): void
    {
        Config::setIndividualCount(60);
        Config::setMutationRate(2);
        Config::setCrossoverRate(90);
        Config::setMotorCount(1);
        Config::setGenotypeSize(25);
        Config::setInstructionValueMinimum(1);
        Config::setInstructionValueMaximum(5);


        $generationGenerator = new GenerationGenerator();
        $generation = $generationGenerator->generateGeneration(1, Config::getIndividualCount());

        $simulator = new MatchSimulator();
        $stats = new IndividualStatistics();

        for ($i = 0; $i < 10000; $i++) {
            echo "generation {$generation->getId()}" . PHP_EOL;

            $simulator->evaluate($generation->getIndividuals());

            $best = $generation->getBestIndividual();
            echo "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
            echo 'average fitness: ' . $stats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;

            $generation = $generation->createNewGeneration();

            echo PHP_EOL . PHP_EOL;

        }
    }
}
