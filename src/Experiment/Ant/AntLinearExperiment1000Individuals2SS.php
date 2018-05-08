<?php
declare(strict_types=1);

namespace Experiment\Ant;

use Config\Config;
use Experiment\BaseExperiment;

/**
 * Class AntLinearExperiment1000Individuals2SS
 * @package Experiment
 */
class AntLinearExperiment1000Individuals2SS extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(400);
        Config::setMutationRate(3);
        Config::setCrossoverRate(80);
        Config::setMotorCount(12);
        Config::setGenotypeSize(6 * Config::getMotorCount()); //bulharska konstanta
        Config::setSourceRegisterCount(13);
        Config::setMinimumDestinationIndex(13);
        Config::setMaximumDestinationIndex(13 + Config::getMotorCount()-1);
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 120;
        Config::$generationCount = 200;
    }
}
