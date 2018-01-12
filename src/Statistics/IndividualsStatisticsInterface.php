<?php
declare(strict_types=1);

namespace Statistics;

use Genetic\IndividualInterface;

/**
 * Interface IndividualsStatisticsInterface
 * @package Statistics
 */
interface IndividualsStatisticsInterface
{
    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getAverageFitness(array $individuals): float;

    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getFitnessMedian(array $individuals): float;

    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getFitnessMaximum(array $individuals): float;
}
