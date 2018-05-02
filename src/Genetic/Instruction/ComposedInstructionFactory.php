<?php
declare(strict_types=1);

namespace Genetic\Instruction;

use Config\Config;

/**
 * Class ComposedInstructionFactory
 * @package Genetic\Instruction
 */
class ComposedInstructionFactory implements InstructionFactoryInterface
{
    /**
     * Create a instruction with given motor values.
     *
     * The motor values are copied to the new instance which is returned.
     *
     * @param MotorValue[] $motorValues
     *
     * @return ComposedInstruction
     */
    public function createWithValues(array $motorValues): ComposedInstruction
    {
        return ComposedInstruction::createWithValues($motorValues);
    }

    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(int $index): InstructionInterface
    {

        $valueCount = random_int(1, 3);
        $values = [];

        for ($i = 0; $i < $valueCount; $i++) {
            $values[] = new MotorValue(Config::getRandomMotorId(), Config::getRandomDestinationIndex());
        }

        return ComposedInstruction::createWithValues($values);
    }
}
