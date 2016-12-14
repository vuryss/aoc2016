<?php

$input = '--input--';

$i = $keys = 0;
$hashes = [];

while (true) {
    if (empty($hashes[$i])) {
        $hash = md5($input . $i);
        for ($a = 0; $a < 2016; $a++) $hash = md5($hash);
        $hashes[$i] = $hash;
    }

    if (preg_match('/([0-9abcdef])\1{2}/', $hashes[$i], $matches)) {
        for ($j = $i + 1; $j <= $i + 1001; $j++) {
            if (empty($hashes[$j])) {
                $hash = md5($input . $j);
                for ($a = 0; $a < 2016; $a++) $hash = md5($hash);
                $hashes[$j] = $hash;
            }

            if (preg_match('/(' . $matches[1] . '){5}/', $hashes[$j])) {
                if (++$keys == 64) {
                    echo 'Index: ' . $i . PHP_EOL;
                    exit;
                }
                break;
            }
        }
    }
    $i++;
}

