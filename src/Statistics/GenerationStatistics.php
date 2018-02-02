<?php
declare(strict_types=1);

namespace Statistics;

use Genetic\GenerationInterface;
use Genetic\IndividualInterface;
use Simulator\Serializer\Instruction\InstructionSerializer;

/**
 * Class GenerationStatistics
 * @package Statistics
 */
class GenerationStatistics implements GenerationStatisticsInterface
{
    /** @var IndividualInterface[] */
    private $bestIndividuals = [];

    /**
     * Updates the statistics of the simulation run
     *
     * @param GenerationInterface $generation
     *
     * @return void
     */
    public function updateStatistics(GenerationInterface $generation): void
    {
        $generationBest = $generation->getBestIndividual();
        $generationId = $generation->getId();

        //if there is no individuals logged
        if (empty($this->bestIndividuals)) {
            //simply copy it to the array
            $this->bestIndividuals[$generationId] = $generationBest->copy();
        } else {
            $bestLogged = end($this->bestIndividuals);

            //if the best individual from the generation is better than the last logged one
            if ($generationBest->getFitness() > $bestLogged->getFitness()) {
                //copy the individual to the array
                $this->bestIndividuals[$generationId] = $generationBest->copy();
            }
        }
    }

    /**
     * @return string
     */
    public function getStatistics(): string
    {
        $serializer = new InstructionSerializer();

        $result = '';
        foreach ($this->bestIndividuals as $generationId => $bestIndividual) {
            $individualId = $bestIndividual->getId();
            $fitness = $bestIndividual->getFitness();
            $result .= "Best of generation #$generationId individual #$individualId with fitness $fitness, genome:\n";

            $result .= $serializer->serializeInstructions($bestIndividual->getInstructions());
            $result .= PHP_EOL . PHP_EOL;
        }

        return $result;
    }
}
