<?php
declare(strict_types=1);

namespace Cache;

use Genetic\IndividualInterface;
use Simulator\Serializer\Instruction\InstructionSerializer;

/**
 * Class MemoryCache
 * @package Cache
 */
class MemoryCache
{
    /**
     * @var float[]
     */
    protected $cache = [];

    public function getFitnessFromCache(IndividualInterface $individual): ?float
    {
        $serializer = new InstructionSerializer();
        $key = $serializer->serializeInstructions($individual->getInstructions());

        $cached = isset($this->cache[$key]);

        if ($cached) {
            return $this->cache[$key];
        }

        return null;
    }

    public function cacheIndividual(IndividualInterface $individual): void
    {
        $serializer = new InstructionSerializer();
        $key = $serializer->serializeInstructions($individual->getInstructions());

        $this->cache[$key] = $individual->getFitness();
    }

    public function getCache(): array
    {
        return $this->cache;
    }

    /**
     * @param float[] $cache
     * @return MemoryCache
     */
    public function setCache(array $cache): MemoryCache
    {
        $this->cache = $cache;
        return $this;
    }


    public function getCacheSize(): int
    {
        return \count($this->cache);
    }
}
