<?php

session_start();
$_SESSION["count"] = isset($_SESSION["count"]) ? $_SESSION["count"] + 1 : 1;

?>


<h2>Oldal megtekintve : <?=$_SESSION["count"];?> alkalommal</h2>
<a href="fel3.php">Következő</a> 