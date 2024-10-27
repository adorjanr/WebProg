<?php


class ArrayManipulator
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        if (!property_exists($this, $name))
            echo "Hiba __get(): nem létezik '$name' nevű adattag.<br>";
        else echo "Hiba __get(): nem elérhető '$name' nevű adattag.<br>";
    }

    public function __set($name, $value)
    {
        if (is_array($value)) $value = '[' . implode(', ', $value) . ']';
        echo "Hiba __set(): a(z) '$name' nevű adattagnak nem adható át '$value' érték, mert "; 
        if (!property_exists($this, $name)) 
            echo 'nem létezik ilyen adattag.<br>';
        else echo 'nem elérhető az adattag.<br>';
    }

    public function __isset($name)
    {
        if (!property_exists($this, $name))
            echo "Hiba __isset(): nem létezik '$name' nevű adattag.<br>";
        else echo "Hiba __isset(): nem elérhető '$name' nevű adattag.<br>";
    }

    public function __unset($name)
    {
        if (!property_exists($this, $name))
            echo "Hiba __unset(): nem létezik '$name' nevű adattag.<br>";
        else echo "Hiba __unset(): nem elérhető '$name' nevű adattag.<br>";
    }
}

// ------ //
// "main" //
// ------ //

$test = new ArrayManipulator([1, 2, 3]);

// nem elérhető
print_r($test->data);
$test->data = [4, 5, 6];
echo isset($test->data);
unset($test->data);

// nem létező
echo $test->kutya;
$test->kutya = 'Buksi';
echo isset($test->kutya);
unset($test->kutya);