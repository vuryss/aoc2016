<?php

$input = '--input--';
$input = explode("\n", $input);

$input = array_filter(
    $input,
    function($a) {
        return preg_match('/([a-z])(?!\1)([a-z])\2\1(?![a-z]*\])/', $a)
           && !preg_match('/\[[a-z]*([a-z])(?!\1)([a-z])\2\1(?![a-z]*\[)/', $a);
    }
);

echo count($input);