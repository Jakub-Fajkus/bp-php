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
     * @param int $id
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

        //end tmp
        /** @var IndividualInterface[] $matingPool */
        $matingPool = [];

        $bestIndividual = $this->getBestIndividual()->copy();
        $bestIndividualMutant = $bestIndividual->copy();
        $bestIndividualMutant->mutate();
        $newGeneration->addIndividual($bestIndividual);
        $newGeneration->addIndividual($bestIndividualMutant);

        //create the mating pool
        for ($i = 0; $i < \count($this->individuals); $i++) {
            $randomPick = [];
            //select the k individuals
            for ($j = 0; $j < Config::$tournamentSize; $j++) {
                //randomly pick a individual
                $randomPick[] = $this->individuals[random_int(0, \count($this->individuals) - 1)];
            }

            $matingPool[] = $this->getBestIndividualFromTournament($randomPick);
        }

        //create the individuals for the new generation
        for ($i = 0; $i < \count($matingPool) / 2 - 1; $i++) { //1 -> we choose the best one and insert it to the new generation, as well as it's mutant
            //randomly choose 2 individuals
            $individual1 = $matingPool[random_int(0, \count($matingPool) - 1)];
            $individual2 = $matingPool[random_int(0, \count($matingPool) - 1)];

            //either do crossover, or direct copy of the individuals
            if (random_int(0, 99) < Config::getCrossoverRate()) {
                $newOnes = $this->createNewOffsprings($individual1, $individual2, true);

                $newGeneration->individuals[] = $newOnes[0];
                $newGeneration->individuals[] = $newOnes[1];
            } else {
                $newOnes = $this->createNewOffsprings($individual1, $individual2, false);

                $newGeneration->individuals[] = $newOnes[0];
                $newGeneration->individuals[] = $newOnes[1];
            }
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
     * @return IndividualInterface[]
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
            $individual->setId($id++);
        }
    }

    public function createNewOffsprings(IndividualInterface $individual1, IndividualInterface $individual2, bool $doCrossover = true)
    {
        /** @var IndividualInterface[] $newOnes */
        $newOnes = [];
        $i = 0;

        //zajistime, aby jsme nevytvorili jiz drive vytvoreneho potomka
        do {
            if ($doCrossover) {
                if (Config::$useUniform) {
                    $offsprings = $individual1->uniformCrossover($individual2);
                } else {
                    $offsprings = $individual1->onePointCrossover($individual2);
                }
            } else {
                $offsprings[0] = $individual1->copy();
                $offsprings[1] = $individual2->copy();
            }

            $offsprings[0]->mutate();
            $offsprings[1]->mutate();

            $newOnes[] = $offsprings[0];
            $newOnes[] = $offsprings[1];
            $i++;
        } while (\count($newOnes) < 2);

        $newOnes[0]->setFitness(0);
        $newOnes[1]->setFitness(0);

        $newOnes[0]->setNeedsEvaluation();
        $newOnes[1]->setNeedsEvaluation();

        return $newOnes;
    }

    /**
     * @param IndividualInterface[] $individuals
     *
     * @return IndividualInterface
     */
    protected function getBestIndividualFromTournament(array $individuals): IndividualInterface
    {
        $best = $individuals[0];

        foreach ($individuals as $individual) {
            if ($individual->getFitness() > $best->getFitness()) {
                $best = $individual;
            }
        }

        return $best;
    }
}
