<?php
declare(strict_types=1);

namespace Genetic;

use PHPUnit\Framework\TestCase;
use Simulator\Model\ThreeLegLinearModelXml;

class GenerationTest extends TestCase
{

    public function testGetBestIndividual()
    {
        $generation = new Generation(1, []);

        $individuals = [
            new Individual($generation, new ThreeLegLinearModelXml(), [], 1, 5),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 2, 10),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 3, 15),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 4, 8),
        ];

        foreach ($individuals as $individual) {
            $generation->addIndividual($individual);
        }

        static::assertSame($individuals[2], $generation->getBestIndividual());
    }

    public function testCreateNewGeneration()
    {
        $generation = new Generation(1, []);

        $individuals = [
            new Individual($generation, new ThreeLegLinearModelXml(), [], 1, 5),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 2, 10),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 3, 15),
            new Individual($generation, new ThreeLegLinearModelXml(), [], 4, 8),
        ];

        foreach ($individuals as $individual) {
            $generation->addIndividual($individual);
        }

        $newGeneration = $generation->createNewGeneration();

        static::assertEquals(2, $newGeneration->getId());
        static::assertCount(4, $newGeneration->getIndividuals());
    }
}
