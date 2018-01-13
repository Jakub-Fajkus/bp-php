<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\MotorDrive\TextMotorDriveSerializer;
use Simulator\Simulator;
use Statistics\IndividualStatistics;

/**
 * Class GenerationExperiment
 * @package Experiment
 */
class GenerationExperiment implements ExperimentInterface
{
    /**
     * Run the whole experiment
     */
    public function run(): void
    {
        $filesystem = new Filesystem();
        $date = new \DateTime();

        Config::setIndividualCount(40);
        Config::setMotorDriveValuesCount(20);
        Config::setMutationRate(20);
        Config::setMotorDriveMinimum(-10);
        Config::setMotorDriveMaximum(10);

        $runDir = $filesystem->createDirectory(Config::getDataDir(), $date->format(DATE_ATOM));

        $modelFile = $filesystem->createFile($runDir, 'model.xml');
        $filesystem->writeToFile($modelFile, (new FixedModelXml())->getAsString());

        $generationGenerator = new GenerationGenerator();
        $generation = $generationGenerator->generateGeneration(1, Config::getIndividualCount());

        $simulator = new Simulator(new TextMotorDriveSerializer());
        $stats = new IndividualStatistics();

        for ($i = 0; $i < 100; $i++) {
            echo "generation {$generation->getId()}" . PHP_EOL;
            $generations[] = $generation;

            $generationDir = $filesystem->createDirectory($runDir, (string)$generation->getId());
            $fitnessesDir = $filesystem->createDirectory($generationDir, 'fitnesses');
            $individualsDir = $filesystem->createDirectory($generationDir, 'individuals');

            $before = microtime(true);

            $simulator->evaluate($generation->getIndividuals(), $modelFile, $fitnessesDir, $individualsDir);

            $after = microtime(true);

            echo 'generation time: ' . ($after-$before) . 's' . PHP_EOL;

            $best = $generation->getBestIndividual();
            echo "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
            echo 'average fitness: ' . $stats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;

            echo PHP_EOL . PHP_EOL;
            $generation = $generation->createNewGeneration();
        }
    }
}
