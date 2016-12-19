<?php

$input = 0; // Puzzle input

echo 'Position: ' . (2 * ($input - (2 ** (int) log($input, 2))) + 1) . PHP_EOL;