<?php

declare(strict_types=1);

if ($argc !== 2) {
    echo "Chybejici argument generation number!";
    exit(1);
}

$generationNumber = (int)$argv[1];

$lowValue = 0;
$highValue = 290;
$step = 10;

$histogramBounds = range($lowValue, $highValue, $step);
$histogramData = [];

for ($i = 0; $i < \count($histogramBounds); $i++) {
    $histogramData[$i] = 0;
}

$runDirectories = array_filter(glob('*'), 'is_dir');

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
            if($result < 1) {
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

$output = '"Fitness range"	"Počet jedinců"' . PHP_EOL;

foreach ($histogramData as $index => $count) {
    $lowerBound = $index*$step;
    $upperBound = $lowerBound + $step;
    $output .= "\"$lowerBound-$upperBound\"	$count" . PHP_EOL;
}

$dataFile = "fitnessHistogramData$generationNumber.txt";
file_put_contents($dataFile, $output);

$absolutePath = realpath($dataFile);

$columnCount = 1;
$generationNumberString = (string)$generationNumber;
$variables = "\"dataFile='$absolutePath'; generationNumber='$generationNumberString'; dataColumns='$columnCount'\"";
echo PHP_EOL . $variables . PHP_EOL;
$gnuplotCommand = "gnuplot -e $variables /home/jakub/PhpstormProjects/bp/gnuplotFitnessHistogram.txt";
echo PHP_EOL . $gnuplotCommand . PHP_EOL ;
echo shell_exec($gnuplotCommand);
