<?php
declare(strict_types=1);

namespace Genetic\Instruction;

use Config\Config;

/**
 * Class InstructionFactory
 * @package Genetic\SimpleInstruction
 */
class InstructionFactory
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
        $id = random_int(0, Config::getMotorCount() - 1);
        $value = random_int(Config::getInstructionValueMinimum(), Config::getInstructionValueMaximum());

        return new SimpleInstruction((string)$id, $value);
    }
}
