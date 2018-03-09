<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;
use Genetic\Instruction\InstructionInterface;

/**
 * Class SovInstruction
 * @package Genetic\Instruction\LGP
 */
class SovInstruction extends LGPInstruction
{
    /** @var int */
    protected $value;

    /** @var int */
    protected $output;

    /**
     * DecInstruction constructor.
     * @param int $value
     * @param int $output
     */
    public function __construct(int $value, int $output)
    {
        $this->value = $value;
        $this->output = $output;
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
            //mutate value
            $this->value = Config::getRandomMotorValue();
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
        return "SOV {$this->value} {$this->output}";
    }

    /**
     * @return InstructionInterface
     */
    public function copy(): InstructionInterface
    {
        return new self($this->value, $this->output);
    }
}
