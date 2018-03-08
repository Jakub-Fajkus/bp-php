<?php
declare(strict_types=1);

namespace Statistics;
use Genetic\GenerationInterface;
use Genetic\IndividualInterface;

/**
 * Class AllIndividualsStatistics
 * @package Statistics
 */
class AllIndividualsStatistics implements AllIndividualsStatisticsInterface
{
    /** @var string  */
    private $output = '';

    /**
     * Updates the statistics of the simulation run
     *
     * @param GenerationInterface $generation
     *
     * @return void
     */
    public function updateStatistics(GenerationInterface $generation): void
    {
        foreach ($generation->getIndividuals() as $individual) {
            $generationId = $generation->getId();
            $individualId = $individual->getId();
            $this->output .= ">$generationId.$individualId< {$individual->getFitness()}\n";
        }
    }



    /**
     * Get the statistics as a string.
     *
     * The string contains information of all individuals in format:
     * >GENERATION_NUMBER.INDIVIDUAL_NUMBER FITNESS<
     * >GENERATION_NUMBER.INDIVIDUAL_NUMBER FITNESS<
     *
     *
     * @return string
     */
    public function getStatistics(): string
    {
        return $this->output;
    }
}
