<?php
declare(strict_types=1);

namespace Simulator\Serializer\MotorDrive;

use Simulator\Model\MotorDriveInterface;

/**
 * Interface MotorDriveSerializerInterface
 * @package ${NAMESPACE}
 */
interface MotorDriveSerializerInterface
{
    /**
     * Serializes the drive data to format, which is suitable for the simulator
     *
     * @param MotorDriveInterface $drive
     *
     * @return string
     */
    public function serialize(MotorDriveInterface $drive): string;

    /**
     * @param MotorDriveInterface[] $drives
     *
     * @return string
     */
    public function serializeArray(array $drives): string;
}
