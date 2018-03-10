<?php
declare(strict_types=1);

namespace Experiment\Factory;

use Experiment\Ant\AntLinearExperiment1000Individuals7Tournament200Gen;
use Experiment\ExperimentInterface;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\AntLinearModelXml;
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
    public function create1000IndividualsExperiment7Tournament(): ExperimentInterface
    {
        //bez pocatecniho lomitka!
        $executableName = 'bp_compute_primka_7_referenci_mravenec_1000_jedincu_bez_rekombinace_turnaj_7_200gen';
        $generationGenerator = new GenerationGenerator();
        $simulator = new Simulator(new InstructionSerializer(), '/' . $executableName);
        $individualStats = new IndividualStatistics();
        $allIndividualStats = new AllIndividualsStatistics();
        $generationStats = new GenerationStatistics();
        $cacheStats = new CacheStatistics();
        $filesystem = new Filesystem();

        $experiment = new AntLinearExperiment1000Individuals7Tournament200Gen(
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
