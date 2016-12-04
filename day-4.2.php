<?php

$input = '--input--';

$input = explode("\n", $input);

foreach ($input as $row) {
    preg_match('/^([a-z-]+)\-(\d+)\[([a-z]{5})\]$/', $row, $matches);

    $chars = count_chars(strtr($matches[1], ['-' => '']), 1);
    $vSort = $kSort = $letters = [];

    array_walk(
        $chars,
        function($v, $k) use (&$vSort, &$kSort, &$letters) {
            $vSort[] = $v;
            $kSort[] = $k;
            $letters[chr($k)] = $v;
        }
    );

    array_multisort($vSort, SORT_DESC, $kSort, SORT_ASC, $letters);

    if (implode('', array_keys(array_slice($letters, 0, 5))) !== $matches[3]) {
        continue;
    }

    $decoded = implode(
        '',
        array_map(
            function($v) use ($matches) {
                if ($v === '-') return ' ';

                $ascii = ord($v) + ((int) $matches[2] % 26);
                return chr($ascii > 122 ? $ascii - 26 : $ascii);
            },
            str_split($matches[1])
        )
    );

    if (strpos($decoded, 'north') !== false) {
        echo $matches[2];
        break;
    }
}