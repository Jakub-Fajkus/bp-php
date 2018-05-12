<?php
declare(strict_types=1);

namespace Experiment;


use Config\Config;


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
        Config::setMinimumDestinationIndex(0);
        Config::setMaximumDestinationIndex(12);
        Config::setSourceRegisterCount(Config::getMotorCount());

        Config::$initProgramLength = Config::getMotorCount();
        Config::$eventProgramLength = Config::getMotorCount();
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 600;
        Config::$generationCount = 300;
        Config::$useSubprogramUniform = true;
    }
}
