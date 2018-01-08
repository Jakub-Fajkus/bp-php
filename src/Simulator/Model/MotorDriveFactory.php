<?php
declare(strict_types=1);

namespace Simulator\Model;

/**
 * Class MotorDriveFactory
 * @package Simulator\Model
 */
class MotorDriveFactory
{
    /**
     * @param string $name
     * @param int[]  $values
     *
     * @return MotorDrive
     */
    public function createMotorDrive(string $name, array $values): MotorDrive
    {
        return new MotorDrive($name, $values);
    }
}
