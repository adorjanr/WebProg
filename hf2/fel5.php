<?php


class BevasarloLista
{
    private array $lista = [];

    public function hozzaad(string $nev, int $mennyiseg, float $egysegar): void
    {
        $termek = [];
        $termek += ['nev' => $nev, 'mennyiseg' => $mennyiseg, 'egysegar' => $egysegar];
        array_push($this->lista, $termek);
    }

    public function torol(string $termekNev): void
    {
        foreach ($this->lista as $index => $termek) {
            // ha megegyezik a név, törli az elemet, de a lista indexelése nem változik
            if ($termek['nev'] == $termekNev) unset($this->lista[$index]);
        }
        // helyreállítja az indexelést
        $this->lista = array_values($this->lista);
    }

    public function osszkoltseg(): float
    {
        $sum = 0;
        foreach ($this->lista as $termek) {
            $sum += $termek['mennyiseg'] * $termek['egysegar'];
        }
        return $sum;
    }

    public function kiir(): void
    {
        foreach ($this->lista as $termek) {
            echo $termek['nev'] . ': ' . $termek['mennyiseg'] . ' db, ' . $termek['egysegar'] . ' RON/db.<br>';
        }
    }
}

// ------ //
// "main" //
// ------ //

$lista = new BevasarloLista();

// hozzáadások
$lista->hozzaad('kenyer', 2, 8.5);
$lista->hozzaad('tej', 1, 4.5);
$lista->hozzaad('tojas', 10, 0.85);
$lista->hozzaad('szalami', 1, 5.5);
echo 'hozzáadás:<br>';
$lista->kiir();

echo '<br>';

// törlések
$lista->torol('tej');
$lista->torol('tojas');
echo 'törlés után:<br>';
$lista->kiir();

echo '<br>';

// összköltség
$ossz = $lista->osszkoltseg();
echo "Összesen: $ossz RON";