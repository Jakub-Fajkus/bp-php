<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;
use Filesystem\FilesystemInterface;
use Genetic\Generator\GenerationGeneratorInterface;
use Simulator\Model\ModelXmlInterface;
use Simulator\SimulatorInterface;
use Statistics\AllIndividualsStatisticsInterface;
use Statistics\CacheStatistics;
use Statistics\GenerationStatisticsInterface;
use Statistics\IndividualsStatisticsInterface;

/**
 * Class BaseExperiment
 * @package Experiment
 */
abstract class BaseExperiment implements ExperimentInterface
{
    /** @var GenerationGeneratorInterface */
    protected $generationGenerator;

    /** @var SimulatorInterface */
    protected $simulator;

    /** @var IndividualsStatisticsInterface */
    protected $individualStats;

    /** @var GenerationStatisticsInterface */
    protected $generationStats;

    /** @var AllIndividualsStatisticsInterface */
    protected $allIndividualsStats;

    /** @var CacheStatistics */
    protected $cacheStats;

    /** @var FilesystemInterface */
    protected $filesystem;

    /** @var string */
    protected $executableName;

    /** @var string */
    protected $output = '';

    /** @var string */
    protected $logFile = '';

    /** @var string */
    protected $allIndividualsLogFile = '';

    /** @var ModelXmlInterface */
    protected $modelXml;

    /** @var string */
    protected $runDirectory;

    /**
     * BaseExperiment constructor.
     * @param GenerationGeneratorInterface $generationGenerator
     * @param SimulatorInterface $simulator
     * @param IndividualsStatisticsInterface $individualStats
     * @param GenerationStatisticsInterface $generationStats
     * @param AllIndividualsStatisticsInterface $allIndividualsStats
     * @param CacheStatistics $cacheStats
     * @param FilesystemInterface $filesystem
     * @param ModelXmlInterface $modelXml
     * @param string $executableName
     */
    public function __construct(
        GenerationGeneratorInterface $generationGenerator,
        SimulatorInterface $simulator,
        IndividualsStatisticsInterface $individualStats,
        GenerationStatisticsInterface $generationStats,
        AllIndividualsStatisticsInterface $allIndividualsStats,
        CacheStatistics $cacheStats,
        FilesystemInterface $filesystem,
        ModelXmlInterface $modelXml,
        string $executableName
    )
    {
        $this->generationGenerator = $generationGenerator;
        $this->simulator = $simulator;
        $this->individualStats = $individualStats;
        $this->generationStats = $generationStats;
        $this->allIndividualsStats = $allIndividualsStats;
        $this->cacheStats = $cacheStats;
        $this->filesystem = $filesystem;
        $this->executableName = $executableName;
        $this->modelXml = $modelXml;
    }

    /**
     * Run the whole experiment
     */
    public function run(): void
    {
        $this->prepare();
        $this->perform();
        $this->end();
    }

    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(0);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6 * Config::getMotorCount()); //bulharska konstanta
        Config::setMinimumDestinationIndex(-5);
        Config::setMaximumDestinationIndex(5);
        Config::setSourceRegisterCount(15);
        Config::$tournamentSize = 3;
    }

    public function perform()
    {
        $date = new \DateTime();

        $executableDir = $this->filesystem->createDirectory(Config::getDataDir(), $this->executableName);
        $this->runDirectory = $this->filesystem->createDirectory($executableDir, $date->format(DATE_ATOM));

        $modelFile = $this->filesystem->createFile($this->runDirectory, 'model.xml');
        $this->logFile = $this->filesystem->createFile($this->runDirectory, 'log.txt');
        $this->allIndividualsLogFile = $this->filesystem->createFile($this->runDirectory, 'allIndividuals.txt');
        $this->filesystem->writeToFile($modelFile, $this->modelXml->getAsString());

        $generation = $this->generationGenerator->generateGeneration(1, Config::getIndividualCount());

        $duration = Config::$simulationDuration;

        for ($i = 0; $i < Config::$generationCount; $i++) {
            $output = '';
            $generationStart = microtime(true);

            $output .= "generation {$generation->getId()} with duration $duration" . PHP_EOL;

            $generationDir = $this->filesystem->createDirectory($this->runDirectory, (string)$generation->getId());

            $beforeSim = microtime(true);

            $this->simulator->evaluate($generation->getIndividuals(), $modelFile, $generationDir, $duration);

            $afterSim = microtime(true);

            $output .= 'generation time: ' . ($afterSim - $beforeSim) . 's' . PHP_EOL;

            $best = $generation->getBestIndividual();
            $output .= "best indiv {$best->getId()} with fitness: {$best->getFitness()}" . PHP_EOL;
            $output .= 'average fitness: ' . $this->individualStats->getAverageFitness($generation->getIndividuals()) . PHP_EOL;
            $output .= 'median fitness: ' . $this->individualStats->getFitnessMedian($generation->getIndividuals()) . PHP_EOL;

            $this->generationStats->updateStatistics($generation);
            $this->allIndividualsStats->updateStatistics($generation);

            $generation = $generation->createNewGeneration();
            $generationEnd = microtime(true);

            $output .= 'php time: ' . (($generationEnd - $generationStart) - ($afterSim - $beforeSim)) . 's' . PHP_EOL;

            $output .= PHP_EOL . PHP_EOL;

            echo $output;
            file_put_contents($this->logFile, $output, FILE_APPEND);
        }
    }

    public function end()
    {
        $output = '';
        $output .= $this->generationStats->getStatistics();
        $output .= $this->cacheStats->getStatistics();

        echo $output;

        file_put_contents($this->logFile, $this->generationStats->getStatistics(), FILE_APPEND);
        file_put_contents($this->allIndividualsLogFile, $this->allIndividualsStats->getStatistics());

        shell_exec("cd $this->runDirectory && pwd && ../../../render.sh && ../../..mergeRunFitnessImages.sh");
    }
}
