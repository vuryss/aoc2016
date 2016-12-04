<?php

$input = '--input--';
$input = explode(', ', $input);

$dirs = 'NESW';
$dir = 'N';
$x = $y = 0;

foreach ($input as $move) {
    $i   = strpos($dirs, $dir);
    $dir = ($move[0] === 'R') ? ($dirs[++$i] ?? $dirs[0]) : ($dirs[--$i] ?? $dirs[3]);
    $len = (int) substr($move, 1);

    switch ($dir) {
        case 'N': $y += $len; break;
        case 'E': $x += $len; break;
        case 'S': $y -= $len; break;
        case 'W': $x -= $len; break;
    }
}

echo abs($x) + abs($y);