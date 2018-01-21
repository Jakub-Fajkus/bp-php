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
     * @param string                $modelFilePath
     * @param string                $generationDirectory
     */
    public function evaluate(array $individuals, string $modelFilePath, string $generationDirectory): void
    {
        $filesystem = new Filesystem();

        $instructionsString = '';

        for ($i = 0, $iMax = \count($individuals); $i < $iMax; $i++) {
            $instructions = $individuals[$i]->getInstructions();
            $instructionsString .= $this->instructionSerializer->serializeInstructions($instructions) . PHP_EOL;

            //ensure that we do not add the asterisk after the last individual
            if ($i !== $iMax - 1) {
                $instructionsString .= '*' . $individuals[$i]->getId() . PHP_EOL;
            }
        }

        $filesystem->writeToFile($generationDirectory . '/individuals.txt', $instructionsString);

        shell_exec(Config::getBinDir() . "/bp_compute 4 $modelFilePath $generationDirectory");

        $content = $filesystem->readFromFile($generationDirectory . '/fitnesses.txt');
        $fitnesses = explode("\n", $content);

        if (\count($fitnesses) !== \count($individuals)) {
            throw new \Exception('The fitnesses count is not the same as the individuals! the diff is: ' . \count($fitnesses) - \count($individuals));
        }

        for ($i = 0, $iMax = \count($individuals); $i < $iMax; $i++) {
            $individuals[$i]->setFitness((double)$fitnesses[$i]);
        }
    }
}
