<?php
error_reporting(0);

$intervalA = $_POST["intervalA"];
$intervalB = $_POST["intervalB"];
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
$xi1 = $intervalA;
$xi = $intervalB;
$output = "";
$i;

if ($numberRound == null) {
    $xrn = $xi - ((f($xi, $array) * (($xi1) - ($xi))) / (f($xi1, $array) - f($xi, $array)));
    $output .="x1: ".$xrn."<br><br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $xi1 = $xi;
        $xi = $xrn;
        $xrn = $xrn2 - ((f($xi, $array) * (($xi1) - ($xi))) / (f($xi1, $array) - f($xi, $array)));
        
        $relativeError = (abs(($xrn - $xrn2) / $xrn))*100;
        $output .="x".$i.": ".$xrn."<br>";
        $output .="error".$i.": ".$relativeError."<br>";
        $output .="<br>";
        $i++;

        if ($i == 50) {
            break;
        }
    } while ($percentageError <= $relativeError);
} else {
    $xrn = sprintf("%.".$numberRound."f", $xi - ((f($xi, $array, $numberRound) * (($xi1) - ($xi))) / (f($xi1, $array, $numberRound) - f($xi, $array, $numberRound))) );
    $output .="x1: ".$xrn."<br>";
    $output .= "fxi: ".f($xi, $array, $numberRound)."<br>";
    $output .= "fxi1: ".f($xi1, $array, $numberRound)."<br>";
    $output .= "<br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $xi1 = $xi;
        $xi = $xrn;
        $xrn = sprintf("%.".$numberRound."f", $xrn2 - ((f($xi, $array, $numberRound) * (($xi1) - ($xi))) / (f($xi1, $array, $numberRound) - f($xi, $array, $numberRound))) );
        
        $relativeError = sprintf("%.".$numberRound."f", (abs(($xrn - $xrn2) / $xrn))*100);
        $output .="x ".$i.": ".$xrn."<br>";
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


?>