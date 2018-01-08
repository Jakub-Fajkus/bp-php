<?php
declare(strict_types=1);

namespace Simulator;

use Genetic\IndividualInterface;

/**
 * Interface SimulatorInterface
 * @package Simulator
 */
interface SimulatorInterface
{
    /**
     * Evaluate the individual and return it's fitness
     *
     * @param IndividualInterface $individual
     *
     * @return int
     */
    public function evaluate(IndividualInterface $individual): int;
}
