<?php

    $intervalA = -3;
    $intervalB = 6;
    $numberX0 = 1;
    $numberX1 = -1;
    $numberX2 = -3;
    $numberX3 = 3;
    $percentageError = .005;
    $grade = 3;
    $array = array(1,-1,-3,3);
    $r = [];

    $fA = f($array, $intervalA);
    $fB = f($array, $intervalB);

    $validateRoot = $fA * $fB;

    echo $validateRoot;
    
    function f ($array, $x) {
        $f = 0;
        for ($i=0; $i < sizeof($array); $i++) { 
            $f += ($array[$i]*pow($x, $i));
        }
        return $f;
    }

    /*function f ($x6, $x5, $x4, $x3, $x2, $x1, $x0, $interval) {
        switch (grade) {
            case 3:
                $x = ($x3*($interval)^3) + ($x2*($interval)^2) + ($x3*($interval)^1) 
                break; 
        }
    }*/

?>