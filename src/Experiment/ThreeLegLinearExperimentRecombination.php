<?php
declare(strict_types=1);

namespace Experiment;

use Cache\IndividualCacheFacade;
use Config\Config;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\CacheStatistics;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class ThreeLegLinearExperimentRecombination
 * @package Experiment
 */
class ThreeLegLinearExperimentRecombination extends BaseExperiment
{
    /**
     * Run the whole experiment
     */
    public function run(): void
    {
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_60_jedincu_s_rekombinaci'; //bez pocatecniho lomitka!
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();
        $date = new \DateTime();

        Config::setIndividualCount(60);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(90);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6*Config::getMotorCount()); //bulharska konstanta
        Config::setInstructionValueMinimum(-5);
        Config::setInstructionValueMaximum(5);
        Config::setRegisterCount(15);

        $executableDir = $filesystem->createDirectory(Config::getDataDir(), $executableName);
        $runDir = $filesystem->createDirectory($executableDir, $date->format(DATE_ATOM));

        $modelFile = $filesystem->createFile($runDir, 'model.xml');
        $logFile = $filesystem->createFile($runDir, 'log.txt');
        $cacheFile = $filesystem->createFile($executableDir, 'cache.txt');
        $filesystem->writeToFile($modelFile, (new FixedModelXml())->getAsString());

        IndividualCacheFacade::loadFromFile($cacheFile);

        $generation = $generationGenerator->generateGeneration(1, Config::getIndividualCount());

        $duration = 150;

        for ($i = 0; $i < 1000; $i++) {
            $output = '';
            $generationStart = microtime(true);

            $output .= "generation {$generation->getId()} with duration $duration" . PHP_EOL;

            $generationDir = $filesystem->createDirectory($runDir, (string)$generation->getId());

            $beforeSim = microtime(true);

            $simulator->evaluate($generation->getIndividuals(), $modelFile, $generationDir, $duration);

            $afterSim = microtime(true);

            $output .= 'generation time: ' . ($afterSim - $beforeSim) . 's' . PHP_EOL;

            $best = $generation->getBestIndividual();
            $output .= "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
            $output .= 'average fitness: ' . $individualStats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;

            $generationStats->updateStatistics($generation);

            $generation = $generation->createNewGeneration();
            $generationEnd = microtime(true);

            $output .= 'php time: ' . (($generationStart - $generationEnd) - ($beforeSim - $afterSim)) . 's' . PHP_EOL;

            $output .= PHP_EOL . PHP_EOL;

            echo $output;
            file_put_contents($logFile, $output, FILE_APPEND);

//            //make a backup of the cache as it is very valuable
//            if ($i % 50 === 0) {
//                IndividualCacheFacade::saveToFile($cacheFile);
//            }
        }

        $output .= $generationStats->getStatistics();
        $output .= $cacheStats->getStatistics();

        echo $output;

//        IndividualCacheFacade::saveToFile($cacheFile);

        file_put_contents($logFile, $generationStats->getStatistics(), FILE_APPEND);
    }
}
