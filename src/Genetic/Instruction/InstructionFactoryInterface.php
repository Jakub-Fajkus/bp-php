<?php
declare(strict_types=1);

namespace Genetic\Instruction;

/**
 * Interface InstructionFactoryInterface
 * @package Genetic\Instruction
 */
interface InstructionFactoryInterface
{
    /** @param string $motorName
    * @param int    $value
    *
    * @return InstructionInterface
    */
    public function createInstruction(string $motorName, int $value): InstructionInterface;

    /**
     * Randomizes an instruction
     *
     * @return InstructionInterface
     */
    public function createRandomInstruction(): InstructionInterface;
}
