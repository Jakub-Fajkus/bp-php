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
     * @param string $motorName
     * @param int    $value
     *
     * @return InstructionInterface
     */
    public function createInstruction(string $motorName, int $value): InstructionInterface
    {
        return new SimpleDirectionInstruction($motorName, $value);
    }

    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(): InstructionInterface
    {
        return new SimpleDirectionInstruction(Config::getRandomMotorId(), Config::getRandomMotorValue());
    }
}
