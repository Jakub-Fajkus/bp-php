<?php
declare(strict_types=1);

namespace Run;

use Experiment\SingleIndividualExperiment;

include_once __DIR__ . '/../../vendor/autoload.php';

$experiment = new SingleIndividualExperiment();
$experiment->run();
