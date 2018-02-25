<?php
declare(strict_types=1);

namespace Statistics;

/**
 * Interface CacheStatisticsInterface
 * @package Statistics
 */
interface CacheStatisticsInterface
{
    /**
     * Get cache statistics(hit, miss, cached individuals)
     *
     * @return string
     */
    public function getStatistics(): string;
}
