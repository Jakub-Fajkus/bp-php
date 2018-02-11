<?php
declare(strict_types=1);

namespace Genetic\Instruction;
use Config\Config;

/**
 * Class ComposedInstruction
 *
 * The length of the motor values is not limited.
 * This results in situation when a particular motor has more than one value.
 *
 * @package Genetic\Instruction
 */
class ComposedInstruction extends SimpleInstruction
{
    /**
     * @var MotorValue[]
     */
    private $motorValues;

    /** @noinspection MagicMethodsValidityInspection */
    /**
     * ComposedInstruction constructor.
     *
     * @param string|null $motorId
     * @param int|null $motorValue
     */
    public function __construct(string $motorId = null, int $motorValue = null)
    {
        //keep the functionality of the parent
        if ($motorId !== null && $motorValue !== null) {
            $this->motorValues[] = new MotorValue($motorId, $motorValue);
        }
    }


    /**
     * Create a instruction with given motor values.
     *
     * The motor values are copied to the new instance which is returned.
     *
     * @param MotorValue[] $motorValues
     *
     * @return ComposedInstruction
     */
    public static function createWithValues(array $motorValues): self
    {
        $instruction = new self();

        foreach ($motorValues as $motorValue) {
            $instruction->motorValues[] = new MotorValue($motorValue->getId(), $motorValue->getValue());
        }

        return $instruction;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        $random = random_int(0, 99);
        $randomIndex = random_int(0, \count($this->motorValues)-1);

        //remove motor value
        if ($random < 5) {
            if (\count($this->motorValues) > 1) {
                unset($this->motorValues[$randomIndex]);
                //reindex the array as we are depending on the indicies
                $this->motorValues = array_values($this->motorValues);
            }

            //add motor value
        } elseif ($random < 10) {
            $this->motorValues[] = new MotorValue(Config::getRandomMotorId(), Config::getRandomMotorValue());
        //change motor value
        } else {
            $this->mutateMotorValue($this->motorValues[$randomIndex]);
        }
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
        $result = '';

        foreach ($this->motorValues as $motorValue) {
            $result .= $this->serializeMotorValue($motorValue) . ' ';
        }

        return $result;
    }

    /**
     * Create a deep copy of the instruction
     */
    public function copy(): InstructionInterface
    {
        return self::createWithValues($this->motorValues);
    }
}
