<?php
declare(strict_types=1);

namespace Genetic;

/**
 * Interface GenerationInterface
 * @package Genetic
 */
interface GenerationInterface
{
    /**
     * Get id of the generation
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Get all individuals of the generation
     *
     * @return IndividualInterface[]
     */
    public function getIndividuals(): array;

    /**
     * Add the individual
     *
     * @param IndividualInterface $individual
     */
    public function addIndividual(IndividualInterface $individual): void;

    /**
     * Get the best individual
     *
     * @return IndividualInterface
     */
    public function getBestIndividual(): IndividualInterface;

    /**
     * Create a new generation based on the current one using selection
     *
     * @return GenerationInterface
     */
    public function createNewGeneration(): GenerationInterface;

    /**
     * Resets the id of all individuals
     */
    public function resetIndividualsId(): void;
}
