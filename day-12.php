<?php

$input = '--input--';

$input = explode("\n", $input);
$a = $b = $c = $d = 0;

// For part 2 - uncomment
$c = 1;

for ($i = 0, $len = count($input); $i < $len; $i++) {
    $parts = explode(' ' , $input[$i]);

    switch ($parts[0]) {
        case 'cpy':
            is_numeric($parts[1]) ? ${$parts[2]} = (int) $parts[1] : ${$parts[2]} = ${$parts[1]};
            break;
        case 'inc': ${$parts[1]}++; break;
        case 'dec': ${$parts[1]}--; break;
        case 'jnz':
            if (is_numeric($parts[1]) && $parts[1] > 0)
                $i += $parts[2] - 1;
            elseif (!is_numeric($parts[1]) && ${$parts[1]} > 0)
                $i += $parts[2] - 1;
            break;
    }
}

echo 'A: ' . $a . PHP_EOL;