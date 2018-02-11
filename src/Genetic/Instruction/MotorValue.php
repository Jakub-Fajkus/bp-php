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
     * @param string $id
     * @param int    $value
     */
    public function __construct(string $id, int $value)
    {
        $this->id = $id;
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
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
