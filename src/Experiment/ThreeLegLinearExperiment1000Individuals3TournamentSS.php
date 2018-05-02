<?php
declare(strict_types=1);

namespace Experiment;

use Cache\IndividualCacheFacade;
use Config\Config;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\ThreeLegLinearModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\CacheStatistics;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class ThreeLegLinearExperiment1000Individuals3TournamentSS
 * @package Experiment
 */
class ThreeLegLinearExperiment1000Individuals3TournamentSS extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(0);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6*Config::getMotorCount()); //bulharska konstanta
        Config::setMinimumDestinationIndex(-5);
        Config::setMaximumDestinationIndex(5);
        Config::$tournamentSize=3;
        Config::$simulationDuration = 130;
        Config::$generationCount=120;
    }
}
