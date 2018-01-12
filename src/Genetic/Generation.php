<?php
declare(strict_types=1);

namespace Genetic;

/**
 * Class Generation
 * @package Genetic
 */
class Generation implements GenerationInterface
{
    /** @var int */
    private $id;

    /** @var IndividualInterface[] */
    private $individuals;

    /**
     * Generation constructor.
     *
     * @param int                   $id
     * @param IndividualInterface[] $individuals
     */
    public function __construct(int $id, array $individuals)
    {
        $this->id = $id;
        $this->individuals = $individuals;
    }

    /**
     * Get id of the generation
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get all individuals of the generation
     *
     * @return IndividualInterface[]
     */
    public function getIndividuals(): array
    {
        return $this->individuals;
    }

    /**
     * Get the best individual
     *
     * @return IndividualInterface
     */
    public function getBestIndividual(): IndividualInterface
    {
        $best = $this->individuals[0];

        foreach ($this->individuals as $individual) {
            if ($individual->getFitness() > $best->getFitness()) {
                $best = $individual;
            }
        }

        return $best;
    }

    /**
     * Create a new generation based on the current one using selection
     *
     * @return GenerationInterface
     */
    public function createNewGeneration(): GenerationInterface
    {
        //sort the indiviudals
        usort($this->individuals, function(IndividualInterface $a, IndividualInterface $b) {
            if ($a->getFitness() > $b->getFitness()) {
                return -1;
            } else {
                return 1;
            }
        });

        //select some of the best
        $selectedIndividuals = $this->performSelection();

        //create a new generation
        $newGeneration = new Generation($this->id + 1, []);
        $individualFactory = new IndividualFactory();
        $individualId = 1;

        //copy selected individuals to the new generation
        /** @var IndividualInterface $selectedIndividual */
        foreach ($selectedIndividuals as $selectedIndividual) {
            $newGeneration->individuals[] = $individualFactory->createIndividual(
                $newGeneration,
                $selectedIndividual->getModelXMl(),
                $selectedIndividual->getGenotype(),
                $individualId++
            );
        }

        //generate the rest of the individuals
        $remainingIndividualCount = \count($this->individuals) - \count($newGeneration->individuals);
        for ($i = 0; $i < $remainingIndividualCount/2; $i++) {
            //randomly choose the parents
            $parentA = $newGeneration->individuals[random_int(0, \count($newGeneration->individuals)-1)];
            $parentB = $newGeneration->individuals[random_int(0, \count($newGeneration->individuals)-1)];

            //crossover them
            $newIndividuals = $parentA->onePointCrossover($parentB);

            //add the new ones to the generation
            $newGeneration->individuals[] = $newIndividuals[0];
            $newGeneration->individuals[] = $newIndividuals[1];
        }

        $newGeneration->resetIndividualsId();

        //mutate the individuals
        foreach ($newGeneration->individuals as $individual) {
            $individual->mutate();
        }

        return $newGeneration;
    }

    /**
     * Add the individual
     *
     * @param IndividualInterface $individual
     */
    public function addIndividual(IndividualInterface $individual): void
    {
        $this->individuals[] = $individual;
    }

    /**
     * Performs the selection and returns the selected elements
     *
     * 50% elitism will do for now
     *
     * It MUST return a number which is divisible by 2
     *
     * @return IndividualInterface
     */
    private function performSelection(): array
    {
        return \array_slice($this->individuals, 0, \count($this->individuals)/2);
    }

    /**
     * Resets the id of all individuals
     */
    public function resetIndividualsId():void
    {
        $id = 1;
        foreach ($this->individuals as $individual) {
            $individual->setid($id++);
        }
    }
}
