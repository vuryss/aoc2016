<?php

$input = '--input--';
$input = explode("\n", $input);

$input = array_filter(
    $input,
    function($a) {
        if (!preg_match_all('/([a-z])(?!\1)(?=([a-z])\1)(?![a-z]*\])/', $a, $matches)) return false;

        $needed = [];

        foreach ($matches[1] as $i => $v)
            $needed[] = $matches[2][$i] . $v . $matches[2][$i];

        return preg_match('/\[[a-z]*(' . implode('|', $needed) . ')[a-z]*\]/', $a);
    }
);

echo count($input);