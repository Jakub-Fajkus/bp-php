<?php
declare(strict_types=1);

namespace Run;

use Experiment\ExperimentInterface;
use Experiment\ThreeLegLinearExperiment;
use Experiment\ThreeLegLinearExperiment20Individuals;
use Experiment\ThreeLegLinearExperimentRecombination;
use Experiment\ThreeLegLinearExperimentRecombination2Point;
use Experiment\ThreeLegLinearExperimentTournament3;
use Experiment\ThreeLegLinearExperimentTournament4;

include_once __DIR__ . '/../../vendor/autoload.php';

/** @var ExperimentInterface[] $experiments */
$experiments = [
    'rec' => new ThreeLegLinearExperimentRecombination(),
    'norec' => new ThreeLegLinearExperiment(),
    'norec20' => new ThreeLegLinearExperiment20Individuals(),
    '2point' => new ThreeLegLinearExperimentRecombination2Point(),
    'uniform' => new ThreeLegLinearExperimentRecombination(),
    'norectour3' => new ThreeLegLinearExperimentTournament3(),
    'norectour4' => new ThreeLegLinearExperimentTournament4(),
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
