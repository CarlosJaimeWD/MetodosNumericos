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
    <!-- Background elements -->
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>

    <!-- program elements -->
    <main id="globalContainer">
        <div id="mainContainer">
            <div id="formBox">
                <form id="form">
                    <div id="table">
                    <table>
                        <tr>
                            <th>x</th>
                            <th>y</th>
                            <th>z</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td id="x1" contenteditable = "true"></td>
                            <td id="x2" contenteditable = "true"></td>
                            <td id="x3" contenteditable = "true"></td>
                            <td>=</td>
                            <td id="x4" contenteditable = "true"></td>
                        </tr>
                        <tr>
                            <td id="y1" contenteditable = "true"></td>
                            <td id="y2" contenteditable = "true"></td>
                            <td id="y3" contenteditable = "true"></td>
                            <td>=</td>
                            <td id="y4" contenteditable = "true"></td>
                        </tr>
                        <tr>
                            <td id="z1" contenteditable = "true"></td>
                            <td id="z2" contenteditable = "true"></td>
                            <td id="z3" contenteditable = "true"></td>
                            <td>=</td>
                            <td id="z4" contenteditable = "true"></td>
                        </tr>
                    </table>
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
            var x1 = $('#x1').text();
            var x2 = $('#x2').text();
            var x3 = $('#x3').text();
            var x4 = $('#x4').text();
            var y1 = $('#y1').text();
            var y2 = $('#y2').text();
            var y3 = $('#y3').text();
            var y4 = $('#y4').text();
            var z1 = $('#z1').text();
            var z2 = $('#z2').text();
            var z3 = $('#z3').text();
            var z4 = $('#z4').text();
            
            console.log(x1);
            
    
            if (percentageError == 0) {
                alert("El % de error no puede ser igual a 0");
            } else {
                $("#output").html("");
                $("#iterationsBox").html("");
                $("#output").html("Calculando...");

                $.ajax ({
                    url: "Php/Function.php",
                    method: "POST",
                    data: ({percentageError: percentageError, numberRound:numberRound, x1:x1, x2:x2, x3:x3, x4:x4, y1:y1, y2:y2, y3:y3, y4:y4, z1:z1, z2:z2, z3:z3, z4:z4}),
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