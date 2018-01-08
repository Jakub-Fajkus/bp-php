<?php
declare(strict_types=1);

namespace Genetic;

use Simulator\Model\ModelXmlInterface;

/**
 * Class IndividualFactory
 * @package Genetic
 */
class IndividualFactory
{
    /**
     * @var int
     */
    private $lastId = 0;

    /**
     * @param GenerationInterface $generation
     * @param ModelXmlInterface   $modelXml
     * @param array               $genotype
     * @param int|null            $id
     *
     * @return Individual
     */
    public function createIndividual(GenerationInterface $generation, ModelXmlInterface $modelXml, array $genotype, ?int $id = null): Individual
    {
        if ($id === null) {
            $id = $this->lastId++;
        }

        return new Individual($generation, $modelXml, $genotype, $id, 0);
    }
}
