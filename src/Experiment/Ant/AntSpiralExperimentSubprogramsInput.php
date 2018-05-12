<?php
declare(strict_types=1);

namespace Experiment\Ant;

use Config\Config;
use Experiment\BaseExperiment;

/**
 * Class AntSpiralExperimentSubprogramsInput
 * @package Experiment\Ant
 */
class AntSpiralExperimentSubprogramsInput extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(12);
        Config::setGenotypeSize(100);
        Config::setSourceRegisterCount(13);
        Config::setMinimumDestinationIndex(13);
        Config::setMaximumDestinationIndex(13 + Config::getMotorCount()-1);
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 600;
        Config::$generationCount = 300;
        COnfig::$useSubprogramUniform = true;
        Config::$initProgramLength = Config::getMotorCount();
        Config::$eventProgramLength = Config::getMotorCount();
    }
}
