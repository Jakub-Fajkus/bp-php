<?php
declare(strict_types=1);

namespace Run;

include_once __DIR__ . '/../../vendor/autoload.php';

use Config\Config;
use Genetic\Generation;
use Genetic\Individual;
use Simulator\Model\FixedModelXml;
use Simulator\Serializer\Model\TextModelSerializer;
use Simulator\Serializer\MotorDrive\TextMotorDriveSerializer;
use Simulator\Simulator;

$model = new FixedModelXml();
$generation = new Generation();

$individual = new Individual($generation, $model, array_fill(0, Config::DEFAULT_MOTOR_DRIVE_VALUES_COUNT * 12, 50), 0);

$simulator = new Simulator(new TextModelSerializer(), new TextMotorDriveSerializer());
$simulator->evaluate($individual);