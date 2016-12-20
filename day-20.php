<?php

$input = '--input--';

$begin = $end = [];
$banned = 0;

foreach (explode("\n", $input) as $range) list($begin[], $end[]) = explode('-', $range);

array_multisort($begin, SORT_ASC, $end);

for ($i = 0, $j = 0, $len = count($begin) - 1; $i < $len; $i++, $j = 0) {
    while (++$j && isset($begin[$i + $j]) && $end[$i] >= $begin[$i + $j] - 1)
        if ($end[$i + $j] > $end[$i]) $end[$i] = $end[$i + $j];
    $banned += $end[$i] - $begin[$i] + 1;
    $i += $j - 1;
}

echo 'First IP: ' . ($end[0] + 1) . PHP_EOL;
echo 'Allowed IPs: ' . (4294967295 - $banned + 1) . PHP_EOL;