<?php

$input = '--input--';

$input = explode("\n", $input);

$keypad = [
	[1,2,3],
	[4,5,6],
	[7,8,9],
];

$x = $y = 1;

$code = '';

foreach ($input as $line) {
	for ($i = 0; $i < strlen($line); $i++)
		switch ($line[$i]) {
			case 'U': $x = --$x < 0 ? 0 : $x; break;
			case 'D': $x = ++$x > 2 ? 2 : $x; break;
			case 'L': $y = --$y < 0 ? 0 : $y; break;
			case 'R': $y = ++$y > 2 ? 2 : $y; break;
		}

	$code .= $keypad[$x][$y];
}

echo $code;