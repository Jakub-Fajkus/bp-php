<?php
declare(strict_types=1);

namespace Test\Simulator\Serializer\MotorDrive;

use PHPUnit\Framework\TestCase;

/**
 * Class TextMotorDriveSerializerTest
 */
class TextMotorDriveSerializerTest extends TestCase
{
    public function testItSerializesFixedMotorDrive()
    {
        $drive = new \Simulator\Model\FixedMotorDrive();

        $serializer = new \Simulator\Serializer\MotorDrive\TextMotorDriveSerializer();

        $result = $serializer->serialize($drive);

        static::assertEquals(
            $drive->getMotorName() . ' ' . implode(' ', $drive->getAsArray()),
            $result
        );
    }
}
