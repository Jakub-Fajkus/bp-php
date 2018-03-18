<?php

declare(strict_types=1);

if ($argc !== 2) {
    echo "Chybejici argument generation number!";
    exit(1);
}

$generationNumber = (int)$argv[1];

$lowValue = 0;
$highValue = 320;
$step = 10;

$selectFolders = [
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_2_ss',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_3_ss',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_4_ss',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_5_ss',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_6_ss',
    'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7_ss',
];

$histogramBounds = range($lowValue, $highValue, $step);

$foldersData = [];
foreach ($selectFolders as $selectFolder) {
    if ($selectFolder == 'bp_compute_primka_7_referenci_trojnozka_1000_jedincu_bez_rekombinace_turnaj_7') {
        $histogramData = getHistogramData($histogramBounds, 60, $selectFolder);
    } else {
        $histogramData = getHistogramData($histogramBounds, $generationNumber, $selectFolder);
    }

    $foldersData[$selectFolder] = $histogramData;
}



$header = '"Fitness range"';
foreach ($selectFolders as $folderName) {
    $headString = substr($folderName, strpos($folderName, 'turnaj_'));
    $header .=  '	"' . $headString . '"';
}

$outputRows = [];

//vlozime 1. sloupec
foreach ($histogramBounds as $index => $histogramBound) {
    $lowerBound = $index * $step;
    $upperBound = $lowerBound + $step;

    $outputRows[] = "\"$lowerBound-$upperBound\"";
}

//vlozime datove sloupce
foreach ($foldersData as $folderName => $folderData) {
    foreach ($folderData as $index => $count) {
        $outputRows[$index] .= "\t $count";
    }
}

$dataFile = "fitnessHistogramData$generationNumber.txt";
$output = $header . PHP_EOL . implode("\n", $outputRows);
file_put_contents($dataFile, $output);

$absolutePath = realpath($dataFile);

//"dataFile='filename'"

$columnCount = \count($selectFolders);
$generationNumberString = str_pad((string)$generationNumber, 4, (string)0, STR_PAD_LEFT);
$variables = "\"dataFile='$absolutePath'; generationNumber='$generationNumberString'; dataColumns='$columnCount'\"";
echo PHP_EOL . $variables . PHP_EOL;
$gnuplotCommand = "gnuplot -e $variables /home/jakub/PhpstormProjects/bp/gnuplotFitnessHistogram.txt";
echo PHP_EOL . $gnuplotCommand . PHP_EOL ;
echo shell_exec($gnuplotCommand);


function getHistogramData(array $histogramBounds, int $generationNumber, string $selectFolder)
{
    $histogramData = [];

    for ($i = 0; $i < \count($histogramBounds); $i++) {
        $histogramData[$i] = 0;
    }

    $runDirectories = array_filter(glob("$selectFolder/*"), 'is_dir');

//runDirectory is the dir with name containing the date
    foreach ($runDirectories as $runDirectory) {
//    var_dump($runDirectory);

        $individualsFile = "$runDirectory/allIndividuals.txt";
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

                //is is the generation we are loking for
                if ($generation == $generationNumber) {
                    $histogramData[(int)((float)$fitness / 10)] += 1;
                }
            }
        } else {
            echo "File does not exist $individualsFile";
        }
    }

    echo "konec " . array_sum(array_values($histogramData));

    return $histogramData;
}
