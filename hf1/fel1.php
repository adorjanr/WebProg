<?php

$lista = [5, '5', '05', 12.3, '16.7', 'five', 'true', '10e200'];

foreach ($lista as $elem) {
    $type = gettype($elem);
    $isNumeric = is_numeric($elem) ? 'true' : 'false';
    echo "$elem: $type - szám: $isNumeric<br>";
}