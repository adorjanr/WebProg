<?php

$szinek = ['A' => 'Kek', 'B' => 'Zold', 'C' => 'Piros'];

// klasszikus
$lcSzinek = [];
$ucSzinek = [];

foreach ($szinek as $index => $szin) {
    $lcSzinek[$index] = strtolower($szin);
    $ucSzinek[$index] = strtoupper($szin);
}

// array_map()
function atalakit(string $elem, string $formazas = 'nagybetus'): string
{
    if ($formazas == 'kisbetus') return strtolower($elem);
    if ($formazas == 'nagybetus') return strtoupper($elem);
    return 'Hiba: nem létező formázás.';
}

$atalakitottSzinek = array_map('atalakit', $szinek);

// kiíratások
echo 'klasszikus:<br>';
print_r($lcSzinek);
echo '<br>';
print_r($ucSzinek);

echo '<br><br>';

echo 'array_map():<br>';
print_r($atalakitottSzinek);