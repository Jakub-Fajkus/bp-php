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
    '1point60t3' => $threeLegLinearFactory->create60IndividualsExperiment3Tournament1Point(),
    'norec60t2' => $threeLegLinearFactory->create60IndividualsExperiment2Tournament(),
    'norec60t3' => $threeLegLinearFactory->create60IndividualsExperiment3Tournament(),
    'norec1000t2' => $threeLegLinearFactory->create1000IndividualsExperiment2Tournament(),
    'norec1000t3' => $threeLegLinearFactory->create1000IndividualsExperiment3Tournament(),
    'norec1000t4' => $threeLegLinearFactory->create1000IndividualsExperiment4Tournament(),
    'norec1000t5' => $threeLegLinearFactory->create1000IndividualsExperiment5Tournament(),
    'norec1000t6' => $threeLegLinearFactory->create1000IndividualsExperiment6Tournament(),
    'norec1000t7' => $threeLegLinearFactory->create1000IndividualsExperiment7Tournament(),
    'norec1000t8' => $threeLegLinearFactory->create1000IndividualsExperiment8Tournament(),
    'norec1000t9' => $threeLegLinearFactory->create1000IndividualsExperiment9Tournament(),
    'norec1000t10' => $threeLegLinearFactory->create1000IndividualsExperiment10Tournament(),
    'norec1000t7-200gen' => $threeLegLinearFactory->create1000IndividualsExperiment7Tournament200Gen(),
    'norecANT1000t7-120gen' => $antLinearFactory->create1000IndividualsExperiment7Tournament(),
    'norec1000t2ss' => $threeLegLinearFactory->create1000IndividualsExperiment2TournamentSS(),
    'norec1000t3ss' => $threeLegLinearFactory->create1000IndividualsExperiment3TournamentSS(),
    'norec1000t4ss' => $threeLegLinearFactory->create1000IndividualsExperiment4TournamentSS(),
    'norec1000t5ss' => $threeLegLinearFactory->create1000IndividualsExperiment5TournamentSS(),
    'norec1000t6ss' => $threeLegLinearFactory->create1000IndividualsExperiment6TournamentSS(),
    'norec1000t7ss' => $threeLegLinearFactory->create1000IndividualsExperiment7TournamentSS(),
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
