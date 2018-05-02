<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;


/**
 * Class IfsrInstruction
 * @package Genetic\Instruction\LGP
 */
class IfsrInstruction extends LGPInstruction
{
    /** @var int */
    protected $register1;

    /** @var int */
    protected $register2;

    /** @var string */
    protected $operator;

    /**
     * IfsrInstruction constructor.
     * @param int $register1
     * @param int $register2
     * @param string $operator
     */
    public function __construct(int $register1, int $register2, string $operator)
    {
        $this->register1 = $register1;
        $this->register2 = $register2;
        $this->operator = $operator;
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
     * @return IfsrInstruction
     */
    public function setRegister1(int $register1): IfsrInstruction
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
     * @return IfsrInstruction
     */
    public function setRegister2(int $register2): IfsrInstruction
    {
        $this->register2 = $register2;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     * @return IfsrInstruction
     */
    public function setOperator(string $operator): IfsrInstruction
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Performs a mutation on the instruction
     */
    public function mutate(): void
    {
        $random = random_int(0, 2);
        if ($random === 0) {
            //mutate register
            $this->register1 = Config::getRandomSourceRegisterIndex();
        } elseif ($random === 1) {
            $this->register2 = Config::getRandomSourceRegisterIndex();
        } else {
            //mutate operator
            $operators = ['<', '>', '=='];
            $this->operator = $operators[random_int(0, 2)];
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
        return "IFSR {$this->register1} {$this->register2} {$this->operator}";
    }
}
