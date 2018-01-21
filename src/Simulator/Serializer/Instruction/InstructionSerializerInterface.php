<?php
declare(strict_types=1);

namespace Simulator\Serializer\Instruction;

use Genetic\Instruction\InstructionInterface;

/**
 * Interface InstructionSerializerInterface
 * @package Simulator\Serializer\Instruction
 */
interface InstructionSerializerInterface
{
    /**
     * Serializes the given instructions to a string
     *
     * Each instruction is on the separate line. There is not line break after the last instruction
     *
     * @param InstructionInterface[] $instructions
     *
     * @return string
     */
    public function serializeInstructions(array $instructions): string;
}
