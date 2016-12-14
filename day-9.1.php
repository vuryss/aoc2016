<?php

$input = '--input--';

for ($i = 0; $i < strlen($input); $i++) {
    if (preg_match('/^\((\d+)x(\d+)\)/', substr($input, $i), $matches)) {
        $input = substr_replace($input, '', $i, strlen($matches[0]));
        $toRepeat = substr($input, $i, $matches[1]);
        $input = substr_replace($input, '', $i, $matches[1]);
        $input = substr_replace($input, str_repeat($toRepeat, $matches[2]), $i, 0);
        $i += strlen($toRepeat) * $matches[2] - 1;
    }
}

echo strlen($input);