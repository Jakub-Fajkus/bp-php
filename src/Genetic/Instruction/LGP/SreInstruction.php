<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;


use Config\Config;

/**
 * Class SreInstruction
 * @package Genetic\Instruction\LGP
 */
class SreInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $value;

    /**
     * SreInstruction constructor.
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
     * @return SreInstruction
     */
    public function setRegister(int $register): SreInstruction
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
     * @return SreInstruction
     */
    public function setValue(int $value): SreInstruction
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
        $register = $this->register + 2; //todo: temporary, just hack for two input registers
        return "SRE {$register} {$this->value}";
    }
}
