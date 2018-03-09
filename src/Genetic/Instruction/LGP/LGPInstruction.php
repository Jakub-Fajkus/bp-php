<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;


use Genetic\Instruction\InstructionInterface;

/**
 * Class LGPInstruction
 * @package Genetic\Instruction
 */
abstract class LGPInstruction implements InstructionInterface
{
    /**
     * Create a deep copy of the instruction
     */
    public function copy(): InstructionInterface
    {
        return clone $this;
    }
}
