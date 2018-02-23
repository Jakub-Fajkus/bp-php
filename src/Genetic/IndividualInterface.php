<?php
declare(strict_types=1);

namespace Genetic;

use Genetic\Instruction\InstructionFactoryInterface;
use Genetic\Instruction\SimpleInstructionFactory;
use Genetic\Instruction\InstructionInterface;

/**
 * Interface IndividualInterface
 * @package Genetic
 */
interface IndividualInterface
{
    /**
     * Get the motor drives phenotype
     *
     * @return InstructionInterface[]
     */
    public function getInstructions(): array;

    /**
     * Perform the one point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @param int|null            $crossoverPoint
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     */
    public function onePointCrossover(IndividualInterface $individual, ?int $crossoverPoint = null): array;

    /**
     * Perform a mutation
     *
     * @param bool $forced
     */
    public function mutate(bool $forced = false): void;

    /**
     * @return InstructionInterface[]
     */
    public function getGenotype(): array;

    /**
     * Generate random genotype
     *
     * @param InstructionFactoryInterface $factory
     */
    public function randomizeGenotype(InstructionFactoryInterface $factory): void;

    /**
     * @return float
     */
    public function getFitness(): float;

    /**
     * Sets the fitness to the individual.
     *
     * Also set's the flag needsEvaluation to false
     *
     * @param float $fitness
     */
    public function setFitness(float $fitness): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return GenerationInterface
     */
    public function getGeneration(): GenerationInterface;

    /**
     * Create a deep copy of the individual
     *
     * @return IndividualInterface
     */
    public function copy(): IndividualInterface;

    /**
     * Return true, if the individual was not evaluated
     * Return false, if the individual was already evaluated
     *
     * @return bool
     */
    public function needsEvaluation(): bool;

    /**
     * Mark the individual to be evaluated
     */
    public function setNeedsEvaluation(): void;

    /**
     * @return void
     */
    public function setId(int $id): void;
}
