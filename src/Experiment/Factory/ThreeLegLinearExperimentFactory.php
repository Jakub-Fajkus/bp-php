<?php
declare(strict_types=1);

namespace Experiment\Factory;
use Experiment\ExperimentInterface;
use Experiment\ThreeLegLinearExperiment1000Individuals2Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals3Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals2Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals3Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals3Tournament1Point;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
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
    public function createLinear20IndividualsExperiment()
    {

    }

    public function create1000IndividualsExperiment2Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_2';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals2Tournament(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            $executableName
        );

        return $experiment;
    }

    public function create1000IndividualsExperiment3Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_3';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals3Tournament(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            $executableName
        );

        return $experiment;
    }

    public function create60IndividualsExperiment2Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_60_jedincu_bez_rekombinace_turnaj_2';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment60Individuals2Tournament(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            $executableName
        );

        return $experiment;
    }

    public function create60IndividualsExperiment3Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_60_jedincu_bez_rekombinace_turnaj_3';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment60Individuals3Tournament(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            $executableName
        );

        return $experiment;
    }

    public function create60IndividualsExperiment3Tournament1Point(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_60_jedincu_bez_rekombinace_turnaj_3_1point';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment60Individuals3Tournament1Point(
            $generationGenerator,
            $simulator,
            $individualStats,
            $generationStats,
            $allIndividualStats,
            $cacheStats,
            $filesystem,
            $executableName
        );

        return $experiment;
    }
}
