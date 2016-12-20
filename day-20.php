<?php

$input = '--input--';

$begin = $end = [];

foreach (explode("\n", $input) as $range) list($begin[], $end[]) = explode('-', $range);

array_multisort($begin, SORT_ASC, $end);

for ($i = 0, $j = 1, $len = count($begin) - 1; $i < $len; $i++, $j = 1) {
    while (isset($begin[$i + $j]) && $end[$i] >= $begin[$i + $j] - 1) {
        if ($end[$i + $j] > $end[$i]) $end[$i] = $end[$i + $j];
        unset($begin[$i + $j], $end[$i + $j]);
        $j++;
    }
    $i += $j - 1;
}

$begin = array_values($begin);
$end   = array_values($end);

echo 'First IP: ' . ($end[0] + 1) . PHP_EOL;

$count = 0;

for ($i = 0; $i <= 4294967295; $i++) {
    if (false !== ($key = array_search($i, $begin))) {
        $i = $end[$key];
        continue;
    }
    $count++;
}

echo 'Allowed IPs: ' . $count . PHP_EOL;