<?php
declare(strict_types=1);

namespace Genetic\Generator;

use Genetic\Generation;
use Genetic\GenerationInterface;
use Genetic\IndividualFactory;
use Simulator\Model\FixedModelXml;

/**
 * Class GenerationGenerator
 * @package Genetic\Generator
 */
class GenerationGenerator implements GenerationGeneratorInterface
{
    /**
     * Create a new generation with given id and with $individualCount of individuals
     *
     * @param int $id
     * @param int $individualCount
     *
     * @return GenerationInterface
     */
    public function generateGeneration(int $id, int $individualCount): GenerationInterface
    {
        $generation = new Generation($id, []);

        $individualFactory = new IndividualFactory();

        for ($i = 0; $i < $individualCount; $i++) {
            $newIndividual = $individualFactory->createIndividual($generation, new FixedModelXml(), [], $i+1);
            $newIndividual->randomizeGenotype();
            $generation->addIndividual($newIndividual);
        }
        return $generation;
    }
}
