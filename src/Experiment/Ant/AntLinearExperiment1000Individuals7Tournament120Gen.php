<?php
declare(strict_types=1);

namespace Experiment\Ant;

use Cache\IndividualCacheFacade;
use Config\Config;
use Experiment\BaseExperiment;
use Filesystem\Filesystem;
use Genetic\Generator\GenerationGenerator;
use Simulator\Model\ThreeLegLinearModelXml;
use Simulator\Serializer\Instruction\InstructionSerializer;
use Simulator\Simulator;
use Statistics\CacheStatistics;
use Statistics\GenerationStatistics;
use Statistics\IndividualStatistics;

/**
 * Class AntLinearExperiment1000Individuals7Tournament120Gen
 * @package Experiment
 */
class AntLinearExperiment1000Individuals7Tournament120Gen extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(0);
        Config::setMotorCount(12);
        Config::setGenotypeSize(6*Config::getMotorCount()); //bulharska konstanta
        Config::setSourceRegisterCount(30);
        Config::setMinimumDestinationIndex(-5);
        Config::setMaximumDestinationIndex(5);
        Config::$tournamentSize=7;
        Config::$simulationDuration = 130;
        Config::$generationCount=120;
    }
}
