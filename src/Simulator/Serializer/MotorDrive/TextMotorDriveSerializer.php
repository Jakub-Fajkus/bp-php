<?php
declare(strict_types=1);

namespace Simulator\Serializer\MotorDrive;

use Simulator\Model\MotorDriveInterface;

/**
 * Class TextMotorDriveSerializer
 * @package Simulator\Serializer\MotorDrive
 */
class TextMotorDriveSerializer implements MotorDriveSerializerInterface
{
    /**
     * Serializes the drive data to this format:
     * MOTOR_NAME val1 val2 val3
     *
     * example:
     * motor_1 10 20 -3
     *
     *
     * @param MotorDriveInterface $drive
     *
     * @return string
     */
    public function serialize(MotorDriveInterface $drive): string
    {
        return $drive->getMotorName() . ' ' . \implode(' ', $drive->getAsArray());
    }
}
