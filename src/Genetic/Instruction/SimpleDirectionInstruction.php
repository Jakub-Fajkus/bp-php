<?php
declare(strict_types=1);

namespace Genetic\Instruction;

/**
 * Class SimpleDirectionInstruction
 * @package Genetic\Instruction
 */
class SimpleDirectionInstruction extends SimpleInstruction
{
    public function __construct(string $motorId, int $motorValue)
    {
        $motorValue = $this->normalizeValue($motorValue);

        parent::__construct($motorId, $motorValue);
    }

    /**
     * @param MotorValue $motorValue
     *
     * @return string
     */
    protected function serializeMotorValue(MotorValue $motorValue): string
    {
        //because the value is -1, 0, 1 and the simulator has range from -5 through 0 to 5, we will multiply it by 5
//        $motorValue->setValue($motorValue->getValue() * 5);
        $normalized = $this->normalizeValue($motorValue->getValue());
        $motorValue->setValue($normalized * 5);
        return parent::serializeMotorValue($motorValue);
    }

    protected function normalizeValue(int $value)
    {
        //ensure that the instruction has value of -1, 0, 1
        if ($value > 0) {
            return 1;
        } elseif ($value < 0) {
            return  -1;
        } else {
            return 0;
        }

    }
}
