<?php
declare(strict_types=1);

namespace Experiment;
use Config\Config;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Genetic\Generator\InitializedGenerationGenerator;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class ThreeLegSpiralExperiment
 * @package Experiment
 */
class ThreeLegSpiralExperiment extends BaseExperiment
{
    /**
     * Run the whole experiment
     */
    public function run(): void
    {
//        $generationGenerator = new GenerationGenerator();
//        $simulator = new Simulator(new InstructionSerializer());
//        $individualStats = new IndividualStatistics();
//        $generationStats = new GenerationStatistics();
//        $filesystem = new Filesystem();
//        $date = new \DateTime();
//
//        Config::setIndividualCount(60);
//        Config::setMutationRate(3); //does not make sense anymore
//        Config::setCrossoverRate(0);
//        Config::setMotorCount(3);
//        Config::setGenotypeSize(20);
//        Config::setInstructionValueMinimum(-5);
//        Config::setInstructionValueMaximum(5);
//        Config::setRegisterCount(10);
//
//        $runDir = $filesystem->createDirectory(Config::getDataDir(), $date->format(DATE_ATOM));
//
//        $modelFile = $filesystem->createFile($runDir, 'model.xml');
//        $logFile = $filesystem->createFile($runDir, 'log.txt');
//        $filesystem->writeToFile($modelFile, (new FixedModelXml())->getAsString());
//
//        $generation = $generationGenerator->generateGeneration(1, Config::getIndividualCount());
//
//        $duration = 150;
//
//        for ($i = 0; $i < 500; $i++) {
//            $output = '';
//            $generationStart = microtime(true);
//
//            $output .= "generation {$generation->getId()} with duration $duration" . PHP_EOL;
//
//            $generationDir = $filesystem->createDirectory($runDir, (string)$generation->getId());
//
//            $beforeSim = microtime(true);
//
//            $simulator->evaluate($generation->getIndividuals(), $modelFile, $generationDir, $duration);
//
//            $afterSim = microtime(true);
//
//            $output .= 'generation time: ' . ($afterSim-$beforeSim) . 's' . PHP_EOL;
//
//            $best = $generation->getBestIndividual();
//            $output .= "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
//            $output .= 'average fitness: ' . $individualStats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;
//
//            $generationStats->updateStatistics($generation);
//
//            $generation = $generation->createNewGeneration();
//            $generationEnd = microtime(true);
//
//            $output .= 'php time: ' . (($generationStart-$generationEnd) - ($beforeSim - $afterSim)) . 's' . PHP_EOL;
//
//            $output .= PHP_EOL . PHP_EOL;
//
//            echo $output;
//            file_put_contents($logFile, $output, FILE_APPEND);
//        }
//
//        echo $generationStats->getStatistics();
//        file_put_contents($logFile, $generationStats->getStatistics(), FILE_APPEND);
    }
}
