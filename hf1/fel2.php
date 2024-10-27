<?php

$mp = 5400;

if (is_int($mp)) {
    $ora = $mp == 0 ? 0 : $mp / 3600;
    echo "<h3>$mp másodperc = $ora óra</h3>";
}
else echo 'Hiba: a megadott érték nem egész szám';