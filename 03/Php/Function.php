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
$x0 = $intervalA;
$x1 = $intervalB;
$output = "";
$i;

if ($numberRound == null) {
    $xrn = ((f($x0, $array) * $x1) - (f($x1, $array) * $x0)) / (f($x0, $array) - f($x1, $array));
    $output .="xrn 1: ".$xrn."<br><br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $x0 = $xrn;
        $xrn = $x1 - (((f($x1, $array) * $x0) - (f($x1, $array) * $x1)) / (f($x0, $array) - f($x1, $array)));
        
        $relativeError = (abs(($xrn - $xrn2) / $xrn))*100;
        $output .="xrn".$i.": ".$xrn."<br>";
        $output .="error".$i.": ".$relativeError."<br>";
        $output .="<br>";
        $i++;

        if ($i == 50) {
            break;
        }
    } while ($percentageError <= $relativeError);
} else {
    $xrn = sprintf("%.".$numberRound."f", ((f($x0, $array, $numberRound) * $x1) - (f($x1, $array, $numberRound) * $x0)) / (f($x0, $array, $numberRound) - f($x1, $array, $numberRound)));
    $output .="xrn 1: ".$xrn."<br><br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $x0 = $xrn;
        $xrn = sprintf("%.".$numberRound."f", $x1 - (((f($x1, $array, $numberRound) * $x0) - (f($x1, $array, $numberRound) * $x1)) / (f($x0, $array, $numberRound) - f($x1, $array, $numberRound))));
        
        $relativeError = sprintf("%.".$numberRound."f", (abs(($xrn - $xrn2) / $xrn))*100);
        $output .="xrn ".$i.": ".$xrn."<br>";
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