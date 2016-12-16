<?php

ini_set('memory_limit', -1);

$input = '--input--'; // Input
$size  = 0; // Disk size

while (strlen($input) < $size && ($a = $b = $input))
    $input = $a . '0' . strtr(strrev($b), '01', '10');

$input      = substr($input, 0, $size);
$checksum   = $input;

do {
    $parts = str_split($checksum, 2);
    $checksum = '';

    foreach ($parts as $part)
        if ($part[0] == $part[1]) $checksum .= '1';
        else $checksum .= '0';
} while (strlen($checksum) % 2 == 0);

echo $checksum . PHP_EOL;