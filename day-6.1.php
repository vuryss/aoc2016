<?php

$input = '--input--';

$inputRows  = explode("\n", $input);
$characters = [];

foreach ($inputRows as $row)
    foreach (str_split($row) as $index => $character)
        $characters[$index][$character] = ($characters[$index][$character] ?? 0) + 1;

array_walk($characters, 'arsort');
$characters = array_map('array_flip', $characters);
$characters = array_map('reset', $characters);

echo implode('', $characters);