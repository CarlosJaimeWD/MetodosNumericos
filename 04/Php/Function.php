<?php
error_reporting(0);

$intervalType = $_POST["intervalType"];
$functionType = $_POST["functionType"];
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

switch ($intervalType) {
    case "grados":
        $x0 = deg2rad($intervalA);
        $x1 = deg2rad($intervalB);
        break;
    default:
        $x0 = $intervalA * pi();
        $x1 = $intervalB * pi();
        break;            
} 

$output = "";
$i;

if ($numberRound == null) {
    $xrn = ((f($x0, $array, $functionType) * $x1) - (f($x1, $array, $functionType) * $x0)) / (f($x0, $array, $functionType) - f($x1, $array, $functionType));
    $output .="xrn 1: ".$xrn."<br><br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $x0 = $xrn;
        $xrn = $x1 - (((f($x1, $array, $functionType) * $x0) - (f($x1, $array, $functionType) * $x1)) / (f($x0, $array, $functionType) - f($x1, $array, $functionType)));
        
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
    $fx1 = f($x1, $array, $numberRound, $functionType);
    $xrn = sprintf("%.".$numberRound."f", (($fx1 * ($x0)) - ($fx1 * ($x1))) / (f($x0, $array, $numberRound, $functionType) - ($fx1)));
    $output .="xrn 1: ".$xrn."<br>";
    $output .= "f: ".f($x0, $array, $numberRound, $functionType).", x0: ".$x0."<br>";
    $output .= "f: ".f($x1, $array, $numberRound, $functionType).", x1: ".$x1."<br>";
    $output .= "<br>";
    $i = 2;
    do {
        $xrn2 = $xrn;
        $x0 = $xrn;
        $xrn = sprintf("%.".$numberRound."f", $x1 - ((($fx1 * ($x0)) - ($fx1 * ($x1))) / (f($x0, $array, $numberRound, $functionType) - ($fx1))));
        
        $relativeError = sprintf("%.".$numberRound."f", (abs(($xrn - $xrn2) / $xrn))*100);
        $output .="xrn ".$i.": ".$xrn."<br>";
        $output .="error ".$i.": ".$relativeError."%<br>";
        $output .= "f: ".f($x0, $array, $numberRound, $functionType).", x0: ".$x0."<br>";
        $output .= "f: ".f($x1, $array, $numberRound, $functionType).", x1: ".$x1."<br>";
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

function f ($x, $array, $numberRound, $functionType) {
    $f = 0;
    for ($i=0; $i < sizeof($array); $i++) { 
        $f += ($array[$i]*pow($x, $i));
    }
    //echo "f: ".$f."<br>";
    if ($numberRound == null) {
        switch ($functionType) {
            case "sin" :
                return sin($f);
                break;
            case "cos" :
                return cos($f);
                break;
            case "tan":
                return tan($f);
                break;    
        }
    } else {
        switch ($functionType) {
            case "sin" :
                return sprintf("%.".$numberRound."f", sin($f));
                break;
            case "cos" :
                return sprintf("%.".$numberRound."f", cos($f));
                break;
            case "tan" :
                return sprintf("%.".$numberRound."f", tan($f));
                break;      
        }
    }
}


?>