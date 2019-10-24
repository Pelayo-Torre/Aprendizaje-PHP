<?php
    require "../pregunta.php";


use PHPUnit\Framework\TestCase;

class PreguntaTest extends TestCase
{
    public function testPreguntaString()
    {
        $pregunta1 = new PreguntaString("Lugar", "Oviedo", TRUE);
        $this->assertSame("Lugar", $pregunta1->descripcion);
        $this->assertSame("Oviedo", $pregunta1->respuesta);
        $this->assertSame(TRUE, $pregunta1->requerido);
        $this->assertSame("<li>Pregunta: Lugar  -  Respuesta: Oviedo  -  Obligatoria: TRUE</li>", $pregunta1->to_HTML());

        $this->assertSame(TRUE, $pregunta1->valida());
        $this->assertSame("La respuesta a la pregunta: Lugar , debe ser una cadena de texto.", $pregunta1->razonInvalida());

        $pregunta2 = new PreguntaString("Lugar", "456365", TRUE);
        $this->assertSame(FALSE, $pregunta2->valida());

    }

    public function testPreguntaEntero()
    {
        $pregunta1 = new PreguntaEntero("Lugar", "35346", TRUE);
        $this->assertSame("Lugar", $pregunta1->descripcion);
        $this->assertSame("35346", $pregunta1->respuesta);
        $this->assertSame(TRUE, $pregunta1->requerido);
        $this->assertSame("<li>Pregunta: Lugar  -  Respuesta: 35346  -  Obligatoria: TRUE</li>", $pregunta1->to_HTML());

        $this->assertSame(TRUE, $pregunta1->valida());
        $this->assertSame("La respuesta a la pregunta: Lugar , debe ser un número entero.", $pregunta1->razonInvalida());

        $pregunta2 = new PreguntaEntero("Lugar", "gtreg54", TRUE);
        $this->assertSame(FALSE, $pregunta2->valida());
    }

    public function testPreguntaObligatoria()
    {
        $pregunta1 = new PreguntaObligatoria("Lugar", "35346", TRUE);
        $this->assertSame("Lugar", $pregunta1->descripcion);
        $this->assertSame("35346", $pregunta1->respuesta);
        $this->assertSame(TRUE, $pregunta1->requerido);
        $this->assertSame("<li>Pregunta: Lugar  -  Respuesta: 35346  -  Obligatoria: TRUE</li>", $pregunta1->to_HTML());

        $this->assertSame(TRUE, $pregunta1->valida());
        $this->assertSame("La respuesta a la pregunta: Lugar , es obligatoria.", $pregunta1->razonInvalida());

        $pregunta2 = new PreguntaObligatoria("Lugar", "", TRUE);
        $this->assertSame(FALSE, $pregunta2->valida());
    }
}

?>

