<?php
declare(strict_types=1);

namespace Cache;

use Genetic\IndividualInterface;
use Simulator\Serializer\Instruction\InstructionSerializer;

/**
 * Class IndividualCacheFacade
 * todo: predelat na klasickou tridu, ktera se preda simulatoru
 * @package Cache
 */
class IndividualCacheFacade
{
    protected static $cacheHit = 0;
    protected static $cacheMiss = 0;

    /**
     * @var MemoryCache|null
     */
    protected static $memoryCache;

    /**
     * @param IndividualInterface $individual
     * @return float|null
     */
    public static function getFitnessFromCache(IndividualInterface $individual): ?float
    {
        $cached = self::getMemoryCache()->getFitnessFromCache($individual);

        if ($cached) {
            self::$cacheHit++;
        } else {
            self::$cacheMiss++;
        }

        return $cached;
    }

    /**
     * @param IndividualInterface $individual
     */
    public static function cacheIndividual(IndividualInterface $individual): void
    {
        self::getMemoryCache()->cacheIndividual($individual);
    }

    public static function saveToFile(string $filename)
    {
        file_put_contents($filename, serialize(self::$memoryCache->getCache()));
    }

    public static function loadFromFile(string $filename)
    {
        if (file_exists($filename)) {
            $data = unserialize(file_get_contents($filename), []);

            if ($data !== false) {
                self::getMemoryCache()->setCache($data);
            }
        } else {
            echo 'cache file not found' . PHP_EOL;
        }
    }

    /**
     * @return int
     */
    public static function getCacheHitCount(): int
    {
        return self::$cacheHit;
    }

    /**
     * @return int
     */
    public static function getCacheMissCount(): int
    {
        return self::$cacheMiss;
    }

    /**
     * @return int
     */
    public static function getCacheSize(): int
    {
        return self::getMemoryCache()->getCacheSize();
    }

    /**
     * @return MemoryCache
     */
    protected static function getMemoryCache(): MemoryCache
    {
        if (self::$memoryCache === null) {
            self::$memoryCache = new MemoryCache();
        }

        return self::$memoryCache;
    }
}
