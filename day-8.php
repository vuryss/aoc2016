<?php

$input = '--input--';

$input  = explode("\n", $input);
$matrix = [];
$width  = 50;
$height = 6;

// Init display with 0
for ($y = 0; $y < $height; $y++) $matrix[$y] = array_fill(0, $width, 0);

// Parse commands
foreach ($input as $command) {
    switch (1) {
        case preg_match('/rect\s(\d+)x(\d+)/', $command, $matches):
            for ($y = 0; $y < $matches[2]; $y++)
                for ($x = 0; $x < $matches[1]; $x++)
                    $matrix[$y][$x] = 1;

            break;

        case preg_match('/rotate\scolumn\sx=(\d+)\sby\s(\d+)/', $command, $matches):
            $column = array_column($matrix, $matches[1]);

            for ($y = 0; $y < $height; $y++) {
                $pos = $y + $matches[2];
                $pos = $pos >= $height ? $pos - $height : $pos;
                $matrix[$pos][$matches[1]] = $column[$y];
            }

            break;

        case preg_match('/rotate\srow\sy=(\d+)\sby\s(\d+)/', $command, $matches):
            $row = $matrix[$matches[1]];

            for ($x = 0; $x < $width; $x++) {
                $pos = $x + $matches[2];
                $pos = $pos >= $width ? $pos - $width : $pos;
                $matrix[$matches[1]][$pos] = $row[$x];
            }

            break;
    }
}

$lid = 0;

echo PHP_EOL . PHP_EOL;

for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
        echo $matrix[$y][$x] ? '#' : ' ';
        $lid += $matrix[$y][$x];
    }
    echo PHP_EOL;
}

echo 'Lit: ' . $lid . PHP_EOL;