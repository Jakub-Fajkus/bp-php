<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Interface MotorDriveInterface
 * @package Simulator\Model
 */
interface MotorDriveInterface
{
    /**
     * Convert the motor drive to array of integers
     *
     * @return int[]
     */
    public function getAsArray(): array;

    /**
     * Get the motor name
     *
     * @return string
     */
    public function getMotorName(): string;
}
