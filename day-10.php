<?php

$input = '--input--';

$input = explode("\n", $input);
$bot = $instr = $output = $values = [];
$id = 0;

foreach ($input as $k => $row)
       (preg_match('/^v.*?(\d+).*?(\d+)$/', $row, $m) && $bot[$m[2]][] = $m[1])
    || (preg_match('/^b.*?(\d+).*?(bot|output)\s(\d+).*?(bot|output)\s(\d+)$/', $row, $m) && $instr[$m[1]] = ['min' => $m[2] . '.' . $m[3], 'max' => $m[4] . '.' . $m[5]]);

while (true) {
    foreach ($bot as $id => $values) if (count($values) == 2) break;
    if (count($values) != 2) break;

    if (in_array(61, $bot[$id]) && in_array(17, $bot[$id])) echo 'BOT ID: ' . $id . PHP_EOL;

    foreach ($instr[$id] as $fn => $target)
        (list($target, $number) = explode('.', $target)) && ${$target}[$number][] = $fn($bot[$id]);

    $bot[$id] = [];
}

echo 'Product: ' . ($output[0][0] * $output[1][0] * $output[2][0]) . PHP_EOL;