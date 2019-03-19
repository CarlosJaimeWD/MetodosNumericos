<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metodos Numericos 01</title>
    <script src="Js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link rel="stylesheet" href="Css/Background.css">
</head>
<body>
    <!--<main class="main">
        <label for="">Valor C</label>
        <input type="number" id="numberToSearch" value="27">
        <label for="">Valor Inicial</label>
        <input type="number" id="numberInitial" value="20">
        <label for="">Numero de decimales</label>
        <input type="number" id="numeroDecimales">
        <label for="">% Error</label>
        <input type="number" id="epsilon" value=".005">
        <button type="submit" id="submit">Calcular</button>
    </main>-->

    <!-- Background elements -->
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>
    <div id="horizon">
        <div class="glow"></div>
    </div>
    <div id="earth"></div>
    <div id="title">Metodos Numericos</div>
    <div id="subtitle">
        <span>By</span>
        <span>Carlos</span>
        <span>Jaime</span>
    </div>

    <main id="globalContainer">
        <div id="mainContainer">
            <div id="titleBox">Metodos Numericos - </div>
            <div id="formBox"></div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
             setTimeout(function(){ 
                $("#title").hide();
                $("#subtitle").hide();
             }, 5500);

             setTimeout(function(){ 
                $("#earth").hide();
                $("#horizon").hide();
             }, 8150);

             setTimeout(function(){ 
                $("#mainContainer").animate({
                    width: '65%',
                    height: '60%'
                }, 'slow');
             }, 6700);
        });

        $("#submit").click(function() {
            var numberToSearch = $("#numberToSearch").val();
            var epsilon = $("#epsilon").val();
            var numberInitial = $("#numberInitial").val();
            
            
            //console.log("numberToSearch: " + numberToSearch + ", numberInitial: " + numberInitial + ", epsilon: " + epsilon);            
        });
    </script>
</body>
</html>