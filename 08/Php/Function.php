<?php
    /*error_reporting(0);
    ini_set('display_errors', 0);*/
    $array2 = array();
    $percentageError = $_POST["percentageError"];
    $numberRound = $_POST["numberRound"];
    $x = 0;
    $y = 0;
    $z = 0;
    $x0 = $_POST["x1"];
    $x1 = $_POST["x2"];
    $x2 = $_POST["x3"];
    $x3 = $_POST["x4"];

    $y0 = $_POST["y1"];
    $y1 = $_POST["y2"];
    $y2 = $_POST["y3"];
    $y3 = $_POST["y4"];

    $z0 = $_POST["z1"];
    $z1 = $_POST["z2"];
    $z2 = $_POST["z3"];
    $z3 = $_POST["z4"];

    $array2[0][0] = $x0;
    $array2[1][0] = $x1;
    $array2[2][0] = $x2;

    $array2[0][1] = $y0;
    $array2[1][1] = $y1;
    $array2[2][1] = $y2;

    $array2[0][2] = $z0;
    $array2[1][2] = $z1;
    $array2[2][2] = $z2;

    $arrayn = array();
    $arrayn = $array2;

    $output = "";
    //$deter = ( (()()()) + (()()()) + (()()()) ) - ( (()()()) + (()()()) + (()()()) );
    //$deter = (((($x0)*($y1)*($z2)) + (($y0)*($z1)*($x2)) + (($z0)*($x1)*($y2))) - ((($x2)*($y1)*($z0)) + (($y2)*($z1)*($x0)) + (($z2)*($x1)*($y0))));
    /*$mas = 0;
    for ($i=0; $i <= 2; $i++) { 
        $mas += (($arrayn[0][0 + $i])*($arrayn[1][1 + $i])*($arrayn[2][2 + $i]));
    }
    $output .= "determinante: ".$deter." </br>";

    $arrayn[0][] = $x3;
    $deterx = ((($x0)*($y1)*($z2)) + (($y0)*($z1)*($z3)) + (($z0)*($y3)*($y2)) ) - ( (($x2)*($y1)*($z0)) + (($y2)*($z1)*($x3)) + (($z2)*($y3)*($y0)) );
    $deterx2 = $deterx / $deter;
    $f = f($deterx2, $array);
    $error1 =(abs(($x3 - ($f))/($x3))) * 100;
    $output .= "determinante X : ".$deterx2." </br>";
    $output .= "Error : ".$error1." </br>";
    $output .= "</br>";*/
    $determinante = cramer($arrayn);
    $output .= "Determinante: ".$determinante."</br>";

    $arrayn[2][2] = $x3;
    $arrayn[1][2] = $y3;
    $arrayn[0][2] = $z3;
    $determinanteX = cramer($arrayn);
    $x = $determinanteX/$determinante;
    $output .= "Determinante X: ".$determinanteX." / ".$determinante." = ".$x."</br>";

    $arrayn = $array2;
    $arrayn[2][1] = $x3;
    $arrayn[1][1] = $y3;
    $arrayn[0][1] = $z3;
    $determinanteY = cramer($arrayn);
    $y = $determinanteY/$determinante;
    $output .= "Determinante Y: ".$determinanteY." / ".$determinante." = ".$y."</br>";

    $arrayn = $array2;
    $arrayn[2][0] = $x3;
    $arrayn[1][0] = $y3;
    $arrayn[0][0] = $z3;
    $determinanteZ = cramer($arrayn);
    $z = $determinanteZ/$determinante;
    $output .= "Determinante Z: ".$determinanteZ." / ".$determinante." = ".$z."</br></br>";
    
    $error1 = (abs(($x3 - (f(0, $array2)))/($x3))) * 100;
    $output .= "f1: ".f(0, $array2)."";
    $output .= ", Error : ".$error1."% </br>";

    $error2 = (abs(($y3 - (f(1, $array2)))/($y3))) * 100;
    $output .= "f2: ".f(1, $array2)."";
    $output .= ", Error : ".$error2."% </br>";

    $error3 = (abs(($z3 - (f(2, $array2)))/($z3))) * 100;
    $output .= "f3: ".f(2, $array2)."";
    $output .= ", Error : ".$error3."% </br>";
    $errorf= ($error1 * $error2 * $error3) / 3;
    $output .= "Promedio Error : ".$errorf."% </br>";

    echo $output;
    
    function f ($row, $array) {
        $f = (($array[0][$row]*($GLOBALS['x'])) + ($array[1][$row]*($GLOBALS['y'])) + ($array[2][$row]*($GLOBALS['z'])));
        return $f;
    }

    function deter ($array) {
        $f = (((($x0)*($y1)*($z2)) + (($y0)*($z1)*($x2)) + (($z0)*($x1)*($y2))) - ((($x2)*($y1)*($z0)) + (($y2)*($z1)*($x0)) + (($z2)*($x1)*($y0))));
        return $f;
    }

    function cramer($array) {
        $f1 = ((($array[0][0])*($array[1][1])*($array[2][2])) + (($array[1][0])*($array[2][1])*($array[0][2])) + (($array[0][1])*($array[1][2])*($array[2][0])));
        $f2 =  ((($array[2][0])*($array[1][1])*($array[0][2])) + (($array[1][0])*($array[0][1])*($array[2][2])) + (($array[2][1])*($array[1][2])*($array[0][0])));
        $f = ($f1) - ($f2);
        return $f;
    }


?>