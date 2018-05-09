<?php
declare(strict_types=1);

if ($argc !== 2) {
    echo "Chybejici argument experiment directory!";
    exit(1);
}

$individuals = [];

$experimentDirectory = $argv[1];
$countOfGenerations = 60;

$dateDirectories = array_filter(glob("$experimentDirectory/*"), 'is_dir');
foreach ($dateDirectories as $dateDirectory) {
    $generationsDirectories = array_filter(glob("$dateDirectory/*"), 'is_dir');

    foreach ($generationsDirectories as $generationsDirectory) {
        $lastSlash = strrpos($generationsDirectory, '/');
        $generationNumber = (int)substr($generationsDirectory, $lastSlash + 1);
        $individualsFile = "$generationsDirectory/fitnesses.txt";

        if (isset($individuals[$generationNumber])) {
            $individuals[$generationNumber] += (int)shell_exec("cat $individualsFile | wc -l");
        } else {
            $individuals[$generationNumber] = (int)shell_exec("cat $individualsFile | wc -l");
        }
    }
}

ksort($individuals);

$sumOfAll = array_sum($individuals);
echo "count of all individuals: $sumOfAll" . PHP_EOL;
$avg = $sumOfAll / \count($individuals);
echo "average: $avg" . PHP_EOL;

$fileContent = "Generation\tAverage # of evaluated individuals" . PHP_EOL;

foreach ($individuals as $generation => $count) {
    $avgPerGeneration = $count / $countOfGenerations;
    echo "in generation $generation: $count, average per generation: $avgPerGeneration" . PHP_EOL;

    $fileContent .= "$generation\t$avgPerGeneration" . PHP_EOL;
}

$folder = $argv[1];
file_put_contents("${experimentDirectory}/countOfEvaluatedIndividuals.txt", $fileContent);
