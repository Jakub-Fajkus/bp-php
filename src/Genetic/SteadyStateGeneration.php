<?php
declare(strict_types=1);

namespace Genetic;

/**
 * Class SteadyStateGeneration
 * @package Genetic
 */
class SteadyStateGeneration extends Generation
{
    /**
     * Create a new generation based on the current one using selection
     *
     * @return GenerationInterface
     */
    public function createNewGeneration(): GenerationInterface
    {
        $currentGenerationIndividuals = $this->getIndividualsSorted();
        $countOfReplacedIndividuals = \count($currentGenerationIndividuals) / 2;
        $betterHalf = array_slice($currentGenerationIndividuals, 0, $countOfReplacedIndividuals);

        //create a new generation
        $newGeneration = new self($this->id + 1, []);

        $betterHalfCopied = $this->setGenerationToIndividuals($betterHalf, $newGeneration);

        /** @var IndividualInterface[] $matingPool */
        $matingPool = $this->createMatingPool(\count($currentGenerationIndividuals));

        //create the individuals for the new generation
        $newIndividuals = $this->createNewPopulation($countOfReplacedIndividuals, $matingPool);
        $newIndividuals = $this->setGenerationToIndividuals($newIndividuals, $newGeneration);

        $newGeneration->addIndividuals($betterHalfCopied);
        $newGeneration->addIndividuals($newIndividuals);

        //reset the id's
        $newGeneration->resetIndividualsId();

        return $newGeneration;
    }

    /**
     * @param IndividualInterface[] $individuals
     * @param GenerationInterface $generation
     * @return array
     */
    protected function setGenerationToIndividuals(array $individuals, GenerationInterface $generation): array
    {
        $individualsCopied = [];

        foreach ($individuals as $individual) {
            $copiedIndividual = $individual->copy();
            $copiedIndividual->setGeneration($generation);
            $individualsCopied[] = $copiedIndividual;
        }

        return $individualsCopied;
    }
}
