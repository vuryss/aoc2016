<?php

$input = 'cpy a b
dec b
cpy a d
cpy 0 a
cpy b c
inc a
dec c
jnz c -2
dec d
jnz d -5
dec b
cpy b c
cpy c d
dec d
inc c
jnz d -2
tgl c
cpy -16 c
jnz 1 c
cpy 77 c
jnz 73 d
inc a
inc d
jnz d -2
inc c
jnz c -5';

$input = explode("\n", $input);
$a = $b = $c = $d = 0;

$a = 7;

for ($i = 0, $len = count($input); $i < $len; $i++) {
    $parts = explode(' ' , $input[$i]);

    switch ($parts[0]) {
        case 'cpy':
            if (!in_array($parts[2], ['a', 'b', 'c', 'd'])) break;
            is_numeric($parts[1]) ? ${$parts[2]} = (int) $parts[1] : ${$parts[2]} = ${$parts[1]};
            break;
        case 'inc': ${$parts[1]}++; break;
        case 'dec': ${$parts[1]}--; break;
        case 'jnz':
            $offset = is_numeric($parts[2]) ? (int) $parts[2] : ${$parts[2]};

            if (is_numeric($parts[1]) && $parts[1] > 0)
                $i += $offset - 1;
            elseif (!is_numeric($parts[1]) && ${$parts[1]} > 0)
                $i += $offset - 1;
            break;
        case 'tgl':
            $target = $i + (int) ${$parts[1]};

            if (empty($input[$target])) {
                break;
            }

            $targetParts = explode(' ', $input[$target]);

            switch ($targetParts[0]) {
                case 'cpy':
                    $input[$target] = str_replace('cpy', 'jnz', $input[$target]);
                    break;
                case 'inc':
                    $input[$target] = str_replace('inc', 'dec', $input[$target]);
                    break;
                case 'dec':
                    $input[$target] = str_replace('dec', 'inc', $input[$target]);
                    break;
                case 'jnz':
                    $input[$target] = str_replace('jnz', 'cpy', $input[$target]);
                    break;
                case 'tgl':
                    $input[$target] = str_replace('tgl', 'inc', $input[$target]);
                    break;
            }

            break;
    }
}

echo 'A: ' . $a . PHP_EOL;