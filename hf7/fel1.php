<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_COOKIE['number'])) {
        $number = rand(1,10);
        setcookie('number', $number, time() + 3600, '/');
    }
    else $number = $_COOKIE['number'];
    
    $guess = $_POST['talalgatas'] ?? -1;
    
    if (is_numeric($guess)) {
        if ($guess == $number) {
            unset($_COOKIE['number']);
            setcookie('number', '', time() - 3600, '/');
            echo 'Talált!';
        }
        elseif ($guess > $number) echo 'Kisebb!';
        else echo 'Nagyobb!';
    }
    else echo 'Számot adj meg!';

    echo '<br><br>';
}

?>


<form method="post" action="fel1.php">
    <input type="hidden" name="elkuldott" value="true">
    Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <input type="submit" value="Elküld">
</form>