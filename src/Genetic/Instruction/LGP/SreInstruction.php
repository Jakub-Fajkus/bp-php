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
    protected $sourceRegister;

    /** @var int */
    protected $destinationRegister;

    /**
     * SreInstruction constructor.
     * @param int $sourceRegister
     * @param int $destinationRegister
     */
    public function __construct(int $sourceRegister, int $destinationRegister)
    {
        $this->sourceRegister = $sourceRegister;
        $this->destinationRegister = $destinationRegister;
    }


    /**
     * @return int
     */
    public function getSourceRegister(): int
    {
        return $this->sourceRegister;
    }

    /**
     * @param int $sourceRegister
     * @return SreInstruction
     */
    public function setSourceRegister(int $sourceRegister): SreInstruction
    {
        $this->sourceRegister = $sourceRegister;
        return $this;
    }

    /**
     * @return int
     */
    public function getDestinationRegister(): int
    {
        return $this->destinationRegister;
    }

    /**
     * @param int $destinationRegister
     * @return SreInstruction
     */
    public function setDestinationRegister(int $destinationRegister): SreInstruction
    {
        $this->destinationRegister = $destinationRegister;
        return $this;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        if (random_int(0, 1) === 0) {
            //mutate register
            $this->sourceRegister = Config::getRandomSourceRegisterIndex();
        } else {
            //mutate value
            $this->destinationRegister = Config::getRandomDestinationIndex();
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
        $source = $this->sourceRegister;
        $destination = $this->destinationRegister;

        return "SRE $source $destination";
    }

    protected function transformValue(int $value) {
        return $value;
    }

    protected function transformRegister(int $register)
    {
        return $register;
        $transform = [
            0 => 13,
            1 => 14,
            2 => 15,
            3 => 16,
            4 => 17,
            5 => 18,
            6 => 19,
            7 => 20,
            8 => 21,
            9 => 22,
            10 => 23,
            11 => 24,
        ];

        return $transform[$register];
    }
}
