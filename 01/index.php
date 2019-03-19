<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metodos Numericos 01</title>
    <script src="Js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="Css/Style.css">
</head>
<body>
    <main class="main">
        <label for="">Valor C</label>
        <input type="number" id="numberToSearch" value="27">
        <label for="">Valor Inicial</label>
        <input type="number" id="numberInitial" value="20">
        <label for="">Numero de decimales</label>
        <input type="number" id="numeroDecimales">
        <label for="">% Error</label>
        <input type="number" id="epsilon" value=".005">
        <button type="submit" id="submit">Calcular</button>
    </main>

    <script>
        $(document).ready(function() {
            console.log("Hola");
        });

        $("#submit").click(function() {
            var numberToSearch = $("#numberToSearch").val();
            var epsilon = $("#epsilon").val();
            var numberInitial = $("#numberInitial").val();
            var x = (1/2) * (parseInt(numberInitial) + (parseInt(numberToSearch)/parseInt(numberInitial)));
            var errorRelativo = Math.abs((parseFloat(x) - parseFloat(numberInitial)) / x);
            
            console.log("numberToSearch: " + numberToSearch + ", numberInitial: " + numberInitial + ", epsilon: " + epsilon);
            console.log("x: " + x + ", errorRelativo: " + errorRelativo);
            
        });
    </script>

    <?php

        $x = 35;
        $y = 40;

        $z = $x+$y;

        echo $z;

    ?>
</body>
</html>