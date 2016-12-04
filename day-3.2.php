<?php

$input = '--input--';

$input = array_map('trim', explode("\n", $input));
$v     = [];
$rows  = count($input);
$i     = 0;

foreach ($input as $line)
    list($v[$i], $v[$i + $rows], $v[$i++ + $rows * 2]) = array_values(array_filter(explode(' ', $line)));


$rows     = count($v);
$possible = 0;

for ($i = 0; $i < $rows; $i = $i + 3)
    if ($v[$i] + $v[$i+1] > $v[$i+2] && $v[$i+2] + $v[$i+1] > $v[$i] && $v[$i] + $v[$i+2] > $v[$i+1])
        $possible++;

echo $possible;