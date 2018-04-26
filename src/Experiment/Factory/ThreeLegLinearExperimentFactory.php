<?php
declare(strict_types=1);

namespace Experiment\Factory;
use Experiment\ExperimentInterface;
use Experiment\ThreeLegLinearExperiment1000Individuals10Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals2Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals2TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals3Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals3TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals4Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals4TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals5Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals5TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals6Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals6TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals7Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals7Tournament200Gen;
use Experiment\ThreeLegLinearExperiment1000Individuals7TournamentSS;
use Experiment\ThreeLegLinearExperiment1000Individuals8Tournament;
use Experiment\ThreeLegLinearExperiment1000Individuals9Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals2Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals3Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals3Tournament1Point;
use Experiment\ThreeLegLinearSubprogramsInputsExperiment;
use Experiment\ThreeLegLinearSubprogramsWithoutInputsExperiment;
use Experiment\ThreeLegSpiralSubprogramsWithoutInputsExperiment;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
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
            new ThreeLegLinearModelXml(),
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
            new ThreeLegLinearModelXml(),
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
            new ThreeLegLinearModelXml(),
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
            new ThreeLegLinearModelXml(),
            $executableName
        );

        return $experiment;
    }

    public function create1000IndividualsExperiment4Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_4';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals4Tournament(
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

    public function create1000IndividualsExperiment5Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_5';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals5Tournament(
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

    public function create1000IndividualsExperiment6Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_6';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals6Tournament(
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

    public function create1000IndividualsExperiment7Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals7Tournament(
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

    public function create1000IndividualsExperiment8Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_8';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals8Tournament(
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

    public function create1000IndividualsExperiment9Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_9';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals9Tournament(
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

    public function create1000IndividualsExperiment10Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_10';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals10Tournament(
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

    public function create1000IndividualsExperiment7Tournament200Gen(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7_200gen';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals7Tournament200Gen(
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
            new ThreeLegLinearModelXml(),
            $executableName
        );

        return $experiment;
    }

    public function create1000IndividualsExperiment2TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_2_ss';
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

    public function create1000IndividualsExperiment3TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_3_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals3TournamentSS(
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

    public function create1000IndividualsExperiment4TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_4_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals4TournamentSS(
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

    public function create1000IndividualsExperiment5TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_5_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals5TournamentSS(
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

    public function create1000IndividualsExperiment6TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_6_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals6TournamentSS(
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

    public function create1000IndividualsExperiment7TournamentSS(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearExperiment1000Individuals7TournamentSS(
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

    public function createThreeLegLinearSubprogramsInputsExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_vstupy_podprogramy_bezaritmetiky_2_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearSubprogramsInputsExperiment(
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

    public function createThreeLegLinearSubprogramsWithoutInputsExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_vstupy_podprogramy_bezinputu_2_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new ThreeLegLinearSubprogramsWithoutInputsExperiment(
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
        $executableName = 'bp_compute_trojnozka_oscilatory';
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
