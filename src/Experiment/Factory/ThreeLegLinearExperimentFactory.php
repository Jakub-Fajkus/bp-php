<?php
declare(strict_types=1);

namespace Experiment\Factory;

use Experiment\ExperimentInterface;
use Experiment\ThreeLegLinearExperiment;
use Experiment\ThreeLegSpiralExperiment;
use Filesystem\Filesystem;
use Genetic\Generator\SteadyStateGenerationGenerator;
use Simulator\Model\ThreeLegLinearModelXml;
use Simulator\Model\ThreeLegSpiralModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\AllIndividualsStatistics;
use Statistics\CacheStatistics;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class ThreeLegLinearExperimentFactory
 * @package Experiment\Factory
 */
class ThreeLegLinearExperimentFactory
{
    public function createThreeLegLinearExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'compute_ThreeLegLinearExperiment';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            new ThreeLegLinearModelXml(),
            $executableName
        );

        return $experiment;
    }


    public function createThreeLegSpiralExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'compute_ThreeLegSpiralExperiment';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegSpiralExperiment(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            new ThreeLegSpiralModelXml(),
            $executableName
        );

        return $experiment;
    }
}
