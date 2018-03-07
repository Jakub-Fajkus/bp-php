<?php
declare(strict_types=1);

namespace Genetic;

use Config\Config;
use Genetic\Instruction\InstructionFactoryInterface;
use Genetic\Instruction\LGP\LGPInstructionFactory;
use Genetic\Instruction\SimpleInstructionFactory;
use Genetic\Instruction\InstructionInterface;

/**
 * Class Individual
 * @package Genetic
 */
class Individual implements IndividualInterface
{
    /** @var GenerationInterface */
    private $generation;

    /** @var InstructionInterface[] */
    private $genotype;

    /** @var float */
    private $fitness;

    /** @var int */
    private $id;

    /** @var bool */
    private $evaluated = false;

    /**
     * Individual constructor.
     *
     * @param GenerationInterface    $generation
     * @param InstructionInterface[] $genotype
     * @param int                    $id
     * @param float                  $fitness
     */
    public function __construct(
        GenerationInterface $generation,
        array $genotype,
        int $id,
        float $fitness = 0
    ) {
        $this->generation = $generation;
        $this->genotype = $genotype;
        $this->fitness = $fitness;
        $this->id = $id;
    }

    /**
     * Get the motor instructions
     *
     * @return InstructionInterface[]
     */
    public function getInstructions(): array
    {
        return $this->genotype;
    }

    /**
     * Perform the one point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @param int|null            $crossoverPoint
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     * @throws \Exception
     */
    public function onePointCrossover(IndividualInterface $individual, ?int $crossoverPoint = null): array
    {
        if ($crossoverPoint === null) {
            $crossoverPoint = random_int(0, \count($this->genotype));
        }

        $thisA = \array_slice($this->genotype, 0, $crossoverPoint);//from start to the crossover point
        $thisB = \array_slice($this->genotype, $crossoverPoint);//from the crossover point to the end
        $otherA = \array_slice($individual->getGenotype(), 0, $crossoverPoint);//from start to the crossover point
        $otherB = \array_slice($individual->getGenotype(), $crossoverPoint);//from the crossover point to the end

        $individualFactory = new IndividualFactory();

        $individuals = [
            $individualFactory->createIndividual($this->generation, \array_merge($thisA, $otherB)),
            $individualFactory->createIndividual($this->generation, \array_merge($otherA, $thisB)),
        ];

        return $individuals;
    }

    /**
     * Perform the two point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     */
    public function twoPointCrossover(IndividualInterface $individual): array
    {
        $point1 = random_int(1, \count($this->genotype)-2);
        $point2 = random_int(1, \count($this->genotype)-2);

        $a = [];
        $b = [];

        $start = min($point1, $point2);
        $end = max($point1, $point2);

        for ($i = 0; $i < \count($this->genotype); $i++) {
            if ($i <= $start || $i >= $end) {
                $a[] = $this->genotype[$i];
                $b[] = $individual->getGenotype()[$i];
            } elseif ($i < $end) {
                $a[] = $individual->getGenotype()[$i];
                $b[] = $this->genotype[$i];
            } else {
                throw new \InvalidArgumentException('unknow index in 2po cross');
            }
        }

        $individualFactory = new IndividualFactory();

        $individuals = [
            $individualFactory->createIndividual($this->generation, $a),
            $individualFactory->createIndividual($this->generation, $b),
        ];

        return $individuals;
    }

    /**
     * @param IndividualInterface $individual
     * @return array
     */
    public function uniformCrossover(IndividualInterface $individual): array
    {
        $a = [];
        $b = [];

        for ($i = 0; $i < \count($this->genotype); $i++) {
            if (random_int(0, 1) == 0) {
                $a[$i] = $this->genotype[$i];
                $b[$i] = $individual->getGenotype()[$i];
            } else {
                $a[$i] = $individual->getGenotype()[$i];
                $b[$i] = $this->genotype[$i];
            }
        }

        $individualFactory = new IndividualFactory();

        $individuals = [
            $individualFactory->createIndividual($this->generation, $a),
            $individualFactory->createIndividual($this->generation, $b),
        ];

        return $individuals;
    }

    /**
     * @return InstructionInterface[]
     */
    public function getGenotype(): array
    {
        return $this->genotype;
    }

    /**
     * Perform a mutation
     *
     * @param bool $forced
     *
     * @throws \Exception
     */
    public function mutate(bool $forced = false): void
    {
        //mutate a random gene
        $mutationIndex = random_int(0, \count($this->genotype)-1);

        $this->genotype[$mutationIndex]->mutate();

//        tood: az bude vice instrukci, pouzit toto!
        /*
         *  //mutate a random gene
        $mutationIndex = random_int(0, \count($this->genotype)-1);

        $random = random_int(0, 99);

        //29% to change instruction type, 80% to change the parameters
        if ($random < 10) {
            $factory = new LGPInstructionFactory();
            $this->genotype[$mutationIndex] = $factory->createRandomInstruction($mutationIndex);

        } else {
            $this->genotype[$mutationIndex]->mutate();
        }
         */
    }

    /**
     * @return float
     */
    public function getFitness(): float
    {
        return $this->fitness;
    }

    /**
     * @param float $fitness
     */
    public function setFitness(float $fitness): void
    {
        $this->fitness = $fitness;
        $this->evaluated = true;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Generate random genotype
     *
     * @param InstructionFactoryInterface $factory
     */
    public function randomizeGenotype(InstructionFactoryInterface $factory): void
    {
        $this->genotype = [];

        for ($i = 0; $i < Config::getGenotypeSize(); $i++) {
            $this->genotype[] = $factory->createRandomInstruction($i);
        }
    }

    /**
     * @return GenerationInterface
     */
    public function getGeneration(): GenerationInterface
    {
        return $this->generation;
    }

    /**
     * Create a deep copy of the individual
     *
     * @return IndividualInterface
     */
    public function copy(): IndividualInterface
    {
        $genotype = [];

        foreach ($this->genotype as $gene) {
            $genotype[] = $gene->copy();
        }

        $newOne = new Individual($this->generation, $genotype, $this->id);
        $newOne->evaluated = $this->evaluated;
        $newOne->fitness = $this->fitness;

        return $newOne;
    }

    /**
     * Return true, if the individual was not evaluated
     * Return false, if the individual was already evaluated
     *
     * @return bool
     */
    public function needsEvaluation(): bool
    {
        return !$this->evaluated;
    }

    /**
     * Mark the individual to be evaluated
     */
    public function setNeedsEvaluation(): void
    {
        $this->evaluated = false;
    }
}
