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
     * [2] /some/dir/to/generation
     *
     * @param IndividualInterface[] $individuals
     * @param string                $modelFilePath
     * @param string                $generationDirectory
     */
    public function evaluate(array $individuals, string $modelFilePath, string $generationDirectory): void;
}
