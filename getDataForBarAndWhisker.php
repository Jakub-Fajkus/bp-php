<?php

declare(strict_types=1);

$generations = [];

$individualCount = 400;
$generationCount = 120;
$generationStep = 10;
$selectBetterHalf = true;

//$individualsFile = 'data_old/bp_compute_spirala_9_referenci_vstupy_podprogramy_2_ss/2018-03-25T17:58:49+00:00/allIndividuals.txt';
//$individualsFile = 'data_old/bp_compute_ThreeLegLinearExperiment1000Individuals2TournamentSS/2018-05-02T20:20:17+00:00/allIndividuals.txt';
$individualsFile = 'data_old/bp_compute_primka_7_referenci_mravenec_vstupy_2_ss_OLD/2018-05-01T01:19:54+00:00/allIndividuals.txt';

//$individualsFile = 'data_old/bp_compute_spirala_9_referenci_mravenec_vstupy_podprogramy_2_ss/2018-03-27T10:23:15+00:00/allIndividuals.txt';
if (file_exists($individualsFile)) {
    $individualsFileContent = file_get_contents($individualsFile);
    //format: >GEN_ID.INDI_ID< FITNESS
    //example: >38.744< 32.285
    $rows = explode("\n", $individualsFileContent);

    foreach ($rows as $row) {
        $matches = [];
        $result = preg_match('/>([0-9]+).([0-9]+)< ([0-9]+.?[0-9]?)/', $row, $matches);

        //empty line of invalid syntax
        if ($result < 1) {
            continue;
        }

        [, $generation, $individual, $fitness] = $matches;

        if (empty($generation)) {
            continue;
        }

        $generations[$generation][] = (float)$fitness;
    }
} else {
    echo 'file does not exist';
    return 1;
}

$sortedGenerations = [];
foreach ($generations as $generationNumber => $fitnesses) {
    sort($fitnesses);
    $sortedGenerations[$generationNumber] = $fitnesses;
}

$selectedGenerations = range(0, $generationCount, $generationStep);
$selectedGenerations[0] += 1;

$fileContent = '';
foreach ($selectedGenerations as $generationNumber) {
    $generation = $sortedGenerations[$generationNumber];

    if ($selectBetterHalf) {
        $generation = array_slice($generation, $individualCount/2, $individualCount/2);
    }

    $min = min($generation);
    $max = max($generation);
    $median = Median($generation);
    $q1 = Quartile_25($generation);
    $q3 = Quartile_75($generation);
    $avg = Average($generation);
    $stdDev = StdDev($generation);

    $fileContent .= "$generationNumber $min $q1 $median $q3 $max".PHP_EOL;
}
file_put_contents('barAndWhiskerData.txt', $fileContent);

//start source: https://blog.poettner.de/2011/06/09/simple-statistics-with-php/
function Median($Array)
{
    return Quartile_50($Array);
}

function Quartile_25($Array)
{
    return Quartile($Array, 0.25);
}

function Quartile_50($Array)
{
    return Quartile($Array, 0.5);
}

function Quartile_75($Array)
{
    return Quartile($Array, 0.75);
}

function Quartile($Array, $Quartile)
{
    $pos = (count($Array) - 1) * $Quartile;

    $base = floor($pos);
    $rest = $pos - $base;

    if (isset($Array[$base + 1])) {
        return $Array[$base] + $rest * ($Array[$base + 1] - $Array[$base]);
    } else {
        return $Array[$base];
    }
}

function Average($Array)
{
    return array_sum($Array) / count($Array);
}

function StdDev($Array)
{
    if (count($Array) < 2) {
        return;
    }

    $avg = Average($Array);

    $sum = 0;
    foreach ($Array as $value) {
        $sum += pow($value - $avg, 2);
    }

    return sqrt((1 / (count($Array) - 1)) * $sum);
}
//end source https://blog.poettner.de/2011/06/09/simple-statistics-with-php/
