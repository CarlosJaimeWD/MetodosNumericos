<?php
//error_reporting(0);

$initialValue = $_POST["initialValue"];
$percentageError = $_POST["percentageError"];
$numberRound = $_POST["numberRound"];

$x0 = $_POST["x0"];
$x1 = $_POST["x1"];
$x2 = $_POST["x2"];
$x3 = $_POST["x3"];
$x4 = $_POST["x4"];
$x5 = $_POST["x5"];
$x6 = $_POST["x6"];
$array[0] = $x0;
$array[1] = $x1;
$array[2] = $x2;
$array[3] = $x3;
$array[4] = $x4;
$array[5] = $x5;
$array[6] = $x6;
$array2 = fd($array);
$output = "";
$i = 1;

if ($numberRound == null) {
    do {
        if ($i == 1) {
            $xrn2 = $initialValue;
        } else {
            $xrn2 = $xrn;
        }
        
        $xrn = sprintf("%.".$numberRound."f", $xrn2 - ((f($xrn2, $array, null)) / f($xrn2, $array2, null)) );
        $relativeError = sprintf("%.".$numberRound."f", (abs(($xrn - $xrn2) / $xrn))*100);
        $output .="x ".$i.": ".$xrn."<br>";
        $output .= "f: ".f($xrn2, $array, null).", f': ".f($xrn2, $array2, null)."<br>";
        $output .="error ".$i.": ".$relativeError."%<br>";
        $output .="<br>";
        $i++;
        if ($i == 50) {
            break;
        }
    } while ($percentageError <= $relativeError);
} else {
    do {
        if ($i == 1) {
            $xrn2 = $initialValue;
        } else {
            $xrn2 = $xrn;
        }
        
        $xrn = sprintf("%.".$numberRound."f", $xrn2 - ((f($xrn2, $array, $numberRound)) / f($xrn2, $array2, $numberRound)) );
        $relativeError = sprintf("%.".$numberRound."f", (abs(($xrn - $xrn2) / $xrn))*100);
        $output .="x ".$i.": ".$xrn."<br>";
        $output .= "f: ".f($xrn2, $array, $numberRound).", f': ".f($xrn2, $array2, $numberRound)."<br>";
        $output .="error ".$i.": ".$relativeError."%<br>";
        $output .="<br>";
        $i++;
        if ($i == 50) {
            break;
        }
    } while ($percentageError <= $relativeError);
}

if ($i == 50 && $relativeError > 100) {
    $output .= "<div id='output'>No se pudo encontrar una respuesta</div>";
} else {
    $output .= "<div id='output'>x: ".$xrn."</div>";
}
echo $output;

function f ($x, $array, $numberRound) {
    $f = 0;
    for ($i=0; $i < sizeof($array); $i++) { 
        $f += ($array[$i]*pow($x, $i));
    }
    //echo "f: ".$f."<br>";
    if ($numberRound == null) {
        return $f;
    } else {
        return sprintf("%.".$numberRound."f", $f);
    }
}

function fd ($array) {
    $f;
    for ($i = sizeof($array) - 1; $i > 0; $i--) { 
        $f[$i-1] = $array[$i] * $i;
    }
    return $f;
}


?>