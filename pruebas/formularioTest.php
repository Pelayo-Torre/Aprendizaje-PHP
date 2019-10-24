<?php
    require "../formulario.php";
    require "../pregunta.php";


use PHPUnit\Framework\TestCase;

class FormularioTest extends TestCase
{
    public function testCreateFormulario()
    {
        $formulario = new Formulario("Temperatura", "Temperaturas de los concejos", "action1");
        $this->assertSame("Temperatura", $formulario->titulo);
        $this->assertSame("Temperaturas de los concejos", $formulario->descripcion);
        $this->assertSame("action1", $formulario->action);
        $this->assertSame(0, count($formulario->preguntas));
    }

    public function testAddPregunta(){
        $formulario = new Formulario("Temperatura", "Temperaturas de los concejos", "action1");

        $pregunta1 = new PreguntaString("Lugar", "Oviedo", TRUE);
        $pregunta2 = new PreguntaEntero("PoblacionMaxima", "200000", TRUE);
        $pregunta3 = new PreguntaEntero("PoblacionMinima", "100000", TRUE);
        $pregunta4 = new PreguntaObligatoria("PoblacionMedia", "150000", TRUE);

        $this->assertSame(0, count($formulario->preguntas));

        $formulario->add($pregunta1);
        $this->assertSame(1, count($formulario->preguntas));
        $this->assertSame($pregunta1->descripcion, $formulario->preguntas[0]->descripcion);
        $this->assertSame($pregunta1->respuesta, $formulario->preguntas[0]->respuesta);
        $this->assertSame($pregunta1->requerido, $formulario->preguntas[0]->requerido);

        $formulario->add($pregunta2);
        $this->assertSame(2, count($formulario->preguntas));

        $formulario->add($pregunta3);
        $this->assertSame(3, count($formulario->preguntas));

        $formulario->add($pregunta4);
        $this->assertSame(4, count($formulario->preguntas));
    }

    public function testFormularioTo_HTML(){
        $formulario = new Formulario("Temperatura", "Temperaturas de los concejos", "action1");

        $pregunta1 = new PreguntaString("Lugar", "Oviedo", TRUE);
        $pregunta2 = new PreguntaEntero("PoblacionMaxima", "200000", TRUE);

        $formulario->add($pregunta1);
        $formulario->add($pregunta2);

        $this->assertSame("<h1>Temperatura</h1><h2>Temperaturas de los concejos</h2><form method='POST' action='action1'><p>Lugar:</p><input type='text' name='Lugar' value='Oviedo'/><p>PoblacionMaxima:</p><input type='text' name='PoblacionMaxima' value='200000'/><br>", $formulario->to_HTML());
    }

    public function testFormularioNoValido(){
        $formulario = new Formulario("Temperatura", "Temperaturas de los concejos", "action1");

        $pregunta1 = new PreguntaString("LUGAR", "3465", TRUE);
        $pregunta2 = new PreguntaEntero("PoblacionMaxima", "hola", TRUE);
        $pregunta3 = new PreguntaEntero("PoblacionMinima", "", TRUE);
        $pregunta4 = new PreguntaObligatoria("PoblacionMedia", "", TRUE);

        $formulario->add($pregunta1);
        $formulario->add($pregunta2);
        $formulario->add($pregunta3);
        $formulario->add($pregunta4);

        $this->assertSame(FALSE, $formulario->validar());
    }

    public function testFormularioValido(){
        $formulario = new Formulario("Temperatura", "Temperaturas de los concejos", "action1");

        $pregunta1 = new PreguntaString("Ciudad", "Oviedo", TRUE);
        $pregunta2 = new PreguntaEntero("PoblacionMaxima", "23", TRUE);
        $pregunta3 = new PreguntaEntero("PoblacionMinima", "12", TRUE);
        $pregunta4 = new PreguntaObligatoria("PoblacionMedia", "17", TRUE);

        $formulario->add($pregunta1);
        $formulario->add($pregunta2);
        $formulario->add($pregunta3);
        $formulario->add($pregunta4);

        $this->assertSame(TRUE, $formulario->validar());
    }
}

?>