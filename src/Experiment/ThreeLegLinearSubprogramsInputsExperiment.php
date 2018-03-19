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
        Config::setIndividualCount(10);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(50); //bulharska konstanta
        Config::setInstructionValueMinimum(-5);
        Config::setInstructionValueMaximum(5);
        Config::setRegisterCount(1 + Config::getMotorCount() + 10);
        Config::$tournamentSize = 7;
        Config::$simulationDuration = 130;
        Config::$generationCount = 300;
        COnfig::$useSubprogramUniform = true;
    }
}
