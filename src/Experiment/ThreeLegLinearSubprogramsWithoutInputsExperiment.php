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
 * Class ThreeLegLinearSubprogramsWithoutInputsExperiment
 * @package Experiment
 */
class ThreeLegLinearSubprogramsWithoutInputsExperiment extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(28); //bulharska konstanta
        Config::setInstructionValueMinimum(-5);
        Config::setInstructionValueMaximum(5);
        Config::setOutputRegisterCount(Config::getMotorCount());
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 130;
        Config::$generationCount = 300;
        COnfig::$useSubprogramUniform = true;
    }
}
