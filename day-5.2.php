<?php

$input    = '--input--';
$i        = 0;
$password = [];

while (true) {
    $hash = md5($input . $i++);

    if (strpos($hash, '00000') === 0) {
        if (!ctype_digit($hash[5]) || (int) $hash[5] > 7 || isset($password[(int) $hash[5]])) continue;
        $password[(int) $hash[5]] = $hash[6];
        if (count($password) == 8) break;
    }
}

ksort($password);

echo implode('', $password);