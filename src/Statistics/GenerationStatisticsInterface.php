<?php
declare(strict_types=1);

namespace Statistics;

use Genetic\GenerationInterface;

/**
 * Interface GenerationStatisticsInterface
 *
 * Holds and computes the generation related statistics for the entire simulation run.
 *
 * The statistics contain:
 *  - best individuals records (fitness, generation number, genotype) sorted chronologically
 *
 * @package Statistics
 */
interface GenerationStatisticsInterface
{
    /**
     * Updates the statistics of the simulation run
     *
     * @param GenerationInterface $generation
     *
     * @return void
     */
    public function updateStatistics(GenerationInterface $generation): void;

    /**
     * @return string
     */
    public function getStatistics(): string;
}
