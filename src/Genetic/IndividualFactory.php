<?php
declare(strict_types=1);

namespace Genetic;

use Genetic\Instruction\InstructionInterface;

/**
 * Class IndividualFactory
 * @package Genetic
 */
class IndividualFactory
{
    /**
     * @var int
     */
    private $lastId = 0;

    /**
     * @param GenerationInterface    $generation
     * @param InstructionInterface[] $genotype
     * @param int|null               $id
     *
     * @return Individual
     */
    public function createIndividual(
        GenerationInterface $generation,
        array $genotype,
        ?int $id = null
    ): Individual {
        if ($id === null) {
            $id = $this->lastId++;
        }

        return new Individual($generation, $genotype, $id, 0);
    }
}
