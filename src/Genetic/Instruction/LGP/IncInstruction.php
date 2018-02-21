<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;


use Config\Config;

/**
 * Class IncInstruction
 * @package Genetic\Instruction\LGP
 */
class IncInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $value;

    /**
     * IncInstruction constructor.
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
     * @return IncInstruction
     */
    public function setRegister(int $register): IncInstruction
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
     * @return IncInstruction
     */
    public function setValue(int $value): IncInstruction
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        $random = random_int(0, 99);

        if ($random < Config::getMutationRate()) {
            if (random_int(0, 1) === 0) {
                //mutate register
                $this->register = Config::getRandomRegisterIndex();
            } else {
                //mutate value
                $this->value = Config::getRandomMotorValue();
            }
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
        return "INC {$this->register} {$this->value}";
    }
}
