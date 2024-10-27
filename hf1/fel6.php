<?php

$honap = "március";

// if - else
$tel = ["december", "január", "február"];
$tavasz = ["március", "április", "május"];
$nyar = ["június", "július", "augusztus"];
$osz = ["szeptember", "október", "november"];

echo 'if - else:<br>';
if (in_array($honap, $tel)) echo $honap . ": tél";
elseif (in_array($honap, $tavasz)) echo $honap . ": tavasz";
elseif (in_array($honap, $nyar)) echo $honap . ": nyár";
elseif (in_array($honap, $osz)) echo $honap . ": ősz";

echo '<br><br>';

// switch
echo 'switch:<br>';
switch ($honap) {
    case "december":
    case "január":
    case "február":
        echo $honap . ": tél";
        break;
    case "március":
    case "április":
    case "május":
        echo $honap . ": tavasz";
        break;
    case "június":
    case "július":
    case "augusztus":
        echo $honap . ": nyár";
        break;
    case "szeptember":
    case "október":
    case "november":
        echo $honap . ": ősz";
        break;
    default: break;
}