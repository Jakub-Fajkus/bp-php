<?php
declare(strict_types=1);

namespace Genetic;

use Genetic\Instruction\InstructionFactoryInterface;
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
     * @param int|null $crossoverPoint
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     */
    public function onePointCrossover(IndividualInterface $individual, ?int $crossoverPoint = null): array;

    /**
     * Perform the two point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     */
    public function twoPointCrossover(IndividualInterface $individual): array;

    /**
     * @param IndividualInterface $individual
     * @return array
     */
    public function uniformCrossover(IndividualInterface $individual): array;

    /**
     * Performs a crossover, which is similar to uniform crossover.
     * But this one operates on subprograms instead of instructions.
     *
     * @param IndividualInterface $individual
     *
     * @return IndividualInterface[]
     */
    public function subprogramUniformCrossover(IndividualInterface $individual): array;

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
     * @param GenerationInterface $generation
     */
    public function setGeneration(GenerationInterface $generation): void;

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
