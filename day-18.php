<?php

$input = '--input--';

$safe     = substr_count($input, '.');
$last     = str_split(strtr($input, '^.', '10'));
$nColumns = count($last);
$nRows    = 400000; // 40 for part 1

for ($i = 1, $row = []; $i < $nRows; $i++, $last = $row, $row = [])
    for ($j = 0; $j < $nColumns; $j++) {
        $row[$j] = ($last[$j - 1] ?? 0) != ($last[$j + 1] ?? 0) ? 1 : 0;
        if (!$row[$j]) $safe++;
    }

echo $safe . PHP_EOL;