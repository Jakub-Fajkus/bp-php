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
     * Returns a string, containing a set of pairs of values.
     * The string has format: M V M V
     * Where M is motor name and V is motor value
     *
     * @return string
     */
    public function serialize(): string;
}
