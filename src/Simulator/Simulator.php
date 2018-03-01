<?php
declare(strict_types=1);

namespace Simulator;

use Cache\IndividualCacheFacade;
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

    /** @var string Path to the simulator executable */
    private $executable;

    /**
     * Simulator constructor.
     *
     * @param InstructionSerializerInterface $serializer
     * @param string $executable
     */
    public function __construct(InstructionSerializerInterface $serializer, string $executable)
    {
        $this->instructionSerializer = $serializer;
        $this->executable = $executable;
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
        $cachedCount = 0;

        foreach ($individuals as $individual) {
            //if is cached
            $cachedFitness = IndividualCacheFacade::getFitnessFromCache($individual);
            if ($cachedFitness !== null) {
                //the individual's genome was already evaluated
                //assign the cached fitness to the individual
                $individual->setFitness($cachedFitness);
                $cachedCount++;
            } else if ($individual->needsEvaluation()) {
                $individualsToEvaluate[] = $individual;
            }
        }

        $savedCount = (\count($individuals) - \count($individualsToEvaluate));
        echo "saved $savedCount, $cachedCount of that was from cache\n";

        for ($i = 0, $iMax = \count($individualsToEvaluate); $i < $iMax; $i++) {
            $instructions = $individualsToEvaluate[$i]->getInstructions();
            $instructionsString .= $this->instructionSerializer->serializeInstructions($instructions) . PHP_EOL;

            //ensure that we do not add the asterisk after the last individual
            if ($i !== $iMax - 1) {
                $instructionsString .= '*' . $individualsToEvaluate[$i]->getId() . PHP_EOL;
            }
        }

        $filesystem->writeToFile($generationDirectory . '/individuals.txt', $instructionsString);

        shell_exec(Config::getBinDir() . "{$this->executable} 6 $modelFilePath $generationDirectory $duration");

        $content = $filesystem->readFromFile($generationDirectory . '/fitnesses.txt');
        $fitnesses = explode("\n", $content);

        if (\count($fitnesses) !== \count($individualsToEvaluate)) {
            throw new \Exception('The fitnesses count is not the same as the individuals! the diff is: ' .
                \count($fitnesses) - \count($individualsToEvaluate));
        }

        for ($i = 0, $iMax = \count($individualsToEvaluate); $i < $iMax; $i++) {
            $fitness = (double)$fitnesses[$i];
            $individualsToEvaluate[$i]->setFitness($fitness);

            IndividualCacheFacade::cacheIndividual($individualsToEvaluate[$i]);
        }
    }
}
