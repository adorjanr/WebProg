<?php

$napok = [
    'HU' => ['H', 'K', 'Sze', 'Cs', 'P', 'Szo', 'V'],
    'EN' => ['M', 'Tu', 'W', 'Th', 'F', 'Sa', 'Su'],
    'DE' => ['Mo', 'Di', 'Mi', 'Do', 'F', 'Sa', 'So']
];

foreach ($napok as $nyelv => $nap) {
    echo "$nyelv: ";
    for ($i = 0; $i < count($nap); $i++) {
        if ($i % 2 == 1) echo "<strong>$nap[$i]</strong>";
        else echo $nap[$i];
        // amíg nem az utolsó elemnél vagyunk, addig tegyen vesszőt az elemek közé
        if ($i != count($nap) - 1) echo ', ';
    }
    echo '<br>';
}