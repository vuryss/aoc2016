<?php

$input    = '--input--';
$i        = 0;
$password = '';

while (true) {
    $hash = md5($input . $i++);

    if (strpos($hash, '00000') === 0) {
        $password .= $hash[5];
        if (strlen($password) == 8) break;
    }
}

echo $password;