<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;


use Config\Config;

/**
 * Class SouInstruction
 * @package Genetic\Instruction\LGP
 */
class SouInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $output;

    /**
     * DecInstruction constructor.
     * @param int $register
     * @param int $output
     */
    public function __construct(int $register, int $output)
    {
        $this->register = $register;
        $this->output = $output;
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
    public function getOutput(): int
    {
        return $this->output;
    }

    /**
     * @param int $output
     * @return DecInstruction
     */
    public function setOutput(int $output): DecInstruction
    {
        $this->output = $output;
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
            //mutate output
            $this->output = (int)Config::getRandomMotorId();
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
        return "SOU {$this->register} {$this->output}";
    }
}
