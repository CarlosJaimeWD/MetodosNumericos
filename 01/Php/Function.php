<?php

    $numberToSearch = $_POST["numberToSearch"];
    $numberRound = $_POST["numberRound"];
    $percentageError = $_POST["percentageError"];
    if ($_POST["numberInitial"] == null) {
        $xInitial = intval(sqrt($numberToSearch));
    } else {
        $xInitial = $_POST["numberInitial"];
    }
    $output = "";

    if ($numberRound == null) {
        $x = .5*($xInitial + ($numberToSearch / $xInitial));
        $relativeError = abs((($x - $xInitial) / $x) * 100);

        $output .= "X0:  ".$x.", Error: ".$relativeError." </br>";
        $i= 0;
        while ($relativeError >= $percentageError) {
            $x1 = $x;
            $x = .5*($x + ($numberToSearch / $x));
            $relativeError = abs((($x - $x1) / $x) * 100);

            $output .= "X".$i.":  ".$x.", Error: ".$relativeError." </br>";
            $i++;
        }
    } else {
        $x = round(.5*($xInitial + ($numberToSearch / $xInitial)), $numberRound);
        $relativeError = round(abs((($x - $xInitial) / $x) * 100), $numberRound);

        $output .= "X0:  ".$x.", Error: ".$relativeError." </br>";
        $i= 0;
        while ($relativeError >= $percentageError) {
            $x1 = $x;
            $x = round(.5*($x + ($numberToSearch / $x)), $numberRound);
            $relativeError = round(abs((($x - $x1) / $x) * 100), $numberRound);

            $output .= "X".$i.":  ".$x.", Error: ".$relativeError." </br>";
            $i++;
        }
    }
    file_put_contents("output.txt", "");
    $myfile = fopen("output.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $output);
    fclose($myfile);
    echo "√x = ".$x."";
?>