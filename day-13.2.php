<?php

$input = '--input--';

$matrix = $passed = [];
$px = $py = 1;
$stack = [[$px, $py, 0]];

for ($y = 0; $y < 50; $y++)
    for ($x = 0; $x < 50; $x++)
        $matrix[$y][$x] = substr_count(decbin($x*$x + 3*$x + 2*$x*$y + $y + $y*$y + $input), '1') % 2 == 0 ? true : false;

while ($p = array_shift($stack)) {
    $passed[$p[0]][$p[1]] = true;

    // Stop at 50 steps
    if ($p[2] == 50) continue;

    // Top
    $x = $p[0]; $y = $p[1] - 1;
    if (!empty($matrix[$y][$x]) && empty($passed[$x][$y])) $stack[] = [$p[0], $p[1] - 1, $p[2] + 1];

    // Right
    $x = $p[0] + 1; $y = $p[1];
    if (!empty($matrix[$y][$x]) && empty($passed[$x][$y])) $stack[] = [$p[0] + 1, $p[1], $p[2] + 1];

    // Bottom
    $x = $p[0]; $y = $p[1] + 1;
    if (!empty($matrix[$y][$x]) && empty($passed[$x][$y])) $stack[] = [$p[0], $p[1] + 1, $p[2] + 1];

    // Left
    $x = $p[0] - 1; $y = $p[1];
    if (!empty($matrix[$y][$x]) && empty($passed[$x][$y])) $stack[] = [$p[0] - 1, $p[1], $p[2] + 1];
}

echo 'Max: ' . (count($passed, COUNT_RECURSIVE) - count($passed)) . PHP_EOL;