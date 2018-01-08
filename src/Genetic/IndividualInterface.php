<?php
declare(strict_types=1);

namespace Genetic;

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
     * @return MotorDriveInterface[]
     */
    public function getMotorDrives(): array;

    /**
     * @return ModelXmlInterface
     */
    public function getModelXMl(): ModelXmlInterface;

    /**
     * Perform the one point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @param int|null            $crossoverPoint
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     */
    public function onePointCrossover(IndividualInterface $individual, ?int $crossoverPoint): array;

    /**
     * Perform a mutation
     *
     * @param bool $forced
     */
    public function mutate(bool $forced): void;

    /**
     * @return int[]
     */
    public function getGenotype(): array;

    /**
     * @return int
     */
    public function getFitness(): int;

    /**
     * @param int $fitness
     */
    public function setFitness(int $fitness): void;

    /**
     * @return int
     */
    public function getId(): int;
}
