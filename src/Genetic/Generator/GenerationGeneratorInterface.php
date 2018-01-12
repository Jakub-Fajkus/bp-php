<?php
declare(strict_types=1);

namespace Genetic\Generator;

use Genetic\GenerationInterface;

/**
 * Interface GenerationGeneratorInterface
 * @package Genetic\Generator
 */
interface GenerationGeneratorInterface
{
    /**
     * Create a new generation with given id and with $individualCount of individuals
     *
     * @param int $id
     * @param int $individualCount
     *
     * @return GenerationInterface
     */
    public function generateGeneration(int $id, int $individualCount): GenerationInterface;
}
