<?php

class Pregunta{

    public $descripcion;
    public $respuesta;
    public $requerido;

    public function __construct(string $descripcion2, string $respuesta2, bool $requerido2){
        $this->descripcion = $descripcion2;
        $this->respuesta = $respuesta2;
        $this->requerido = $requerido2;
    }

    public function to_HTML(): string{
        $cadena = "";
        $cadena .= "<li>";
        $cadena .= "Pregunta: $this->descripcion  -  Respuesta: $this->respuesta";
        if($this->requerido == TRUE){
            $cadena .="  -  Obligatoria: TRUE";
        }  
        else{
            $cadena .="  -  Obligatoria: FALSE";
        }
        $cadena .= "</li>";

        return $cadena;
    }

    public function valida() : bool{}

    public function razonInvalida(): string{}

}

class PreguntaEntero extends Pregunta{

    public function valida() : bool {
        if( ctype_digit($this->respuesta) == FALSE ){
            return FALSE;
        }
        return TRUE;
    }

    public function razonInvalida() : string {
        return "La respuesta a la pregunta: $this->descripcion , debe ser un número entero.";
    }
}

class PreguntaString extends Pregunta{

    public function valida() : bool {
        if( ctype_digit($this->respuesta) == TRUE ){
            return FALSE;
        }
        return TRUE;
    }

    public function razonInvalida() : string {
        return "La respuesta a la pregunta: $this->descripcion , debe ser una cadena de texto.";
    }
}

class PreguntaObligatoria extends Pregunta{

    public function valida() : bool {
        if( $this->requerido == TRUE and $this->respuesta === "" ){
            return FALSE;
        }
        return TRUE;
    }

    public function razonInvalida() : string {
        return "La respuesta a la pregunta: $this->descripcion , es obligatoria.";
    }
}

?>