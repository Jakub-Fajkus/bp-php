<?php
declare(strict_types=1);

namespace Simulator;

use Genetic\IndividualInterface;
use Genetic\Instruction\SimpleInstruction;

/**
 * Class MatchSimulator
 * @package Simulator
 */
class MatchSimulator
{
    /** @var SimpleInstruction[] $key*/
    private $key = [];

    /**
     * MatchSimulator constructor.
     */
    public function __construct()
    {
        $this->key[] = new SimpleInstruction('0', 1);
        $this->key[] = new SimpleInstruction('0', 2);
        $this->key[] = new SimpleInstruction('0', 3);
        $this->key[] = new SimpleInstruction('0', 4);
        $this->key[] = new SimpleInstruction('0', 5);
        $this->key[] = new SimpleInstruction('0', 1);
        $this->key[] = new SimpleInstruction('0', 2);
        $this->key[] = new SimpleInstruction('0', 3);
        $this->key[] = new SimpleInstruction('0', 4);
        $this->key[] = new SimpleInstruction('0', 5);
        $this->key[] = new SimpleInstruction('0', 1);
        $this->key[] = new SimpleInstruction('0', 2);
        $this->key[] = new SimpleInstruction('0', 3);
        $this->key[] = new SimpleInstruction('0', 4);
        $this->key[] = new SimpleInstruction('0', 5);
        $this->key[] = new SimpleInstruction('0', 1);
        $this->key[] = new SimpleInstruction('0', 2);
        $this->key[] = new SimpleInstruction('0', 3);
        $this->key[] = new SimpleInstruction('0', 4);
        $this->key[] = new SimpleInstruction('0', 5);
        $this->key[] = new SimpleInstruction('0', 1);
        $this->key[] = new SimpleInstruction('0', 2);
        $this->key[] = new SimpleInstruction('0', 3);
        $this->key[] = new SimpleInstruction('0', 4);
        $this->key[] = new SimpleInstruction('0', 5);
    }

    /**
     * Evaluate the individuals
     *
     * [0]program name
     * [1] /some/dir/model.xml
     * [2] /some/dir/to/generation
     *
     * @param IndividualInterface[] $individuals
     * @param string                $modelFilePath
     * @param string                $generationDirectory
     */
    public function evaluate(array $individuals): void
    {
        /** @var IndividualInterface[] $individualsToEvaluate */
        $individualsToEvaluate = [];

        foreach ($individuals as $individual) {
            if ($individual->needsEvaluation()) {
                $individualsToEvaluate[] = $individual;
            }
        }

        for ($i = 0, $iMax = \count($individualsToEvaluate); $i < $iMax; $i++) {
            $fitnesses = 0;
            $instructions = $individualsToEvaluate[$i]->getInstructions();
            foreach ($instructions as $index => $instruction) {
                if ($instruction->serialize() === $this->key[$index]->serialize()) {
                    $fitnesses++;
                }
            }

            $individualsToEvaluate[$i]->setFitness($fitnesses);
        }
    }
}
