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
    $fA = f($intervalA, $array);
    $fB = f($intervalB, $array);

    $validateRoot = $fA * $fB;
    $relativeError = 0;
    $output = "";
    if ($validateRoot < 0) {
        if ($numberRound == null) {
            $midlePoint = midlePoint($intervalA, $intervalB);
            $fMidle = 0;
            $i = 0;

            do {
                $fMidleBefore = $fMidle;
                $midlePoint = midlePoint($intervalA, $intervalB);
                $fA = f($intervalA, $array);
                $fMidle = f($midlePoint, $array);
                $fB = f($intervalB, $array);

                if (($fA < 0 && $fMidle >= 0) || ($fMidle < 0 && $fA >= 0)) {
                    $intervalB = $midlePoint;
                } else if (($fB < 0 && $fMidle >= 0) || ($fMidle < 0 && $fB >= 0)) {
                    $intervalA = $midlePoint;
                }

                $relativeError = (abs(($fMidle - ($fMidleBefore)) / $fMidle)) * 100;
                $relativeError2 = abs($fMidle - $fMidleBefore);

                $output .= "fMidle (".$midlePoint."): " . $fMidle . "</br>";
                $output .= "Error ".$i.": " . $relativeError . " %, ".$relativeError2."</br>";
                $output .= "f(A): " . $fA . ",  f(B): ".$fB."</br>";
                $output .= "</br>";

                $i++;

            } while ($relativeError >= $percentageError);
        } else {
            $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
            $fMidle = 0;
            $i = 0;

            do {
                $fMidleBefore = $fMidle;
                $midlePoint = round(midlePoint($intervalA, $intervalB), $numberRound);
                $fA = round(f($intervalA, $array), $numberRound);
                $fMidle = round(f($midlePoint, $array), $numberRound);
                $fB = round(f($intervalB, $array), $numberRound);

                if (($fA < 0 && $fMidle >= 0) || ($fMidle < 0 && $fA >= 0)) {
                    $intervalB = $midlePoint;
                } else if (($fB < 0 && $fMidle >= 0) || ($fMidle < 0 && $fB >= 0)) {
                    $intervalA = $midlePoint;
                }

                $relativeError = round((abs(($fMidle - ($fMidleBefore)) / $fMidle)) * 100, $numberRound);
                $relativeError2 = round(abs($fMidle - $fMidleBefore), $numberRound);

                $output .= "fMidle (".$midlePoint."): " . $fMidle . "</br>";
                $output .= "Error ".$i.": " . $relativeError . " %, ".$relativeError2."</br>";
                $output .= "f(A): " . $fA . ",  f(B): ".$fB."</br>";
                $output .= "</br>";

                $i++;

            } while ($relativeError >= $percentageError);
        }

    } else {
        echo "la respuesta no esta dentro del intervalo";
    }  
    $output .= "<div id='output'>x: ".$midlePoint."</div>";
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


?>