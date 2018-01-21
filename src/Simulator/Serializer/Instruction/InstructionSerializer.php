<?php
declare(strict_types=1);

namespace Simulator\Serializer\Instruction;

use Genetic\Instruction\InstructionInterface;

/**
 * Class InstructionSerializer
 * @package Simulator\Serializer\Instruction
 */
class InstructionSerializer implements InstructionSerializerInterface
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
    public function serializeInstructions(array $instructions): string
    {
        $str = '';

        foreach ($instructions as $i => $instruction) {
            $str .= $instruction->serialize();

            //ensure that we do not add the line break after the last instruction
            if ($i !== \count($instructions) - 1) {
                $str .= PHP_EOL;
            }
        }

        return $str;
    }
}
