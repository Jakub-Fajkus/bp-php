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
     * @param string $motorName
     * @param int    $value
     *
     * @return InstructionInterface
     */
    public function createInstruction(string $motorName, int $value): InstructionInterface
    {
        return new SimpleInstruction($motorName, $value);
    }

    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(): InstructionInterface
    {
        return new SimpleInstruction(Config::getRandomMotorId(), Config::getRandomMotorValue());
    }
}
