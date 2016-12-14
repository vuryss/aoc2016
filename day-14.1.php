<?php

$input = '--input--';

$i = $keys = 0;

while (true) {
    if (preg_match('/([0-9abcdef])\1{2}/', md5($input . $i), $matches))
        for ($j = $i + 1; $j <= $i + 1001; $j++)
            if (preg_match('/(' . $matches[1] . '){5}/', md5($input . $j))) {
                if (++$keys == 64) {
                    echo 'Index: ' . $i . PHP_EOL;
                    exit;
                }
                break;
            }
    $i++;
}

