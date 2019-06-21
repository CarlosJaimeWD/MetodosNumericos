<?php
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
    //$array = array(-5,-1,2,-5,0,2);
    //$array = array(1,-1,-3,3);

    $relativeError = 0;
    $output = "";
    $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
    $sd1 = syntheticDivision($intervalA, $array);
    $sd2 = syntheticDivision($intervalB, $array);
    $x = syntheticDivision(1.5 , $array);
                    $xr = syntheticDivision(1.5 , $x);
                    
    $output .= "".print_r($x)."";
    $output .= "".print_r($xr)."";
    /*if ($sd1 > 0 && $sd2 < 0 || $sd1 < 0 && $sd2 > 0) {
                $intervalA = $sd1;
                $intervalB = $sd2;
                $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
                $fMidle = 0;
                $i = 0;
    
                do {
                    $x = syntheticDivision($midlePoint, $array);
                    $xr = syntheticDivision($midlePoint, $x);

                    $xf = ($midlePoint) - (($x[]) / ());
    
                    $relativeError = round((abs(($fMidle - ($fMidleBefore)) / $fMidle)) * 100, $numberRound);
                    $relativeError2 = round(abs($fMidle - $fMidleBefore), $numberRound);
    
                    $output .= "fMidle (".$midlePoint."): " . $fMidle . "</br>";
                    $output .= "Error ".$i.": " . $relativeError . " %, ".$relativeError2."</br>";
                    $output .= "f(A): " . $fA . ",  f(B): ".$fB."</br>";
                    $output .= "</br>";
    
                    $i++;
    
                } while ($relativeError >= $percentageError); 
        $output .= "<div id='output'>x: ".$midlePoint."</div>";
    } else if ($sd1 == 0) {
        //encontro la respuesta x en el primer intervalo
    } else if ($sd2 == 0) {
        //encontro la respuesta x en el segundo intervalo
    } else {
        $output .= "la respuesta no esta dentro del intervalo";
    } */
    /*i*/
    echo $output;
    
    function f ($x, $array) {
        $f = 0;
        for ($i=0; $i < sizeof($array); $i++) { 
            $f += ($array[$i]*pow($x, $i));
        }
        return $f;
    }

    function midlePoint ($intervalA, $intervalB) {
        $x = 0;
        $x = ($intervalA + ($intervalB)) / 2;
        return $x;
    }

    function syntheticDivision ($x, $array) {
        $f = 0;
        $x1 = 0;
        $array2 = array();
        for ($i=sizeof($array)-1; $i >= 0; $i--) { 
            if ($array[$i] != 0) {
                $f = $i;
                $x1 = $array[$i];
                break;
            }
        }
        $array2[0] = $x1;
        $i2 =1;
        for ($i = $f-1; $i >= 0; $i--) { 
            $ff = $x * $x1;
            $x1 = ($array[$i]) + ($ff);
            $array2[$i2] = $x1;
            $i2 ++;
        }
        return $array2;
    }


?>