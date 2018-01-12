<?php
declare(strict_types=1);

namespace Experiment;

/**
 * Interface ExperimentInterface
 * @package Experiment
 */
Interface ExperimentInterface
{
    /**
     * Run the whole experiment
     */
    public function run(): void;
}
