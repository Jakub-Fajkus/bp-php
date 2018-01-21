<?php
declare(strict_types=1);

namespace Genetic;

use Config\Config;

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
        //create a new generation
        $newGeneration = new Generation($this->id + 1, []);

        $individualFactory = new IndividualFactory();

        //randomize the array positions
        shuffle($this->individuals);

        $newGeneration->individuals[] = $this->getBestIndividual();

        //create the individuals for the new generation
        while(\count($newGeneration->individuals) < \count($this->individuals)) {
            //randomly choose 2 pairs of individuals
            $individual1a = $this->individuals[random_int(0, \count($this->individuals) - 1)];
            $individual1b = $this->individuals[random_int(0, \count($this->individuals) - 1)];
            $individual2a = $this->individuals[random_int(0, \count($this->individuals) - 1)];
            $individual2b = $this->individuals[random_int(0, \count($this->individuals) - 1)];

            //take the better one from each pair
            $better1 = ($individual1a->getFitness() >= $individual1b->getFitness()) ? $individual1a : $individual1b;
            $better2 = ($individual2a->getFitness() >= $individual2b->getFitness()) ? $individual2a : $individual2b;

            //either do crossover, or direct copy of the individuals
            if (random_int(0, 99) < Config::getCrossoverRate()) {
                $newOnes = $better1->onePointCrossover($better2); //todo change to 2 point!

                $newOnes[0]->mutate();
                $newOnes[1]->mutate();

                $newGeneration->individuals[] = $newOnes[0];
                $newGeneration->individuals[] = $newOnes[1];
            } else {
                //copy the first individual
                $newGeneration->individuals[] = $individualFactory->createIndividual(
                    $newGeneration,
                    $better1->getGenotype(),
                    0 //does not matter, the ids will be regenerated anyway
                );

                //copy the other one
                $newGeneration->individuals[] = $individualFactory->createIndividual(
                    $newGeneration,
                    $better2->getGenotype(),
                    0 //does not matter, the ids will be regenerated anyway
                );
            }
        }

        $newGeneration->resetIndividualsId();

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
        return \array_slice($this->individuals, 0, 10);
    }

    /**
     * Resets the id of all individuals
     */
    public function resetIndividualsId(): void
    {
        $id = 1;
        foreach ($this->individuals as $individual) {
            $individual->setid($id++);
        }
    }
}
