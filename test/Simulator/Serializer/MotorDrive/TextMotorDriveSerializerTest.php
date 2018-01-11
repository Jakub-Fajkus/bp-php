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

    public function testItSerializesFixedMotorDrives()
    {
        $drive1 = new \Simulator\Model\FixedMotorDrive();
        $drive2 = new \Simulator\Model\FixedMotorDrive();

        $serializer = new \Simulator\Serializer\MotorDrive\TextMotorDriveSerializer();

        $result = $serializer->serializeArray([$drive1, $drive2]);

        $drive1Str = $drive1->getMotorName() . ' ' . implode(' ', $drive1->getAsArray());
        $drive2Str = $drive2->getMotorName() . ' ' . implode(' ', $drive2->getAsArray());
        static::assertEquals(
            $drive1Str . "\n" . $drive2Str . "\n",
            $result
        );
    }
}
