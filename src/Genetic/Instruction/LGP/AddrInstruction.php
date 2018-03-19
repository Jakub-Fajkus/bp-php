<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;


/**
 * Class AddrInstruction
 * @package Genetic\Instruction\LGP
 */
class AddrInstruction extends LGPInstruction
{
    /**
     * @var int
     */
    protected $register1;
    /**
     * @var int
     */
    protected $register2;

    /**
     * AddrInstruction constructor.
     * @param int $register1
     * @param int $register2
     */
    public function __construct(int $register1, int $register2)
    {
        $this->register1 = $register1;
        $this->register2 = $register2;
    }

    /**
     * @return int
     */
    public function getRegister1(): int
    {
        return $this->register1;
    }

    /**
     * @param int $register1
     * @return AddrInstruction
     */
    public function setRegister1(int $register1): AddrInstruction
    {
        $this->register1 = $register1;
        return $this;
    }

    /**
     * @return int
     */
    public function getRegister2(): int
    {
        return $this->register2;
    }

    /**
     * @param int $register2
     * @return AddrInstruction
     */
    public function setRegister2(int $register2): AddrInstruction
    {
        $this->register2 = $register2;
        return $this;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        if (random_int(0, 1) === 0) {
            //mutate register
            $this->register1 = Config::getRandomRegisterIndex();
        } else {
            //mutate value
            $this->register2 = Config::getRandomRegisterIndex();
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
        return "ADDR {$this->register1} {$this->register2}";
    }
}
