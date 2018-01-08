<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class MotorDrive
 * @package Simulator\Model
 */
class MotorDrive implements MotorDriveInterface
{
    /** @var string */
    private $motorName;

    /** @var int[] */
    private $values;

    /**
     * MotorDrive constructor.
     *
     * @param string $motorName
     * @param int[]  $values
     */
    public function __construct(string $motorName, array $values)
    {
        $this->motorName = $motorName;
        $this->values = $values;
    }

    /**
     * Convert the motor drive to array of integers
     *
     * @return int[]
     */
    public function getAsArray(): array
    {
        return $this->values;
    }

    /**
     * Get the motor name
     *
     * @return string
     */
    public function getMotorName(): string
    {
        return $this->motorName;
    }
}
