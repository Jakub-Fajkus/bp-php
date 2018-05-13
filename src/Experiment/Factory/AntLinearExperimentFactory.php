<?php
declare(strict_types=1);

namespace Experiment\Factory;

use Experiment\Ant\AntLinearExperiment;
use Experiment\Ant\AntSpiralExperiment;
use Experiment\ExperimentInterface;
use Filesystem\Filesystem;
use Genetic\Generator\SteadyStateGenerationGenerator;
use Simulator\Model\AntLinearModelXml;
use Simulator\Model\AntSpiralModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\AllIndividualsStatistics;
use Statistics\CacheStatistics;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class AntLinearExperimentFactory
 * @package Experiment\Factory
 */
class AntLinearExperimentFactory
{
    public function createAntSpiralExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'compute_AntSpiralExperiment';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new AntSpiralExperiment(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            new AntSpiralModelXml(),
            $executableName
        );

        return $experiment;
    }


    public function createAntLinearExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'compute_AntLinearExperiment';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new AntLinearExperiment(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            new AntLinearModelXml(),
            $executableName
        );

        return $experiment;
    }
}
