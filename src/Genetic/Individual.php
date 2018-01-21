<?php
declare(strict_types=1);

namespace Genetic;

use Config\Config;
use Genetic\Instruction\InstructionFactory;
use Genetic\Instruction\InstructionInterface;

/**
 * Class Individual
 * @package Genetic
 */
class Individual implements IndividualInterface
{
    /** @var GenerationInterface */
    private $generation;

    /** @var InstructionInterface */
    private $genotype;

    /** @var float */
    private $fitness;

    /** @var int */
    private $id;

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
        //check if the genotype is of correct size
        if (\count($this->genotype) % Config::getGenotypeSize() !== 0) {
            throw new \Exception('The genotype has incorrect size!: ' . \count($this->genotype));
        }

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
        //todo: 2 point!!!!!!!!!!!!!!!!!!!!
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
     * @return int[]
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
        if ($forced || random_int(0, 99) < Config::getMutationRate()) {
            //randomly choose the mutated gene
            $mutatingIndex = random_int(0, \count($this->genotype) - 1);
            $mutating = $this->genotype[$mutatingIndex];

            //mutate the instruction
            $mutating->mutate();
        }
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
     */
    public function randomizeGenotype(): void
    {
        $factory = new InstructionFactory();
        $this->genotype = [];

        for ($i = 0; $i < Config::getGenotypeSize(); $i++) {
            $this->genotype[] = $factory->createRandomInstruction();
        }
    }
}
