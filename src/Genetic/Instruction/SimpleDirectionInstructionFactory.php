<?php
declare(strict_types=1);

namespace Genetic\Instruction;

use Config\Config;

/**
 * Class SimpleDirectionInstructionFactory
 * @package Genetic\Instruction
 */
class SimpleDirectionInstructionFactory implements InstructionFactoryInterface
{
    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(int $index): InstructionInterface
    {
        return new SimpleDirectionInstruction(Config::getRandomMotorId(), Config::getRandomDestinationIndex());
    }
}
