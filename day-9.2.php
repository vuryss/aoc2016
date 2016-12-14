<?php

$input = '--input--';

echo parseSubString($input);

function parseSubString($input)
{
    $length          = strlen($input);
    $bracketPosition = strpos($input, '(');

    if ($bracketPosition === false) return $length;

    for ($i = $bracketPosition; $i < strlen($input); $i++) {
        if (preg_match('/^\((\d+)x(\d+)\)/', substr($input, $i), $matches)) {
            $length     -= strlen($matches[0]);
            $i          += strlen($matches[0]);
            $repeated   = str_repeat(substr($input, $i, $matches[1]), $matches[2]);
            $i          += $matches[1] - 1;
            $length     += parseSubString($repeated) - $matches[1];
        }
    }

    return $length;
}