<?php

$input    = '--input--';
$i        = 0;
$password = '';

while (strlen($password) != 8) {
    $hash = md5($input . $i++);
    if (strpos($hash, '00000') === 0) $password .= $hash[5];
}

echo $password;