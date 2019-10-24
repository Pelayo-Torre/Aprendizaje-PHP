<?php
    require "formulario.php";
    require "pregunta.php";
    session_start();
?>

<html>
 <head>
  <title>Histórico de datos</title>
  <link rel="stylesheet" type="text/css" href="/paso3.css" media="screen" />
 </head>
 <body>
    <div>
        <h1>Histórico de datos de la aplicación.</h1>
        <p><?php 
            echo(json_encode($_SESSION["datos"])) ;     
        ?></p>
        <br>
        <br>
        <button type="button" onClick='location.href="paso1.php"'>Finalizar</button>
    </div>    
 </body>
</html>