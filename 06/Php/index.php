<?php
$array[0] = -1;
$array[1] = -1;
$array[2] = 0;
$array[3] = 1;
$intervalA = 1; //$x0
$intervalB = 2; //$x1
$percentageError = 0.005;
$relativeError = 0;
$x0 = $intervalA;
$x1 = $intervalB;

$xrn = sprintf("%.4f", ((f($x0, $array) * $x1) - (f($x1, $array) * $x0)) / (f($x0, $array) - f($x1, $array)));
echo "xrn 1: ".$xrn."<br><br>";
$i = 2;
do {
    $xrn2 = $xrn;
    $x0 = $xrn;
    $xrn = sprintf("%.4f", $x1 - (((f($x1, $array) * $x0) - (f($x1, $array) * $x1)) / (f($x0, $array) - f($x1, $array))));
    
    $relativeError = sprintf("%.4f", (abs(($xrn - $xrn2) / $xrn))*100);
    echo "xrn ".$i.": ".$xrn."<br>";
    echo "error ".$i.": ".$relativeError."%<br>";
    echo "<br>";
    $i++;
} while ($percentageError <= $relativeError);

/*$xrn = ((f($x0, $array) * $x1) - (f($x1, $array) * $x0)) / (f($x0, $array) - f($x1, $array));
$i = 0;
do {
    $xrn2 = $xrn;
    $x0 = $xrn;
    $xrn = $x1 - (((f($x1, $array) * $x0) - (f($x1, $array) * $x1)) / (f($x0, $array) - f($x1, $array)));
    
    $relativeError = (abs(($xrn - $xrn2) / $xrn))*100;
    echo "xrn".$i.": ".$xrn."<br>";
    echo "error".$i.": ".$relativeError."<br>";
    echo "<br>";
    $i++;
} while ($percentageError <= $relativeError);*/

function f ($x, $array) {
    $f = 0;
    for ($i=0; $i < sizeof($array); $i++) { 
        $f += ($array[$i]*pow($x, $i));
    }
    //echo "f: ".$f."<br>";
    return sprintf("%.4f", $f);
}


?>