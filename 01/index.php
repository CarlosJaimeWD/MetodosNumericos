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
            <!--<div id="titleBox">Metodos Numericos - Metodo iteratico para calcular √c</div>-->
            <div id="formBox">
                <form id="form">
                    <div id="inputsBox">
                        <div class="col-3 input-effect">
                            <input class="effect-16" type="number" id="numberToSearch">
                            <label>Numero a buscar *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3 col-5">
                            <div class="col-4 input-effect">
                                <input class="effect-16" type="number" id="numberRound" value="4" disabled="disabled">
                                <label>N° de decimales</label>
                                <span class="focus-border"></span>
                            </div>
                            <input type="checkbox" id="checkNumberRound">
                        </div>
                        <div class="col-3 input-effect">
                            <input class="effect-16" type="number" id="percentageError">
                            <label>% de error *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3 col-5">
                            <div class="col-4 input-effect">
                                <input class="effect-16" type="number" id="numberInitial" value="4" disabled="disabled">
                                <label>Numero inicial</label>
                                <span class="focus-border"></span>
                            </div>
                            <input type="checkbox" id="checkNumberInitial">
                        </div>
                    </div>

                    <input type="button" value="Calcular" id="btnCalculate">
                </form>

                <div id="outputBox">
                    <div id="output"></div>
                    <div id="iterationsBox"></div>
                </div>
            </div>
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
                    height: '60%',
                    opacity: '1'
                }, 'slow');
             }, 6700);

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
                }
            })

            $("#checkNumberInitial").click(function () {
                if ($(this).is(":checked")) {
                    $("#numberInitial").removeAttr("disabled");
                    $("#numberInitial").focus();
                } else {
                    $("#numberInitial").attr("disabled", "disabled");
                }
            })
        });

        $("#btnCalculate").click(function() {
            var numberToSearch = $("#numberToSearch").val();
            var percentageError = $("#percentageError").val();
            var numberRound = $("#numberRound").val();
            var numberInitial = $("#numberInitial").val();
    
            if (numberToSearch === "" || percentageError === "") {
                alert("Llene los campos necesarios marcados con un *");   
            } else {
                console.log("numberToSearch: " + numberToSearch + ", numberRound: " + numberRound + ", percentageError: " + percentageError);            

                $.ajax ({
                    url: "Php/Function.php",
                    method: "POST",
                    data: ({numberToSearch:numberToSearch, numberRound:numberRound, percentageError:percentageError, numberInitial:numberInitial}),
                    success: function(result) {
                        $("#output").html(result);
                        $("#iterationsBox").load("Php/output.txt");
                    }
                });       
            }
                 
        });
    </script>
</body>
</html>