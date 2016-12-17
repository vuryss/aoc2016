<?php

$input = '--input--';

$x = $y = 0;
$stack = [[$x, $y, '']];
$open = ['b', 'c', 'd', 'e', 'f'];

while ($pos = array_shift($stack)) {
    if ($pos[0] == 3 && $pos[1] == 3) {
        echo 'Shortest path: ' . $pos[2] . PHP_EOL;
        exit;
    }

    $hash = md5($input . $pos[2]);

    if ($pos[1] - 1 >= 0 && in_array($hash[0], $open)) $stack[] = [$pos[0], $pos[1] - 1, $pos[2] . 'U'];
    if ($pos[1] + 1 <= 3 && in_array($hash[1], $open)) $stack[] = [$pos[0], $pos[1] + 1, $pos[2] . 'D'];
    if ($pos[0] - 1 >= 0 && in_array($hash[2], $open)) $stack[] = [$pos[0] - 1, $pos[1], $pos[2] . 'L'];
    if ($pos[0] + 1 <= 3 && in_array($hash[3], $open)) $stack[] = [$pos[0] + 1, $pos[1], $pos[2] . 'R'];
}