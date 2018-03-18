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
 * Class ThreeLegLinearExperiment1000Individuals7TournamentSS
 * @package Experiment
 */
class ThreeLegLinearExperiment1000Individuals7TournamentSS extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(0);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6*Config::getMotorCount()); //bulharska konstanta
        Config::setInstructionValueMinimum(-5);
        Config::setInstructionValueMaximum(5);
        Config::$tournamentSize=7;
        Config::$simulationDuration = 130;
        Config::$generationCount=120;
    }
}
