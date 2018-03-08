<?php
declare(strict_types=1);

namespace Run;

use Experiment\ExperimentInterface;
use Experiment\Factory\ThreeLegLinearExperimentFactory;
use Experiment\ThreeLegLinearExperiment;
use Experiment\ThreeLegLinearExperiment1000Individuals2Tournament;
use Experiment\ThreeLegLinearExperimentRecombination;
use Experiment\ThreeLegLinearExperimentRecombination2Point;
use Experiment\ThreeLegLinearExperiment60Individuals3Tournament;
use Experiment\ThreeLegLinearExperiment60Individuals2Tournament;

include_once __DIR__ . '/../../vendor/autoload.php';

$experimentFactory = new ThreeLegLinearExperimentFactory();

/** @var ExperimentInterface[] $experiments */
$experiments = [
    'norec1000t2' => $experimentFactory->create1000IndividualsExperiment2Tournament(),
    'norec1000t3' => $experimentFactory->create1000IndividualsExperiment3Tournament(),
    'norec60t2' => $experimentFactory->create60IndividualsExperiment2Tournament(),
    'norec60t3' => $experimentFactory->create60IndividualsExperiment3Tournament(),
    '1point60t3' => $experimentFactory->create60IndividualsExperiment3Tournament1Point(),
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
