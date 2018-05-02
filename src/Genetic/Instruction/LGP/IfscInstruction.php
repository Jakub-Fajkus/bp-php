<?php
declare(strict_types=1);

namespace Genetic\Instruction\LGP;

use Config\Config;

/**
 * Class IfscInstruction
 * @package Genetic\Instruction\LGP
 */
class IfscInstruction extends LGPInstruction
{
    /** @var int */
    protected $register;

    /** @var int */
    protected $constant;

    /** @var string */
    protected $operator;

    /**
     * IfscInstruction constructor.
     * @param int $register
     * @param int $constant
     * @param string $operator
     */
    public function __construct(int $register, int $constant, string $operator)
    {
        $this->register = $register;
        $this->constant = $constant;
        $this->operator = $operator;
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
     * @return IfscInstruction
     */
    public function setRegister(int $register): IfscInstruction
    {
        $this->register = $register;
        return $this;
    }

    /**
     * @return int
     */
    public function getConstant(): int
    {
        return $this->constant;
    }

    /**
     * @param int $constant
     * @return IfscInstruction
     */
    public function setConstant(int $constant): IfscInstruction
    {
        $this->constant = $constant;
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
     * @return IfscInstruction
     */
    public function setOperator(string $operator): IfscInstruction
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
            $this->register = Config::getRandomSourceRegisterIndex();
        } elseif ($random === 1) {
            $this->constant = Config::getRandomDestinationIndex();
        } else {
            //mutate operator
            $this->operator = self::getRandomOperator();
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
        return "IFSC {$this->register} {$this->constant} {$this->operator}";
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getRandomOperator(): string
    {
        $operators = ['<', '>', '=='];
        return $operators[random_int(0, 2)];
    }
}
