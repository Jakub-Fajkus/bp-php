<?php
declare(strict_types=1);

namespace Statistics;

use Cache\IndividualCacheFacade;

/**
 * Class CacheStatistics
 * @package Statistics
 */
class CacheStatistics implements CacheStatisticsInterface
{

    /**
     * Get cache statistics(hit, miss, cached individuals)
     *
     * @return string
     */
    public function getStatistics(): string
    {
        $hits = IndividualCacheFacade::getCacheHitCount();
        $misses = IndividualCacheFacade::getCacheMissCount();
        $cacheSize = IndividualCacheFacade::getCacheSize();
        $hitMissRatio = $hits / (float)$misses;

        $report = 'Cache report:' . PHP_EOL;
        $report .= "Cache size: $cacheSize" . PHP_EOL;
        $report .= "Cache hit count $hits" . PHP_EOL;
        $report .= "Cache miss count $misses" . PHP_EOL;
        $report .= "Cache hit/miss ratio: $hitMissRatio" . PHP_EOL;

        return $report;
    }
}
