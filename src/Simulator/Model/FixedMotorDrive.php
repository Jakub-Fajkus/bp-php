<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class FixedMotorDrive
 * @package Simulator\Model
 */
class FixedMotorDrive implements MotorDriveInterface
{
    /**
     * Convert the motor drive to array of integers
     *
     * @return int[]
     */
    public function getAsArray(): array
    {
        return [1,2,3,4,5,6,7,8,9,10];
    }
}
