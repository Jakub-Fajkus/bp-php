<?php
declare(strict_types=1);

namespace Genetic;

use Config\Config;
use Simulator\Model\ModelXmlInterface;
use Simulator\Model\MotorDriveFactory;
use Simulator\Model\MotorDriveInterface;

/**
 * Class Individual
 * @package Genetic
 */
class Individual implements IndividualInterface
{
    /** @var GenerationInterface */
    private $generation;

    /** @var int[] */
    private $genotype;

    /** @var float */
    private $fitness;

    /** @var ModelXmlInterface */
    private $model;

    /** @var int */
    private $id;

    /**
     * Individual constructor.
     *
     * @param GenerationInterface $generation
     * @param ModelXmlInterface   $modelXml
     * @param int[]               $genotype
     * @param float               $fitness
     */
    public function __construct(GenerationInterface $generation, ModelXmlInterface $modelXml, array $genotype, int $id, float $fitness = 0)
    {
        $this->generation = $generation;
        $this->genotype = $genotype;
        $this->fitness = $fitness;
        $this->model = $modelXml;
        $this->id = $id;
    }

    /**
     * Get the motor drives phenotype
     *
     * @return MotorDriveInterface[]
     */
    public function getMotorDrives(): array
    {
        //check if the genotype is of correct size
        if (\count($this->genotype) % Config::getMotorDriveValuesCount() !== 0) {
            throw new \Exception('The genotype has incorrect size!: ' . \count($this->genotype));
        }

        $motorDrives = [];

        $motorCount = \count($this->genotype) / Config::getMotorDriveValuesCount();
        $motorNumber = 0;
        $motorDriveFactory = new MotorDriveFactory();

        //for each motor, get it's part of the array and create the motor drive
        for ($i = 0; $i < $motorCount; $i++) {
            $values = \array_slice(
                $this->genotype,
                $i * Config::getMotorDriveValuesCount(),
                Config::getMotorDriveValuesCount()
            );

            $motorDrives[] = $motorDriveFactory->createMotorDrive('motor_' . $motorNumber++, $values);
        }

        return $motorDrives;
    }

    /**
     * Perform the one point crossover with the given individual.
     *
     * @param IndividualInterface $individual
     *
     * @param int|null            $crossoverPoint
     *
     * @return IndividualInterface[] Array of 2 individuals that were created by the crossover
     * @throws \Exception
     */
    public function onePointCrossover(IndividualInterface $individual, ?int $crossoverPoint = null): array
    {
        if ($crossoverPoint === null) {
            $crossoverPoint = random_int(0, \count($this->genotype));
        }

        $thisA = \array_slice($this->genotype, 0, $crossoverPoint);//from start to the crossover point
        $thisB = \array_slice($this->genotype, $crossoverPoint);//from the crossover point to the end
        $otherA = \array_slice($individual->getGenotype(), 0, $crossoverPoint);//from start to the crossover point
        $otherB = \array_slice($individual->getGenotype(), $crossoverPoint);//from the crossover point to the end

        $individualFactory = new IndividualFactory();

        $individuals = [
            $individualFactory->createIndividual($this->generation, $this->model, \array_merge($thisA, $otherB)),
            $individualFactory->createIndividual($this->generation, $this->model, \array_merge($otherA, $thisB)),
        ];

        return $individuals;
    }

    /**
     * @return int[]
     */
    public function getGenotype(): array
    {
        return $this->genotype;
    }

    /**
     * Perform a mutation
     *
     * @param bool $forced
     *
     * @throws \Exception
     */
    public function mutate(bool $forced = false): void
    {
        if ($forced || random_int(0, Config::getMutationRate()) === Config::getMutationRate() / 2) {
            $mutatedGeneIndex = random_int(0, \count($this->genotype) - 1);
            $this->genotype[$mutatedGeneIndex] += random_int(
                Config::getMotorDriveMinimum() / 2,
                Config::getMotorDriveMaximum() / 2
            );

            if ($this->genotype[$mutatedGeneIndex] > Config::getMotorDriveMaximum()) {
                $this->genotype[$mutatedGeneIndex] = Config::getMotorDriveMaximum();
            } elseif ($this->genotype[$mutatedGeneIndex] < Config::getMotorDriveMinimum()) {
                $this->genotype[$mutatedGeneIndex] = Config::getMotorDriveMinimum();
            }
        }
    }

    /**
     * @return float
     */
    public function getFitness(): float
    {
        return $this->fitness;
    }

    /**
     * @param float $fitness
     */
    public function setFitness(float $fitness): void
    {
        $this->fitness = $fitness;
    }

    /**
     * @return ModelXmlInterface
     */
    public function getModelXMl(): ModelXmlInterface
    {
        return $this->model;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Generate random genotype
     */
    public function randomizeGenotype(): void
    {
        $this->genotype = [];

        for ($i = 0; $i < Config::getMotorDriveValuesCount() * 12; $i++) {
            $this->genotype[] = random_int(Config::getMotorDriveMinimum(), Config::getMotorDriveMaximum());
        }
    }
}
