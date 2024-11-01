<?php

session_start();
if (isset($_POST['addA']))
    $_SESSION['a'] = isset($_SESSION['a']) ? $_SESSION['a'] + 1 : 1;
if (isset($_POST['addB']))
    $_SESSION['b'] = isset($_SESSION['b']) ? $_SESSION['b'] + 1 : 1;
if (isset($_POST['addC']))
    $_SESSION['c'] = isset($_SESSION['c']) ? $_SESSION['c'] + 1 : 1;

$a = $_SESSION['a'] ?? 0;
$b = $_SESSION['b'] ?? 0;
$c = $_SESSION['c'] ?? 0;
$priceA = 10.99;
$priceB = 14.99;
$priceC = 19.99;
$_SESSION['priceA'] = $priceA;
$_SESSION['priceB'] = $priceB;
$_SESSION['priceC'] = $priceC;

?>


<h2>Product List</h2>
<form action="index.php" method="post">
    <ul>
        <li>Product A - $<?=$priceA?> <input type="submit" name="addA" value="Add to cart"> (<?=$a?>)</li>
        <li>Product B - $<?=$priceB?> <input type="submit" name="addB" value="Add to cart"> (<?=$b?>)</li>
        <li>Product C - $<?=$priceC?> <input type="submit" name="addC" value="Add to cart"> (<?=$c?>)</li>
    </ul>
</form>
<a href="cart.php"><button>View cart</button></a>