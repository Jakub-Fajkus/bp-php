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
 * Class ThreeLegLinearSubprogramsInputsExperiment
 * @package Experiment
 */
class ThreeLegLinearSubprogramsInputsExperiment extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(50); //bulharska konstanta
        Config::setMinimumDestinationIndex(-5);
        Config::setMaximumDestinationIndex(5);
        Config::setSourceRegisterCount(4 + Config::getMotorCount(), + 5); //4 jsou 4 vstupy, 5 jsou "introny"
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 130;
        Config::$generationCount = 300;
        COnfig::$useSubprogramUniform = true;
    }
}
