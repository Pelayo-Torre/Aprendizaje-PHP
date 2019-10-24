<?php
    require "formulario.php";
    require "pregunta.php";
    session_start();
?>

<?php
         $formulario = $_SESSION["formulario"];
        echo "<h3>Resultado de la validación</h3>";
        echo "<ul>";
        for ($i = 0; $i < count($formulario->preguntas); $i++){
            if($formulario->preguntas[$i]->valida() == FALSE){
                echo $formulario->preguntas[$i]->razonInvalida();
            }
        }    
        echo "</ul>";
    ?>