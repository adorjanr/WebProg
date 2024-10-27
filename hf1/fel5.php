<?php

$x = 4;
$y = 0;
$muv = '/';

switch ($muv) {
    case '+':
        echo "$x + $y = " . $x + $y;
        break;
    case '-':
        echo "$x - $y = " . $x - $y;
        break;
    case '*':
        echo "$x * $y = " . $x * $y;
        break;
    case '/':
        echo $y == 0 ? 'Hiba: 0-val való osztás.' : "$x / $y = " . $x / $y;
        break;
    default:
        echo 'Hiba: nem létező művelet.';
}