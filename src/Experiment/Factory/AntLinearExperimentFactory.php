<?php
declare(strict_types=1);

namespace Experiment\Factory;

use Experiment\Ant\AntLinearExperiment1000Individuals2SS;
use Experiment\Ant\AntSpiralExperimentSubprogramsInput;
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


    public function createAntSpiralSubprogramsInputsExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_spirala_9_referenci_mravenec_vstupy_podprogramy_2_ss';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new AntSpiralExperimentSubprogramsInput(
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


    public function createAntLinearInputsExperiment(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_AntLinearExperiment1000Individuals2SS';
        $generationGenerator = new SteadyStateGenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new AntLinearExperiment1000Individuals2SS(
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
