<?php

$input    = '--input--';
$i        = 0;
$password = [];

while (count($password) != 8) {
    $hash = md5($input . $i++);

    if (strpos($hash, '00000') === 0) {
        if (!ctype_digit($hash[5]) || $hash[5] > 7 || isset($password[$hash[5]])) continue;
        $password[$hash[5]] = $hash[6];
    }
}

ksort($password);

echo implode('', $password);