<?php

class Formulario{

    public $titulo;
    public $descripcion;
    public $preguntas = array();
    public $action;

    public function  __construct(string $titulo2, string $descripcion2, string $action){
        $this->titulo = $titulo2;
        $this->descripcion = $descripcion2;
        $this->preguntas = array();
        $this->action = $action;
    }

    public function validar() : bool{
        for ($i = 0; $i < count($this->preguntas); $i++){
            if( $this->preguntas[$i]->valida() == FALSE ){
                return FALSE;
            }
        }
        return TRUE;
    }

    public function add(Pregunta $pregunta){
        array_push($this->preguntas, $pregunta);
    }

    public function to_HTML(): string{
        $cadena = "";
        $cadena .= "<h1>$this->titulo</h1>";
        $cadena .= "<h2>$this->descripcion</h2>";
        $cadena .= "<form method='POST' action='$this->action'>";

        for($j = 0; $j < count($this->preguntas); $j++){
            $des = $this->preguntas[$j]->descripcion;
            $res = $this->preguntas[$j]->respuesta;
            $cadena .= "<p>$des:</p>";
            $cadena .= "<input type='text' name='$des' value='$res'/>";
        }

        $cadena .= "<br>";
       

        return $cadena;
    }



}


?>