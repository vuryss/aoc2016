<?php

$input = '--input--';

$input = explode("\n", $input);
$bot = $instr = $output = [];

// Get bot initial values and instructions
foreach ($input as $k => $row) {
    if (preg_match('/^value\s(\d+)\sgoes\sto\sbot\s(\d+)$/', $row, $matches)) {
        $bot[$matches[2]][] = $matches[1];
    }
    elseif (preg_match('/bot\s(\d+)\sgives\slow\sto\s(bot|output)\s(\d+)\sand\shigh\sto\s(bot|output)\s(\d+)$/', $row, $matches)) {
        $instr[$matches[1]] = ['min' => $matches[2] . '.' . $matches[3], 'max' => $matches[4] . '.' . $matches[5]];
    }
}

// Process instructions
while (($id = getActiveBot()) !== NULL && ($instruction = $instr[$id])) {
    if (in_array(61, $bot[$id]) && in_array(17, $bot[$id]))
        echo 'BOT ID: ' . $id . PHP_EOL;

    foreach ($instruction as $fn => $target) {
        list($target, $number) = explode('.', $target);
        ${$target}[$number][] = $fn($bot[$id]);
    }

    $bot[$id] = [];
}

echo 'Multiplication: ' . ($output[0][0] * $output[1][0] * $output[2][0]) . PHP_EOL;

// Get active BOT
function getActiveBot() {
    global $bot;

    foreach ($bot as $id => $values)
        if (count($values) == 2) return $id;

    return NULL;
}