<?php
declare(strict_types=1);

namespace Run;

use Experiment\GenerationExperiment;
use Experiment\SingleIndividualExperiment;
use Experiment\ThreeLegLinearExperiment;
use Experiment\ThreeLegLinearExperimentRecombination;
use Experiment\ThreeLegSpiralExperiment;

include_once __DIR__ . '/../../vendor/autoload.php';

$experimentName = $argv[1];

if ($experimentName == 'recombination') {
    $experiment = new ThreeLegLinearExperimentRecombination();
    echo 'running ThreeLegLinearExperimentRecombination' . PHP_EOL;
} elseif ($experimentName == 'norecombination') {
    $experiment = new ThreeLegLinearExperiment();
    echo 'running ThreeLegLinearExperiment' . PHP_EOL;

} else {
    echo 'Unknown experiment';
}

$experiment->run();
