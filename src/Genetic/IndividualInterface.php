<?php
declare(strict_types=1);

namespace Genetic;

use Genetic\Instruction\InstructionInterface;
use Simulator\Model\ModelXmlInterface;
use Simulator\Model\MotorDriveInterface;

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
     */
    public function randomizeGenotype(): void;

    /**
     * @return float
     */
    public function getFitness(): float;

    /**
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
     * @return int
     */
    public function setId(int $id): void;
}
