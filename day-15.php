<?php

$input = '--input--';

$input = explode("\n", $input);
$disks = [];

foreach ($input as $line) {
    preg_match('/(\d+).+?(\d+).+?(\d+).+?(\d+)/', $line, $matches);
    $disks[$matches[1]] = [$matches[2], $matches[4]];
}

for ($i = 0; true; $i++) {
    for ($disk = 1, $count = count($disks); $disk <= $count; $disk++)
        if (($disks[$disk][1] + ($disk + $i)) % $disks[$disk][0] !== 0)
            continue 2;

    echo $i . PHP_EOL;
    break;
}