<?php
declare(strict_types=1);

namespace Experiment;

use Config\Config;

/**
 * Class ThreeLegLinearExperiment1000Individuals2TournamentSS
 * @package Experiment
 */
class ThreeLegLinearExperiment1000Individuals2TournamentSS extends BaseExperiment
{
    public function prepare()
    {
        Config::setIndividualCount(1000);
        Config::setMutationRate(3); //does not make sense anymore
        Config::setCrossoverRate(80);
        Config::setMotorCount(3);
        Config::setGenotypeSize(6 * Config::getMotorCount()); //bulharska konstanta
        Config::setOutputRegisterCount(Config::getMotorCount());
        Config::setInstructionValueMinimum(13);
        Config::setInstructionValueMaximum(14);
        Config::$tournamentSize = 2;
        Config::$simulationDuration = 80;
        Config::$generationCount = 200;
    }
}
