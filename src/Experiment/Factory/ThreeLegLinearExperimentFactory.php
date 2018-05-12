<?php
declare(strict_types=1);

namespace Experiment\Factory;

use Experiment\ExperimentInterface;
use Experiment\ThreeLegLinearExperiment1000Individuals2TournamentSS;
use Experiment\ThreeLegSpiralSubprogramsWithoutInputsExperiment;
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
    public function create1000IndividualsExperiment2TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_ThreeLegLinearExperiment1000Individuals2TournamentSS';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals2TournamentSS(
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


    public function createThreeLegSpiralSubprogramsWithoutInputsExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_spirala_9_referenci_vstupy_podprogramy_2_ss_v2';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegSpiralSubprogramsWithoutInputsExperiment(
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
