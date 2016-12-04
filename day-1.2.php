<?php

$input = '--input--';
$input = explode(', ', $input);

$dirs = 'NESW';
$dir = 'N';
$x = $y = 0;
$vs = [0 => [0 => true]];

foreach ($input as $move) {
    $i   = strpos($dirs, $dir);
    $dir = ($move[0] === 'R') ? ($dirs[++$i] ?? $dirs[0]) : ($dirs[--$i] ?? $dirs[3]);
    $len = (int) substr($move, 1);

    if ($dir == 'N' || $dir == 'S') $a = &$y;
    else $a = &$x;

    if ($dir == 'N' || $dir == 'E') {
        for ($end = $a++ + $len; $a < $end;) {
            check($a++);
            $vs[$x][$y] = true;
        }
    }
    else {
        for ($end = $a-- - $len; $a > $end;) {
            check($a--);
            $vs[$x][$y] = true;
        }
    }
}

function check() {
    global $x, $y, $vs;

    if (!empty($vs[$x][$y])) {
        echo abs($x) + abs($y);
        exit;
    }
}