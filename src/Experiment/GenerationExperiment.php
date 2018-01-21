<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
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
        Config::setMutationRate(4);
        Config::setCrossoverRate(90);
        Config::setMotorCount(8);
        Config::setGenotypeSize(40);

        $runDir = $filesystem->createDirectory(Config::getDataDir(), $date->format(DATE_ATOM));

        $modelFile = $filesystem->createFile($runDir, 'model.xml');
        $filesystem->writeToFile($modelFile, (new FixedModelXml())->getAsString());

        $generationGenerator = new GenerationGenerator();
        $generation = $generationGenerator->generateGeneration(1, Config::getIndividualCount());

        $simulator = new Simulator(new InstructionSerializer());
        $stats = new IndividualStatistics();

        for ($i = 0; $i < 200; $i++) {
            $generationStart = microtime(true);

            echo "generation {$generation->getId()}" . PHP_EOL;

            $generationDir = $filesystem->createDirectory($runDir, (string)$generation->getId());

            $beforeSim = microtime(true);

            $simulator->evaluate($generation->getIndividuals(), $modelFile, $generationDir);

            $afterSim = microtime(true);

            echo 'generation time: ' . ($afterSim-$beforeSim) . 's' . PHP_EOL;

            $best = $generation->getBestIndividual();
            echo "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
            echo 'average fitness: ' . $stats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;

            $generation = $generation->createNewGeneration();
            $generationEnd = microtime(true);

            echo 'php time: ' . (($generationStart-$generationEnd) - ($beforeSim - $afterSim)) . 's' . PHP_EOL;

            echo PHP_EOL . PHP_EOL;

        }
    }
}
