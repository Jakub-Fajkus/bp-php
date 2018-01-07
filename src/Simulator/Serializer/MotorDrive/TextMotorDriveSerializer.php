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
     * Serializes the drive data to format, which is suitable for the simulator
     *
     * @param MotorDriveInterface $drive
     *
     * @return string
     */
    public function serialize(MotorDriveInterface $drive): string
    {
        return \implode(',', $drive->getAsArray());
    }
}
