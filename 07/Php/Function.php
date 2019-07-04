<?php
    error_reporting(0);
    ini_set('display_errors', 0);

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
    //$output .= "".print_r($sd1)."</br>";
    //$output .= "".print_r($sd2)."</br>";
    //$intervalA = array_pop($sd1);
    //$intervalB = array_pop($sd2);
    if ($intervalA == null && $intervalB == null) { //caclular intervalo automaticamente
        $multiplos = calcularMultiplos($x0);
        //$output .= "multiplos: ".print_r($multiplos)."</br>";
        
        for ($i=0; $i < sizeof($multiplos); $i++) { 
            $intervalA = $multiplos[$i];
            $intervalB = $multiplos[($i + 1)];

            $sd1 = syntheticDivision($intervalA, $array);
            $sd2 = syntheticDivision($intervalB, $array);

            if ($sd1[sizeof($sd1) -1] < 0 && $sd2[sizeof($sd2) -1] > 0) {
                $output .= "intervalA: ".$intervalA."</br>";
                $output .= "intervalB: ".$intervalB."</br>";
                $output .= "</br>";
                break;
            }
        }

        $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
                $fMidle = 0;
                $i = 0;
    
                do {
                    $x = syntheticDivision($midlePoint, $array);
                    $xx = round(array_pop($x), $numberRound);
                    $xr = syntheticDivision($midlePoint, array_reverse($x));
                    $xxr = round(array_pop($xr), $numberRound);

                    $xf = round(($midlePoint) - (($xx) / ($xxr)), $numberRound);
    
                    $relativeError = round((abs(($xf - ($midlePoint)) / $xf)) * 100, $numberRound);
    
                    $output .= "middlePoint: ".$midlePoint."</br>";
                    $output .= "Error ".$i.": " . $relativeError . " %</br>";
                    $output .= "X: ".$xf."</br>";
                    $output .= "R1: ".$xx."</br>";
                    $output .= "R2: ".$xxr."</br>";
                    $output .= "</br>";
    
                    $i++;
                    $midlePoint = $xf;
                    if ($i == 101) {
                        break;
                    }
                } while ($relativeError >= $percentageError); 
        $output .= "<div id='output'>x: ".$midlePoint."</div>";
    } else if ($intervalA != null && $intervalB != null/*$intervalA > 0 && $intervalB < 0 || $intervalA < 0 && $intervalB > 0*/) {
                $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
                $fMidle = 0;
                $i = 0;
    
                do {
                    $x = syntheticDivision($midlePoint, $array);
                    $xx = round(array_pop($x), $numberRound);
                    $xr = syntheticDivision($midlePoint, array_reverse($x));
                    $xxr = round(array_pop($xr), $numberRound);

                    $xf = round(($midlePoint) - (($xx) / ($xxr)), $numberRound);
    
                    $relativeError = round((abs(($xf - ($midlePoint)) / $xf)) * 100, $numberRound);
    
                    $output .= "middlePoint: ".$midlePoint."</br>";
                    $output .= "Error ".$i.": " . $relativeError . " %</br>";
                    $output .= "X: ".$xf."</br>";
                    $output .= "R1: ".$xx."</br>";
                    $output .= "R2: ".$xxr."</br>";
                    $output .= "</br>";
    
                    $i++;
                    $midlePoint = $xf;
                    if ($i == 101) {
                        break;
                    }
                } while ($relativeError >= $percentageError); 
        $output .= "<div id='output'>x: ".$midlePoint."</div>";
    } else if ($sd1 == 0) {
        //encontro la respuesta x en el primer intervalo
    } else if ($sd2 == 0) {
        //encontro la respuesta x en el segundo intervalo
    } else {
        $output .= "la respuesta no esta dentro del intervalo";
    } 
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

    function calcularMultiplos ($x) {
        $f = array();
        if ($x > 0) {
            for ($i=($x * -1); $i < 0 ; $i++) { 
                if (($x % $i) == 0) {
                    array_push($f, $i);
                }
            }
            for ($i=1; $i <= $x ; $i++) { 
                if (($x % $i) == 0) {
                    array_push($f, $i);
                }
            }
        } else {
            for ($i=$x; $i < 0 ; $i++) { 
                if (($x % $i) == 0) {
                    array_push($f, $i);
                }
            }
            for ($i=1; $i <= ($x *-1) ; $i++) { 
                if (($x % $i) == 0) {
                    array_push($f, $i);
                }
            }
        }
        return $f;
    }


?>