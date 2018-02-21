<?php
declare(strict_types=1);

namespace Genetic\Instruction;

/**
 * Interface InstructionInterface
 * @package Genetic\SimpleInstruction
 */
interface InstructionInterface
{
    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void;

    /**
     * Serializes the instruction
     *
     * Returns a string, containing the instruction information. It must not contain new line characters.
     *
     * @return string
     */
    public function serialize(): string;

    /**
     * Create a deep copy of the instruction
     */
    public function copy(): InstructionInterface;
}
