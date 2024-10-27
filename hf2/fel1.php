<?php

$szam = 10;
$szin = '#a420d4';

$tablazat = function(int $x) use ($szin): void {
    echo '<table border=1>';
    for ($i = 1; $i <= $x; $i++) {
        echo '<tr>';
        for ($j = 1; $j <= $x; $j++) {
            if ($i == $j) echo "<td style='background: $szin '>";
            else echo '<td>';
            echo $i * $j . '</td>';
        }
        echo '</tr>';
    }
echo '</table>';
};

$tablazat($szam);