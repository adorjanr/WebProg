<?php

session_start();
if (isset($_POST['removeA'], $_SESSION['a']) && $_SESSION['a'] > 0)
    $_SESSION['a'] -= 1;
if (isset($_POST['removeB'], $_SESSION['b']) && $_SESSION['b'] > 0)
    $_SESSION['b'] -= 1;
if (isset($_POST['removeC'], $_SESSION['c']) && $_SESSION['c'] > 0)
    $_SESSION['c'] -= 1;

$a = $_SESSION['a'] ?? 0;
$b = $_SESSION['b'] ?? 0;
$c = $_SESSION['c'] ?? 0;
$priceA = $_SESSION['priceA'] ?? null;
$priceB = $_SESSION['priceB'] ?? null;
$priceC = $_SESSION['priceC'] ?? null;

$total = $a * $priceA + $b * $priceB + $c * $priceC;

?>


<h2>Shopping Cart</h2>
<form action="cart.php" method="post">
    <ul>
        <li>Product A - $<?=$priceA?> (Quantity: <?=$a?>)
        <input type="submit" name="removeA" value="Remove from cart"></li>
        <li>Product B - $<?=$priceB?> (Quantity: <?=$b?>)
        <input type="submit" name="removeB" value="Remove from cart"></li>
        <li>Product C - $<?=$priceC?> (Quantity: <?=$c?>)
        <input type="submit" name="removeC" value="Remove from cart"></li>
    </ul>
</form>
<p>Total Price: $<?=$total?></p>
<br>
<a href="index.php"><button>Back</button></a>