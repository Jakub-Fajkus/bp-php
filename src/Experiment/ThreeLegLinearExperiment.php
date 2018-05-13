<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;

/**
 * Class ThreeLegLinearExperiment
 * @package Experiment
 */
class ThreeLegLinearExperiment extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6 * Config::getMotorCount()); //bulharska konstanta
        Config::setMinimumDestinationIndex(11);
        Config::setMaximumDestinationIndex(13);
        Config::setSourceRegisterCount(11);
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 80;
        Config::$generationCount = 200;
    }
}
