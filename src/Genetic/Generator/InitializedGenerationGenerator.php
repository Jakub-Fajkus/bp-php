<?php
declare(strict_types=1);

namespace Genetic\Generator;

use Genetic\Generation;
use Genetic\GenerationInterface;
use Genetic\IndividualFactory;
use Genetic\IndividualInterface;
use Genetic\Instruction\ComposedInstructionFactory;
use Genetic\Instruction\MotorValue;
use Genetic\Instruction\SimpleInstructionFactory;

/**
 * Class InitializedGenerationGenerator
 * @package Genetic\Generator
 */
class InitializedGenerationGenerator implements GenerationGeneratorInterface
{
    /** @var array */
    private $initialGenomes = [
        '1 5 2 2 2 5 
        2 -5 1 -5 
        0 2 0 -5 2 -3 
        2 -5 2 4 
        1 1 
        0 -4 1 3 1 -5 2 -4 1 -1 
        1 -5 1 3 
        2 -2 2 0 
        0 5 2 5 
        1 -4 0 -4 2 -5',

        '1 5 2 5 0 4 
        2 -5 1 -5 0 -5 
        2 -4 
        0 -5 
        0 4 
        0 -5 
        2 -3 1 -1 
        2 5 
        0 -1 0 -4 
        2 -2',

        '0 -2 1 3 0 -4 
        1 -2 2 -5 1 -1 
        2 1 
        1 5 
        2 5 0 5 1 5 
        0 -5 
        0 0 1 -5 2 -5 
        0 -2 
        0 0 
        2 3 0 -3 2 5 ',

        '0 -5 
        1 -2 
        0 5 1 -4 0 1 
        1 2 2 -5 0 -5 
        1 3 
        1 -4 1 1 1 2 
        1 -3 0 5 
        2 0 1 5 2 5 
        1 -5 
        1 3',

        '0 -2 
        1 0 0 -5 0 4 
        2 -5 1 -5 
        2 4 
        1 -4 0 -5 
        2 -5 
        1 -4 1 -3 
        2 2 
        1 4 
        2 5 0 5 1 5 ',

        '2 -5 
        1 5 2 5 0 5 
        1 -4 2 -5 0 -5 
        2 -4 1 -1 0 -3 
        2 -5 1 -4 2 -1 2 -2 
        1 3 1 -2 0 -5 
        2 0 
        1 -4 1 5 
        2 -5 
        2 2 1 2 1 -3 ',

        '2 4 
        1 -3 
        0 -5 1 -2 2 -4 
        0 4 1 -5 
        0 -1 
        0 -4 1 0 
        2 5 
        1 1 1 5 
        0 -5 0 4 
        0 -2 1 -2 ',

        '2 1 
        1 5 
        1 -4 2 -2 2 1 2 -4 
        2 2 
        0 -5 2 5 
        0 -3 1 5 0 5 
        0 -5 
        2 -3 2 1 0 -5 1 1 
        0 -5 1 -5 
        2 4 2 2'

        ];

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
        //todo: refactor to a instruction deserializer

        $generation = new Generation($id, []);
        $individualFactory = new IndividualFactory();
        $instructionFactory = new ComposedInstructionFactory();

        //for each individual
        foreach ($this->initialGenomes as $genome) {
            $instructions = [];
            //for each individal row(instruction)
            foreach (\explode("\n", $genome) as $row) {
                $row = trim($row);

                $values = \explode(' ', $row);
                $motorValues = [];

                for ($i = 0; $i < \count($values); $i+=2) {
                    $motor = $values[$i];
                    $value = (int)$values[$i+1];

                    $motorValues[] = new MotorValue($motor, $value);
                }

                $instructions[] = $instructionFactory->createWithValues($motorValues);
            }
            $individual = $individualFactory->createIndividual($generation, $instructions);

            $generation->addIndividual($individual);
        }

        //generate the rest of the individuals
        for ($i = 0; $i < $individualCount - \count($this->initialGenomes); $i++) {
            $newIndividual = $individualFactory->createIndividual($generation, [], $i + 1);
            $newIndividual->randomizeGenotype($instructionFactory);
            $generation->addIndividual($newIndividual);
        }

        $generation->resetIndividualsId();

        return $generation;
    }
}
