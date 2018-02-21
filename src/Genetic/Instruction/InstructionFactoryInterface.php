<?php
declare(strict_types=1);

namespace Genetic\Instruction;

/**
 * Interface InstructionFactoryInterface
 * @package Genetic\Instruction
 */
interface InstructionFactoryInterface
{
    /**
     * Randomizes an instruction
     *
     * @param int $index Index, at which will the instruction be inserted in genotype
     * @return InstructionInterface
     */
    public function createRandomInstruction(int $index): InstructionInterface;
}
