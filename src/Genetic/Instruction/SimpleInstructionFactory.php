<?php
declare(strict_types=1);

namespace Genetic\Instruction;

use Config\Config;

/**
 * Class InstructionFactory
 * @package Genetic\Instruction
 */
class SimpleInstructionFactory implements InstructionFactoryInterface
{
    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(int $index): InstructionInterface
    {
        return new SimpleInstruction(Config::getRandomMotorId(), Config::getRandomMotorValue());
    }
}
