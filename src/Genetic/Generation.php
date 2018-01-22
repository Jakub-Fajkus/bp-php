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

        //end tmp
        $matingPool = [];

        //create the mating pool
        for ($i = 0; $i < \count($this->individuals); $i++) {
            //randomly choose 2 individuals
            $individual1 = $this->individuals[random_int(0, \count($this->individuals) - 1)];
            $individual2 = $this->individuals[random_int(0, \count($this->individuals) - 1)];

            //insert the better one into the mating pool
            $matingPool[] = ($individual1->getFitness() >= $individual2->getFitness()) ? $individual1 : $individual2;
        }

        //create the individuals for the new generation
        for ($i = 0; $i < \count($matingPool) / 2; $i++) {
            //randomly choose 2 individuals
            $individual1 = $matingPool[random_int(0, \count($matingPool) - 1)];
            $individual2 = $matingPool[random_int(0, \count($matingPool) - 1)];

            //either do crossover, or direct copy of the individuals
            if (random_int(0, 99) < Config::getCrossoverRate()) {
                $newOnes = $individual1->onePointCrossover($individual2); //todo change to 2 point!

                $newGeneration->individuals[] = $newOnes[0];
                $newGeneration->individuals[] = $newOnes[1];
            } else {
                //copy the first individual
                $newGeneration->individuals[] = $individualFactory->createIndividual(
                    $newGeneration,
                    $individual1->getGenotype(),
                    0 //does not matter, the ids will be regenerated anyway
                );

                //copy the other one
                $newGeneration->individuals[] = $individualFactory->createIndividual(
                    $newGeneration,
                    $individual2->getGenotype(),
                    0 //does not matter, the ids will be regenerated anyway
                );
            }
        }

        //mutate the individuals
        foreach ($newGeneration->individuals as $individual) {
            $individual->mutate();
        }

        //reset the id's
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
