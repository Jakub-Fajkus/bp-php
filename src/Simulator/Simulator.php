<?php
declare(strict_types=1);

namespace Simulator;

use Config\Config;
use Filesystem\Filesystem;
use Genetic\IndividualInterface;
use Simulator\Serializer\Instruction\InstructionSerializerInterface;

/**
 * Class Simulator
 * @package Simulator
 */
class Simulator implements SimulatorInterface
{
    /** @var InstructionSerializerInterface */
    private $instructionSerializer;

    /**
     * Simulator constructor.
     *
     * @param InstructionSerializerInterface $serializer
     */
    public function __construct(InstructionSerializerInterface $serializer)
    {
        $this->instructionSerializer = $serializer;
    }

    /**
     * Evaluate the individuals
     *
     * [0]program name
     * [1] thread count
     * [2] /some/dir/model.xml
     * [3] /some/dir/to/generation
     *
     * @param IndividualInterface[] $individuals
     * @param string $modelFilePath
     * @param string $generationDirectory
     * @param int $duration
     * @throws \Exception
     */
    public function evaluate(array $individuals, string $modelFilePath, string $generationDirectory, int $duration): void
    {
        $filesystem = new Filesystem();

        $instructionsString = '';

        $individualsToEvaluate = [];

        foreach ($individuals as $individual) {
            if ($individual->needsEvaluation()) {
                $individualsToEvaluate[] = $individual;
            }
        }

        echo 'saved ' . (\count($individuals) - \count($individualsToEvaluate)) . PHP_EOL;

        for ($i = 0, $iMax = \count($individualsToEvaluate); $i < $iMax; $i++) {
            $instructions = $individualsToEvaluate[$i]->getInstructions();
            $instructionsString .= $this->instructionSerializer->serializeInstructions($instructions) . PHP_EOL;

            //ensure that we do not add the asterisk after the last individual
            if ($i !== $iMax - 1) {
                $instructionsString .= '*' . $individualsToEvaluate[$i]->getId() . PHP_EOL;
            }
        }

        $filesystem->writeToFile($generationDirectory . '/individuals.txt', $instructionsString);

        shell_exec(Config::getBinDir() . "/po_22_2/bp_compute_primka_7_referenci_bez_podprogramu 2 $modelFilePath $generationDirectory $duration");

        $content = $filesystem->readFromFile($generationDirectory . '/fitnesses.txt');
        $fitnesses = explode("\n", $content);

        if (\count($fitnesses) !== \count($individualsToEvaluate)) {
            throw new \Exception('The fitnesses count is not the same as the individuals! the diff is: ' . \count($fitnesses) - \count($individualsToEvaluate));
        }

        for ($i = 0, $iMax = \count($individualsToEvaluate); $i < $iMax; $i++) {
            $individualsToEvaluate[$i]->setFitness((double)$fitnesses[$i]);
        }
    }
}
