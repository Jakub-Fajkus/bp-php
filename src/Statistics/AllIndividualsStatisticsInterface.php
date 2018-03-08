<?php
declare(strict_types=1);

namespace Statistics;

use Genetic\GenerationInterface;

/**
 * Interface AllIndividualsStatisticsInterface
 * @package Statistics
 */
interface AllIndividualsStatisticsInterface
{
    /**
     * Update the statistics
     *
     * @return void
     */
    public function updateStatistics(GenerationInterface $generation);

    /**
     * Get the statistics as a string.
     *
     * The string contains information of all individuals in format:
     * >GENERATION_NUMBER.INDIVIDUAL_NUMBER< FITNESS
     * >GENERATION_NUMBER.INDIVIDUAL_NUMBER< FITNESS
     *
     *
     * @return string
     */
    public function getStatistics(): string;
}
