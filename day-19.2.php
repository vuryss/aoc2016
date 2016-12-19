<?php

$input = 0; // Puzzle input

$p = 3 ** (int) log($input, 3);
echo ($p == $input) ? $p : (($input < 2 * $p) ? $input - $p : 2 * $input - 3 * $p);