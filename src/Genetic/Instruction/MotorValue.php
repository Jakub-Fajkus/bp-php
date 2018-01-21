<?php
declare(strict_types=1);

namespace Genetic\Instruction;

/**
 * Class MotorValue
 * @package Genetic\SimpleInstruction
 */
class MotorValue
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $value;

    /**
     * MotorValue constructor.
     *
     * @param string $name
     * @param int    $value
     */
    public function __construct(string $name, int $value)
    {
        $this->id = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setId(string $name): void
    {
        $this->id = $name;
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
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}
