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
        $this->sortIndividuals($individuals);

        $count = \count($individuals);

        //je sude
        if (\count($individuals) / 2 == 0) {
            //napr. pri 60ti jedincich
            //vezmu 60/2 -1 = 29.index
            //vezmu 60/2 = 30.index
            $individualFirst = $individuals[(int)($count / 2) - 1];
            $individualSecond = $individuals[(int)($count / 2)];

            return ($individualFirst->getFitness() + $individualSecond->getFitness()) / 2;
        } else {
            //napr pri 5ti jedincich
            //vezmu 5/2 = 2. index
            return $individuals[(int)(\count($individuals) / 2)]->getFitness();
        }
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

        return $best->getFitness();
    }

    /**
     * @param IndividualInterface[] $individuals
     */
    private function sortIndividuals(array &$individuals)
    {
        //sort the indiviudals
        usort($individuals, function (IndividualInterface $a, IndividualInterface $b) {
            if ($a->getFitness() > $b->getFitness()) {
                return -1;
            } else {
                return 1;
            }
        });
    }
}
