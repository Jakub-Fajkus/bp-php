<?php
declare(strict_types=1);

namespace Genetic\Instruction;

use Config\Config;

/**
 * Class SimpleInstruction
 * @package Genetic\SimpleInstruction
 */
class SimpleInstruction implements InstructionInterface
{
    /**
     * @var MotorValue
     */
    private $motorValue;

    /**
     * SimpleInstruction constructor.
     *
     * @param string $motorId
     * @param int    $motorValue
     */
    public function __construct(string $motorId, int $motorValue)
    {
        $this->motorValue = new MotorValue($motorId, $motorValue);
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        $this->mutateMotorValue($this->motorValue);
    }

    /**
     * Serializes the instruction
     *
     * Returns a string, containing a set of pairs of values.
     * The string has format: M V M V
     * Where M is motor name and V is motor value
     *
     * @return string
     */
    public function serialize(): string
    {
        return $this->serializeMotorValue($this->motorValue);
    }

    /**
     * @param MotorValue $motorValue
     */
    protected function mutateMotorValue(MotorValue $motorValue): void
    {
        //mutate the motor name - 20%
        if (random_int(0, 99) < 20) {
            $motorValue->setId((string)random_int(0, Config::getMotorCount() - 1));
        } else {
            //mutate the instruction value - 80%
            $motorValue->setValue(random_int(Config::getInstructionValueMinimum(), Config::getInstructionValueMaximum()));
        }
    }

    /**
     * @param MotorValue $motorValue
     *
     * @return string
     */
    protected function serializeMotorValue(MotorValue $motorValue): string
    {
        return $motorValue->getId() . ' ' . $motorValue->getValue();
    }
}
