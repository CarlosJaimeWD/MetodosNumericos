<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regla false (Funciones trigonometricas)</title>
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
                <div class="inputsBoxBox">
                    <div class="functionTypeBox">
                    <div><input type="radio" name="functionType" id="" value="sin" checked><p>seno</p></div>
                    <div><input type="radio" name="functionType" id="" value="cos"><p>coseno</p></div>
                    <div><input type="radio" name="functionType" id="" value="tan"><p>tangente</p></div>
                    </div>
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
                        <label for="">C:</label>
                        <input type="number" id="x0">
                    </div>
                    </div>
                    <div class="intervalBox">
                        <div class="intervalBox1">
                            <div><input type="radio" name="measurementType" value="grados" checked>Grados</div>
                            <div><input type="radio" name="measurementType" value="radianes">Radianes</div>
                        </div>
                        <div class="intervalBox2">
                            <div><input type="radio" name="radianesType" value="fraccion" checked>Fraccion</div>
                            <div><input type="radio" name="radianesType" value="decimales">decimales</div>
                        </div>
                        <div class="intervalBox3">
                            <div class="intervals1">
                                <label for="">(</label>
                                <input type="number" id="intervalA">
                                <label for="" style="margin-right: 5px">,</label>
                                <input type="number" id="intervalB">
                                <label for="">)</label>
                            </div>
                            <div class="intervals2">
                                <label for="">(</label>
                                <input type="number" id="intervalA">
                                <label for="" style="margin-right: 5px">,</label>
                                <input type="number" id="intervalB">
                                <label for="">)</label>
                            </div>
                            <div class="intervals3">
                                <div style="display:flex; align-items: center">
                                    <label for="">(</label>
                                    <div style="width: 50px; display: flex; flex-wrap: wrap">
                                        <input type="number" id="intervalA1">
                                        <input type="number" id="intervalA2">
                                    </div>
                                    <label for="" style="margin-right: 5px">,</label>
                                    <div style="width: 50px; display: flex; flex-wrap: wrap">
                                        <input type="number" id="intervalB1">
                                        <input type="number" id="intervalB2">
                                    </div>
                                    <label for="">)</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--<div id="inputsBox2">
                        <label for="">(</label>
                        <input type="number" id="intervalA">
                        <label for="" style="margin-right: 5px">,</label>
                        <input type="number" id="intervalB">
                        <label for="">)</label>
                    </div>-->
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
    var intervalType;
    var functionType = "sin";
        $(document).ready(function() {
            $(".intervals2").hide();
            $(".intervals3").hide();
            $(".intervalBox2").hide();
            
            $("input[type='radio']").click(function(){
                var radioValue = $("input[name='measurementType']:checked").val();            
                switch (radioValue) {
                    case "grados":
                        intervalType = "grados";
                        $(".intervals1").show();
                        $(".intervals2").hide();
                        $(".intervals3").hide();
                        $(".intervalBox2").hide();
                        $("input[name='radianesType']:unchecked");
                        break;
                    case "radianes":
                        $(".intervals1").hide();
                        $(".intervalBox2").show();
                        break;
                }

                var radioValue2 = $("input[name='radianesType']:checked").val();                
                switch (radioValue2) {
                    case "fraccion":
                        intervalType = "fraccion";
                        $(".intervals1").hide();
                        $(".intervals2").hide();
                        $(".intervals3").show();     
                        console.log(intervalType);
                                           
                        break;
                    case "decimales":
                        intervalType = "decimales";
                        $(".intervals1").hide();
                        $(".intervals2").show();
                        $(".intervals3").hide();
                        break;
                }

                functionType = $("input[name='functionType']:checked").val();  
            });

             $(".col-3 input").val("");
            $(".input-effect input").focusout(function(){
                if($(this).val() != ""){
                    $(this).addClass("has-content");
                }else{
                    $(this).removeClass("has-content");
                }
            })
        });

        $("#btnCalculate").click(function() {
            var percentageError = $("#percentageError").val();
            var numberRound = $("#numberRound").val();
            var radioValue2 = $("input[name='radianesType']:checked").val();
            //var intervalType = radioValue2;
            console.log(functionType);
            console.log(intervalType);
            
            
            if (intervalType === "fraccion") {
                var intervalA1 = $("#intervalA1").val();
                var intervalB1 = $("#intervalB1").val();  
                var intervalA2 = $("#intervalA2").val();
                var intervalB2 = $("#intervalB2").val();  

                var intervalA = intervalA1 / intervalA2;
                var intervalB = intervalB1 / intervalB2;
            } else {
                var intervalA = $("#intervalA").val();
                var intervalB = $("#intervalB").val();
            }
            var x6 = $('#x6').val();
            var x5 = $('#x5').val();
            var x4 = $('#x4').val();
            var x3 = $('#x3').val();
            var x2 = $('#x2').val();
            var x1 = $('#x1').val();
            var x0 = $('#x0').val();     
            /*else if ((Math.floor(intervalA) != intervalA) && (Math.floor(intervalB) != intervalB)) {
                alert("El valor de los intervalos debe ser entero");
            }*/
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
                    data: ({intervalType: intervalType, functionType: functionType, percentageError: percentageError, numberRound:numberRound, intervalA:intervalA, intervalB:intervalB,x6:x6,x5:x5,x4:x4,x3:x3,x2:x2,x1:x1,x0:x0}),
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