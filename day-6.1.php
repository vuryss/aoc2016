<?php

$input = '--input--';

$characters = array_map('str_split', explode("\n", $input));
$word = '';

for ($i = 0, $len = count($characters[0]); $i < $len; $i++) {
    $charCount = array_count_values(array_column($characters, $i));
    $word .= array_search(max($charCount), $charCount);
}

echo $word;