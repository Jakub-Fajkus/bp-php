<?php
declare(strict_types=1);

namespace Config;

/**
 * Class Config
 * @package Config
 */
class Config
{
    public const DEFAULT_MOTOR_DRIVE_VALUES_COUNT = 100;
    public const DEFAULT_MUTATION_RATE = 100;
    public const DEFAULT_MOTOR_DRIVE_MINIMUM = -100;
    public const DEFAULT_MOTOR_DRIVE_MAXIMUM = 100;

    private static $motorDriveValuesCount = self::DEFAULT_MOTOR_DRIVE_VALUES_COUNT;
    private static $mutationRate = self::DEFAULT_MUTATION_RATE;
    private static $motorDriveMinimum = self::DEFAULT_MOTOR_DRIVE_MINIMUM;
    private static $motorDriveMaximum = self::DEFAULT_MOTOR_DRIVE_MAXIMUM;

    /**
     * @return int
     */
    public static function getMotorDriveValuesCount(): int
    {
        return self::$motorDriveValuesCount;
    }

    /**
     * @param int $motorDriveValuesCount
     */
    public static function setMotorDriveValuesCount(int $motorDriveValuesCount): void
    {
        self::$motorDriveValuesCount = $motorDriveValuesCount;
    }

    /**
     * @return int
     */
    public static function getMutationRate(): int
    {
        return self::$mutationRate;
    }

    /**
     * @param int $mutationRate
     */
    public static function setMutationRate(int $mutationRate): void
    {
        self::$mutationRate = $mutationRate;
    }

    /**
     * @return int
     */
    public static function getMotorDriveMinimum(): int
    {
        return self::$motorDriveMinimum;
    }

    /**
     * @param int $motorDriveMinimum
     */
    public static function setMotorDriveMinimum(int $motorDriveMinimum): void
    {
        self::$motorDriveMinimum = $motorDriveMinimum;
    }

    /**
     * @return int
     */
    public static function getMotorDriveMaximum(): int
    {
        return self::$motorDriveMaximum;
    }

    /**
     * @param int $motorDriveMaximum
     */
    public static function setMotorDriveMaximum(int $motorDriveMaximum): void
    {
        self::$motorDriveMaximum = $motorDriveMaximum;
    }

    /**
     * @return string
     */
    public static function getBinDir(): string
    {
        return __DIR__ . '/../../bin';
    }
}
