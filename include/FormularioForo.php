<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Form.php';

class FormularioForo extends Form
{
    private $idClase;

    public function __construct($idClase) {
        parent::__construct('formForo');
        $this->idClase = $idClase;
    }

    protected function generaCamposFormulario($datos)
    {
        echo "<h2>Crea un formulario</h2>";

        $html = <<<EOF
        <fieldset>
          <input type="hidden" name="idClase" value="$this->idClase">
          <p>Título de la entrada:
          <input type="text" name="titulo" /><br></p>
          <p>Contenido de la entrada:
          <input type="text" name="contenido" /><br></p>
          <p>¿Deseas que el resto de usuarios puedan comentar en tu entrada?</p>
          <input type="radio" id="si" name="permisos" value="true">
          <label for="si">Sí</label><br>
          <input type="radio" id="no" name="permisos" value="false">
          <label for="no">No</label><br>
          <p>Adjuntar archivos a la entrada:</p>
          <input type="file" name="fileupload" value="fileupload" multiple><br>
          <input type="submit" value="Enviar" />
        </fieldset>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $msg = isset($datos['incidencia']) ? htmlspecialchars(trim(strip_tags($datos['incidencia']))) : null;

        if (empty($msg) ) {
            $result[] = "La incidencia está vacía. ";
        }
        else{
          $this->incidencia->setId($this->incidencia->getNumIncidencias() + 1);
          $this->incidencia->setMsgIncidencia($msg);
          $this->incidencia->insertIncidencia();
        }

        return $result;
    }
}
?>
