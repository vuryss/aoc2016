<?php

$input = 'cpy a d
cpy 4 c
cpy 643 b
inc d
dec b
jnz b -2
dec c
jnz c -5
cpy d a
jnz 0 0
cpy a b
cpy 0 a
cpy 2 c
jnz b 2
jnz 1 6
dec b
dec c
jnz c -4
inc a
jnz 1 -7
cpy 2 b
jnz c 2
jnz 1 4
dec b
dec c
jnz 1 -4
jnz 0 0
out b
jnz a -19
jnz 1 -21';

$input = explode("\n", $input);
$a = $b = $c = $d = 0;

$initValue = 0;

while (true) {
    $initial = 0;
    $count = 0;
    $a = $initValue++;

    for ($i = 0, $len = count($input); $i < $len; $i++) {
        $parts = explode(' ', $input[$i]);

        switch ($parts[0]) {
            case 'cpy':
                if (!in_array($parts[2], ['a', 'b', 'c', 'd'])) {
                    break;
                }
                is_numeric($parts[1]) ? ${$parts[2]} = (int) $parts[1] : ${$parts[2]} = ${$parts[1]};
                break;
            case 'inc':
                ${$parts[1]}++;
                break;
            case 'dec':
                ${$parts[1]}--;
                break;
            case 'jnz':
                $offset = is_numeric($parts[2]) ? (int) $parts[2] : ${$parts[2]};

                if (is_numeric($parts[1]) && $parts[1] > 0) {
                    $i += $offset - 1;
                } elseif (!is_numeric($parts[1]) && ${$parts[1]} > 0) {
                    $i += $offset - 1;
                }
                break;
            case 'out':
                $count++;

                if ($initial != ${$parts[1]}) {
                    continue 3;
                }

                if ($count > 25) {
                    echo 'FOUND: ' . ($initValue - 1) . PHP_EOL;
                    exit;
                }

                $initial = (int) !$initial;
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
}