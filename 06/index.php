<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Metodo de Newton-Rapshon</title>
    <script src="Js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link rel="stylesheet" href="Css/Background.css">
</head>
<body>
    <!-- Background elements -->
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>

    <!-- program elements -->
    <main id="globalContainer">
        <div id="mainContainer">
            <div id="formBox">
                <form id="form">
                    <div id="inputsBox">
                        <label for="">x^6:</label>
                        <input type="number" id="x6">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^5:</label>
                        <input type="number" id="x5">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^4:</label>
                        <input type="number" id="x4">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^3:</label>
                        <input type="number" id="x3">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^2:</label>
                        <input type="number" id="x2">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^1:</label>
                        <input type="number" id="x1">
                    </div>
                    <div id="inputsBox">
                        <label for="">x^0:</label>
                        <input type="number" id="x0">
                    </div>
                    <div id="inputsBox2">
                        <label for="">Valor Inicial:</label>
                        <input type="number" id="initialValue">
                    </div>
                    <div id="inputsBox2">
                        <label for="">Error:</label>
                        <input type="number" id="percentageError">
                    </div>
                    <div id="inputsBox2">
                        <label for="">Round:</label>
                        <input type="number" id="numberRound">
                    </div>
                </form>

                <div id="outputBox">
                    <div id="iterationsBox"></div>
                    <!--<div id="output"></div>-->
                </div>

                <div id="buttonSubmitBox"><button id="btnCalculate">Calcular!</button></div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
             $(".col-3 input").val("");
            $(".input-effect input").focusout(function(){
                if($(this).val() != ""){
                    $(this).addClass("has-content");
                }else{
                    $(this).removeClass("has-content");
                }
            })

            $("#checkNumberRound").click(function () {
                if ($(this).is(":checked")) {
                    $("#numberRound").removeAttr("disabled");
                    $("#numberRound").focus();
                } else {
                    $("#numberRound").attr("disabled", "disabled");
                    $("#numberRound").val("");
                    $("#numberRound").blur();
                }
            })

            $("#checkNumberInitial").click(function () {
                if ($(this).is(":checked")) {
                    $("#numberInitial").removeAttr("disabled");
                    $("#numberInitial").focus();
                } else {
                    $("#numberInitial").attr("disabled", "disabled");
                    $("#numberInitial").val("");
                    $("#numberInitial").blur();
                }
            })
        });

        $("#btnCalculate").click(function() {
            var percentageError = $("#percentageError").val();
            var numberRound = $("#numberRound").val();
            var initialValue = $("#initialValue").val();
            var x6 = $('#x6').val();
            var x5 = $('#x5').val();
            var x4 = $('#x4').val();
            var x3 = $('#x3').val();
            var x2 = $('#x2').val();
            var x1 = $('#x1').val();
            var x0 = $('#x0').val();     
    
            if (percentageError == 0) {
                alert("El % de error no puede ser igual a 0");
            } else if (x0 == "") {
                alert("Ingrese valores a la funcion");
            } else {
                $("#output").html("");
                $("#iterationsBox").html("");
                $("#output").html("Calculando...");

                $.ajax ({
                    url: "Php/Function.php",
                    method: "POST",
                    data: ({percentageError: percentageError, numberRound:numberRound, initialValue: initialValue,x6:x6,x5:x5,x4:x4,x3:x3,x2:x2,x1:x1,x0:x0}),
                    success: function(result) {
                        $("#output").html("");
                        //$("#output").html(result);
                        $("#iterationsBox").html("");
                        $("#iterationsBox").html(result);
                    }
                });                   
            }
                 
        });
    </script>
</body>
</html>