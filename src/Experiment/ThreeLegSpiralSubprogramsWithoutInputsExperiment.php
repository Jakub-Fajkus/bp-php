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
 * Class ThreeLegSpiralSubprogramsWithoutInputsExperiment
 * @package Experiment
 */
class ThreeLegSpiralSubprogramsWithoutInputsExperiment extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(36); //bulharska konstanta + 3 + 3 subprogramy + 30 motory
        Config::setInstructionValueMinimum(-6);
        Config::setInstructionValueMaximum(6);
        Config::setRegisterCount(Config::getMotorCount());
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 600;
        Config::$generationCount = 300;
        COnfig::$useSubprogramUniform = true;
    }
}
