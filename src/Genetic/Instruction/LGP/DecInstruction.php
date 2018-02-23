<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;

/**
 * Class DecInstruction
 * @package Genetic\Instruction\LGP
 */
class DecInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $value;

    /**
     * DecInstruction constructor.
     * @param int $register
     * @param int $value
     */
    public function __construct(int $register, int $value)
    {
        $this->register = $register;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getRegister(): int
    {
        return $this->register;
    }

    /**
     * @param int $register
     * @return DecInstruction
     */
    public function setRegister(int $register): DecInstruction
    {
        $this->register = $register;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return DecInstruction
     */
    public function setValue(int $value): DecInstruction
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        if (random_int(0, 1) === 0) {
            //mutate register
            $this->register = Config::getRandomRegisterIndex();
        } else {
            //mutate value
            $this->value = Config::getRandomMotorValue();
        }
    }

    /**
     * Serializes the instruction
     *
     * Returns a string, containing the instruction information. It must not contain new line characters.
     *
     * @return string
     */
    public function serialize(): string
    {
        return "DEC {$this->register} {$this->value}";
    }
}
