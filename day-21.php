<?php

$input    = '--input--';
$password = 'abcdefgh';

class Scrambler
{
    private $len = 0;

    public function scramble($password, $operations)
    {
        echo 'Input: ' . $password . PHP_EOL;
        $this->len = strlen($password);

        foreach ($this->parseOperations($operations) as $op) {
            switch (1) {
                case preg_match('/^swap\sposition.*(\d).*(\d)/', $op, $matches):
                    $password = $this->swapPosition($password, $matches[1], $matches[2]);
                    break;

                case preg_match('/^swap\sletter\s(\w).*letter\s(\w)/', $op, $matches):
                    $password = $this->swapLetter($password, $matches[1], $matches[2]);
                    break;

                case preg_match('/^rotate\sleft\s(\d)/', $op, $matches):
                    $password = $this->rotateLeft($password, $matches[1]);
                    break;

                case preg_match('/^rotate\sright\s(\d)/', $op, $matches):
                    $password = $this->rotateRight($password, $matches[1]);
                    break;

                case preg_match('/^rotate\sbased.*letter\s(\w)/', $op, $matches):
                    $password = $this->rotatePosition($password, $matches[1]);
                    break;

                case preg_match('/^reverse.*(\d).*(\d)/', $op, $matches):
                    $password = $this->reverse($password, $matches[1], $matches[2]);
                    break;

                case preg_match('/^move.*(\d).*(\d)/', $op, $matches):
                    $password = $this->move($password, $matches[1], $matches[2]);
                    break;
            }
        }

        echo 'Output: ' . $password . PHP_EOL;
    }

    public function unscramble($password, $operations)
    {
        echo 'Input: ' . $password . PHP_EOL;
        $this->len = strlen($password);

        foreach (array_reverse($this->parseOperations($operations)) as $op) {
            switch (1) {
                case preg_match('/^swap\sposition.*(\d).*(\d)/', $op, $matches):
                    $password = $this->swapPosition($password, $matches[2], $matches[1]);
                    break;

                case preg_match('/^swap\sletter\s(\w).*letter\s(\w)/', $op, $matches):
                    $password = $this->swapLetter($password, $matches[2], $matches[1]);
                    break;

                case preg_match('/^rotate\sleft\s(\d)/', $op, $matches):
                    $password = $this->rotateRight($password, $matches[1]);
                    break;

                case preg_match('/^rotate\sright\s(\d)/', $op, $matches):
                    $password = $this->rotateLeft($password, $matches[1]);
                    break;

                case preg_match('/^rotate\sbased.*letter\s(\w)/', $op, $matches):
                    $index      = strpos($password, $matches[1]);
                    $reverseMap = [9, 1, 6, 2, 7, 3, 8, 4];

                    $password = $this->rotateLeft($password, $reverseMap[$index]);
                    break;

                case preg_match('/^reverse.*(\d).*(\d)/', $op, $matches):
                    $password = $this->reverse($password, $matches[1], $matches[2]);
                    break;

                case preg_match('/^move.*(\d).*(\d)/', $op, $matches):
                    $password = $this->move($password, $matches[2], $matches[1]);
                    break;
            }
        }

        echo 'Output: ' . $password . PHP_EOL;
    }

    private function swapPosition($string, $x, $y)
    {
        return $this->swapLetter($string, $string[$x], $string[$y]);
    }

    private function swapLetter($string, $x, $y)
    {
        return strtr($string, [$x => $y, $y => $x]);
    }

    private function rotateLeft($s, $x)
    {
        $p = $x % $this->len;
        return substr($s, $p) . substr($s, 0, $p);
    }

    private function rotateRight($s, $x)
    {
        return $this->rotateLeft($s, 8 - $x);
    }

    private function rotatePosition($string, $l)
    {
        $index     = strpos($string, $l);
        $rotations = 1 + $index + ($index >= 4 ? 1 : 0);

        return $this->rotateRight($string, $rotations);
    }

    private function reverse($string, $x, $y)
    {
        $reversed = strrev(substr($string, $x, $y - $x + 1));

        return ($x - 1 >= 0 ? substr($string, 0, $x) : '')
            . $reversed
            . ($y < $this->len - 1 ? substr($string, $y + 1) : '');
    }

    private function move($string, $x, $y)
    {
        $letter = $string[$x];
        $string = substr_replace($string, '', $x, 1);
        return substr_replace($string, $letter, $y, 0);
    }

    private function parseOperations($operations)
    {
        return explode("\n", $operations);
    }
}

$scrambler = new Scrambler();
$scrambler->scramble('abcdefgh', $input);
$scrambler->unscramble('fbgdceah', $input);
