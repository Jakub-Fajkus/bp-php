<?php
declare(strict_types=1);

namespace Run;

use Experiment\ExperimentInterface;
use Experiment\Factory\AntLinearExperimentFactory;
use Experiment\Factory\ThreeLegLinearExperimentFactory;

include_once __DIR__ . '/../../vendor/autoload.php';

$threeLegLinearFactory = new ThreeLegLinearExperimentFactory();
$antLinearFactory = new AntLinearExperimentFactory();

/** @var ExperimentInterface[] $experiments */
$experiments = [
    'trojnozka-primka' => $threeLegLinearFactory->createThreeLegLinearExperiment(),
    'trojnozka-spirala' => $threeLegLinearFactory->createThreeLegSpiralExperiment(),
    'mravenec-primka' => $antLinearFactory->createAntLinearExperiment(),
    'mravenec-spirala' => $antLinearFactory->createAntSpiralExperiment(),
];

if ($argc === 1) {
    echo 'ERROR, missing experiment argument, try one of those: ' . implode(', ', array_keys($experiments)) . PHP_EOL;
    exit(1);
}
$experimentName = $argv[1];

if (array_key_exists($experimentName, $experiments)) {
    $experiment = $experiments[$experimentName];
    echo 'runing : ' . get_class($experiment) . PHP_EOL;
    $experiment->run();
} else {
    echo "ERROR: unknown experiment $experimentName, try one of those: " . implode(', ', array_keys($experiments)) . PHP_EOL;
    exit(1);
}
