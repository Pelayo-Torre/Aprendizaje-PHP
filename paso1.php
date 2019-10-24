<?php
    require "formulario.php";
    require "pregunta.php";
    session_start();
    if($_SESSION["datos"] == null){
        $_SESSION["datos"] = [];
    }

    if($_POST["reestablecer"] == "reestablecer"){
        $_SESSION["datos"] = [];
        $_SESSION["datosJSON"] = [];
        $_POST["reestablecer"] = "";
    }
?>

<html>
    <head>
        <title>Formulario</title>
        <link rel="stylesheet" type="text/css" href="/paso1.css" media="screen" />
    </head>
    <body>

    <?php 
         $formulario = new Formulario("Temperatura", "Rellene el siguiente formulario de temperaturas", "paso2.php");
        
         $pregunta1 = new PreguntaString("Lugar", "", TRUE);
         $pregunta2 = new PreguntaEntero("Maxima", "", TRUE);
         $pregunta3 = new PreguntaEntero("Minima", "", TRUE);
         $pregunta4 = new PreguntaObligatoria("Media", "", TRUE);
 
         $formulario->add($pregunta1);
         $formulario->add($pregunta2);
         $formulario->add($pregunta3);
         $formulario->add($pregunta4);
    ?>

    <div id="form1">
        <h1>Formulario Dinámico</h1>
        <form method='POST' action="paso1.php">
            <input id="dinamicoInput" type='text' name='dinamico'/><br>
            <input id="bt1" type='submit' name='boton 2'  value='Submit' />
        </form>
    </div>

    <form method='POST' action="paso1.php">
        <input name='reestablecer' value="reestablecer" hidden/><br>
        <button type='submit'>Resetear</button>
    </form>

    <div id="form2">
    <?php 

        if($_POST["dinamico"] != null){
            $formulario = eval($_POST["dinamico"]);
            $_POST["dinamico"] = null;
        }
       
        echo $formulario->to_HTML();

        $_SESSION["formulario"]=$formulario;
    ?>
    <input id="bt2" type='submit' name='boton 1'  value='Submit' />
    </form>
    </div>
    
    <div id="form3">
        <h2>Visor de Datos</h2>
        <p id="historial"><?php 

            $_SESSION["datosJSON"]  = json_encode($_SESSION["datos"]);
            echo($_SESSION["datosJSON"]); 
        
        ?> </p>
    </div>
    <?php $_SESSION["paso"]= 1;?>    

    <div class="pie-chart"></div>        
    <script src="https://d3js.org/d3.v3.min.js"></script>        
    <script>var exports = {}; function require(s) { return eval(s); }
        var datos = '<?php echo $_SESSION["datosJSON"] ?>';
    </script>
    <script src="grafico.js"></script>    
     <footer>
        <h4>Aplicación realizada por Pelayo García Torre</h4>
        <address>
            Máster en Ingeniería Web<br>
            Programación Orientada a Objetos<br>
            UO251143@uniovi.es
        </address>
    </footer>
 </body>
</html>

