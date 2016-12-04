<?php

$input = '--input--';

$input = array_filter(
    array_map('trim', explode("\n", $input)),
    function($row) {
        list($a, $b, $c) = array_values(array_filter(explode(' ', $row)));

        return $a + $b > $c && $a + $c > $b && $b + $c > $a;
    }
);

echo count($input);