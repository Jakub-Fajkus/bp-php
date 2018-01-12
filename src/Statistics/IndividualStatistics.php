<?php
declare(strict_types=1);

namespace Statistics;

use Genetic\IndividualInterface;

/**
 * Class IndividualStatistics
 * @package Statistics
 */
class IndividualStatistics implements IndividualsStatisticsInterface
{
    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getAverageFitness(array $individuals): float
    {
        $sum = 0;

        foreach ($individuals as $individual) {
            $sum += $individual->getFitness();
        }

        return $sum / \count($individuals);
    }

    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getFitnessMedian(array $individuals): float
    {
        // TODO: Implement getFitnessMedian() method.
    }

    /**
     * @param IndividualInterface[] $individuals
     *
     * @return float
     */
    public function getFitnessMaximum(array $individuals): float
    {
        $best = $individuals[0];

        foreach ($individuals as $individual) {
            if ($individual->getFitness() > $best->getFitness()) {
                $best = $individual;
            }
        }

        $best->getFitness();
    }
}
