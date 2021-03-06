<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;

/**
 * Class AddcInstruction
 * @package Genetic\Instruction\LGP
 */
class AddcInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $value;

    /**
     * AddcInstruction constructor.
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
     * @return AddcInstruction
     */
    public function setRegister(int $register): AddcInstruction
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
     * @return AddcInstruction
     */
    public function setValue(int $value): AddcInstruction
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
            $this->register = Config::getRandomSourceRegisterIndex();
        } else {
            //mutate value
            $this->value = Config::getRandomDestinationIndex();
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
        return "ADDC {$this->register} {$this->value}";
    }
}
