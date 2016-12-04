<?php

$input = '--input--';

$input = explode("\n", $input);

$kp = [
    [  0 ,  0 , '1',  0 ,  0 ],
    [  0 , '2', '3', '4',  0 ],
    [ '5', '6', '7', '8', '9'],
    [  0 , 'A', 'B', 'C',  0 ],
    [  0 ,  0 , 'D',  0 ,  0 ],
];

$x = 2;
$y = 0;

$code = '';

foreach ($input as $line) {
	for ($i = 0, $len = strlen($line); $i < $len; $i++)
		switch ($line[$i]) {
			case 'U': $x = (--$x < 0 || !$kp[$x][$y]) ? ++$x : $x; break;
			case 'D': $x = (++$x > 4 || !$kp[$x][$y]) ? --$x : $x; break;
			case 'L': $y = (--$y < 0 || !$kp[$x][$y]) ? ++$y : $y; break;
			case 'R': $y = (++$y > 4 || !$kp[$x][$y]) ? --$y : $y; break;
		}

	$code .= $kp[$x][$y];
}

echo $code;