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
        //check if the genotype is of correct size
//        if (\count($this->genotype) % Config::getGenotypeSize() !== 0) {
//            throw new \Exception('The genotype has incorrect size!: ' . \count($this->genotype));
//        }

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
        //mutate each gene with probability P
        foreach ($this->genotype as $gene) {
            if ($forced || random_int(0, 99) < Config::getMutationRate()) {
                //mutate the instruction
                $gene->mutate();
                $this->evaluated = false;
            }
        }

        $fac = new LGPInstructionFactory();

        //5% adding instruction
        if (random_int(0, 19) == 0 && \count($this->genotype) < 50) {
            $this->genotype[] = $fac->createRandomInstruction(\count($this->genotype));
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
}
