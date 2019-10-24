<?php
    require "formulario.php";
    require "pregunta.php";
    session_start();
?>


<html>
 <head>
  <title>Validador</title>
  <link rel="stylesheet" type="text/css" href="/paso2.css" media="screen" />
 </head>
 <body>
    <?php 
        $formulario = $_SESSION["formulario"];
    ?>
    <div id="depurador">
        <h1>DEPURADOR</h1>
        <p class="depurador"><strong>Nombre del formulario: </strong><?php echo $formulario->titulo  ?></p>
        <p class="depurador"><strong>Descripción del formulario: </strong><?php echo $formulario->descripcion  ?></p>
        <p class="depurador"><strong>Acción del formulario: </strong><?php echo $formulario->action  ?></p>
        <p class="depurador"><strong>Preguntas del formulario:</strong></p>
        <ul>
            <?php  
                for ($i = 0; $i < count($formulario->preguntas); $i++){
                    $res = $formulario->preguntas[$i]->descripcion;
                    $formulario->preguntas[$i]->respuesta = $_POST["$res"];
                    echo $formulario->preguntas[$i]->to_HTML();
                }      
            ?>
        </ul>
    </div>

    <div id="validador">
    <h1>Validación de datos</h1>
    <?php 
        echo $formulario->to_HTML();
    ?>
    <?php if ($formulario->validar() == TRUE and $_SESSION["paso"] == 2): ?>
        <?php 
            $array = array();
            for ($i = 0; $i < count($formulario->preguntas); $i++){
                $array[$formulario->preguntas[$i]->descripcion] = $formulario->preguntas[$i]->respuesta;
               //array_push($array, $formulario->preguntas[$i]->respuesta);
            }
            var_dump($array);
            array_push($_SESSION["datos"], $array);
            header('Location: paso3.php');
            exit;            
        ?>
    <?php endif; ?>
    <input type='submit' name='boton 1'  value='Enviar' />
    </form>
    <?php 
        echo "<h3>Resultado de la validación</h3>";
        echo "<ul>";
        $error = FALSE;
        for ($i = 0; $i < count($formulario->preguntas); $i++){
            if($formulario->preguntas[$i]->valida() == FALSE){
                $error = TRUE;
                echo "<li class='error'><strong>".$formulario->preguntas[$i]->razonInvalida()."</strong></li>";
            }
        }    
        if($error == FALSE){
            $valido = TRUE;
            echo "<li>SIN ERROES -> FORMULARIO VÁLIDO</li>";
        }
        echo "</ul>";
    ?>

    <?php $_SESSION["paso"]= 2; ?>

    </div>

    <button type="button" onClick='location.href="paso1.php"'>Atrás</button>
    
 </body>
</html>