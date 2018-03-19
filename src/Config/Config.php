<?php
declare(strict_types=1);

namespace Config;

/**
 * Class Config
 * @package Config
 */
class Config
{
    /** @internal */
    public const DEFAULT_GENOTYPE_SIZE = 20;
    /** @internal */
    public const DEFAULT_MUTATION_RATE = 3;
    /** @internal */
    public const DEFAULT_CROSSOVER_RATE = 90;
    /** @internal */
    public const DEFAULT_INDIVIDUAL_COUNT = 100;
    /** @internal */
    public const DEFAULT_MOTOR_COUNT = 4;
    /** @internal */
    public const DEFAULT_INSTRUCTION_VALUE_MINIMUM = -5;
    /** @internal */
    public const DEFAULT_INSTRUCTION_VALUE_MAXIMUM = 5;
    /** @internal */
    public const DEFAULT_REGISTER_COUNT = 10;

    public static $useUniform = false;
    public static $useSubprogramUniform = false;
    public static $tournamentSize = 3; // 2 is minimum
    public static $simulationDuration = 130;
    public static $generationCount = 60;
    public static $initProgramLength = 10;
    public static $eventProgramLength = 10;

    private static $genotypeSize = self::DEFAULT_GENOTYPE_SIZE;
    private static $mutationRate = self::DEFAULT_MUTATION_RATE;
    private static $crossoverRate = self::DEFAULT_CROSSOVER_RATE;
    private static $individualCount = self::DEFAULT_INDIVIDUAL_COUNT;
    private static $motorCount = self::DEFAULT_MOTOR_COUNT;
    private static $instructionValueMinimum = self::DEFAULT_INSTRUCTION_VALUE_MINIMUM;
    private static $instructionValueMaximum = self::DEFAULT_INSTRUCTION_VALUE_MAXIMUM;
    private static $registerCount = self::DEFAULT_REGISTER_COUNT;

    /**
     * @return int
     */
    public static function getGenotypeSize(): int
    {
        return self::$genotypeSize;
    }

    /**
     * @param int $genotypeSize
     */
    public static function setGenotypeSize(int $genotypeSize): void
    {
        self::$genotypeSize = $genotypeSize;
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
    public static function getIndividualCount(): int
    {
        return self::$individualCount;
    }

    /**
     * @param int $individualCount
     */
    public static function setIndividualCount(int $individualCount): void
    {
        self::$individualCount = $individualCount;
    }

    /**
     * @return int
     */
    public static function getMotorCount(): int
    {
        return self::$motorCount;
    }

    /**
     * @param int $motorCount
     */
    public static function setMotorCount(int $motorCount): void
    {
        self::$motorCount = $motorCount;
    }

    /**
     * @return int
     */
    public static function getCrossoverRate(): int
    {
        return self::$crossoverRate;
    }

    /**
     * @param int $crossoverRate
     */
    public static function setCrossoverRate(int $crossoverRate): void
    {
        self::$crossoverRate = $crossoverRate;
    }

    /**
     * @return int
     */
    public static function getInstructionValueMinimum(): int
    {
        return self::$instructionValueMinimum;
    }

    /**
     * @param int $instructionValueMinimum
     */
    public static function setInstructionValueMinimum(int $instructionValueMinimum): void
    {
        self::$instructionValueMinimum = $instructionValueMinimum;
    }

    /**
     * @return int
     */
    public static function getInstructionValueMaximum(): int
    {
        return self::$instructionValueMaximum;
    }

    /**
     * @param int $instructionValueMaximum
     */
    public static function setInstructionValueMaximum(int $instructionValueMaximum): void
    {
        self::$instructionValueMaximum = $instructionValueMaximum;
    }

    /**
     * @return int
     */
    public static function getRandomMotorValue(): int
    {
        return random_int(Config::getInstructionValueMinimum(), Config::getInstructionValueMaximum());
    }

    /**
     * @return int
     */
    public static function getRandomRegisterIndex(): int
    {
        return random_int(0, Config::getRegisterCount() - 1);
    }

    /**
     * @return string
     */
    public static function getRandomMotorId(): string
    {
        return (string)random_int(0, Config::getMotorCount() - 1);
    }

    /**
     * @return int
     */
    public static function getRegisterCount(): int
    {
        return self::$registerCount;
    }

    /**
     * @param int $registerCount
     */
    public static function setRegisterCount(int $registerCount): void
    {
        self::$registerCount = $registerCount;
    }

    /**
     * @return string
     */
    public static function getDataDir(): string
    {
        return __DIR__ . '/../../data';
    }

    /**
     * @return string
     */
    public static function getBinDir(): string
    {
        return __DIR__ . '/../../bin';
    }
}
