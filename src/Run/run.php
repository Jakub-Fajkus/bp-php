<?php
declare(strict_types=1);

namespace Run;

use Experiment\GenerationExperiment;
use Experiment\SingleIndividualExperiment;
use Experiment\ThreeLegSpiralExperiment;

include_once __DIR__ . '/../../vendor/autoload.php';

$experiment = new ThreeLegSpiralExperiment();
$experiment->run();
