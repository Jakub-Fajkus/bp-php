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
     * Evaluate the individuals
     *
     * [0]program name
     * [1] /some/dir/model.xml
     * [2] /some/dir/to/fitnesses/
     * [3] /some/dir/1
     * [4] /some/dir/2 ...
     *
     * @param IndividualInterface[] $individuals
     * @param string                $modelFilePath
     * @param string                $fitnessDir
     * @param string                $motorsDir
     */
    public function evaluate(array $individuals, string $modelFilePath, string $fitnessDir, string $motorsDir);
}
