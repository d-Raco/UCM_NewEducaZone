<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/dao/Comentarios_foro.php';

class FormularioComentariosForo extends Form
{
    private $idClase = "";
    private $idEntrada = "";
    private $id_redactor = "";
    private $rol_redactor = "";

    public function __construct($idClase, $idForo, $id_redactor, $rol_redactor) {
        $opciones = array( 'action' => 'foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$idForo, );
        parent::__construct('formComentarios', $opciones);
        $this->idClase = $idClase;
        $this->idEntrada = $idForo;
        $this->id_redactor = $id_redactor;
        $this->rol_redactor = $rol_redactor;
    }

    protected function generaCamposFormulario($datos)
    {
        echo "<h2>Crea un comentario</h2>";

        $html = <<<EOF
        <fieldset>
          <p>Título de la entrada:
          <input type="text" name="titulo" required /><br></p>
          <p>Contenido de la entrada:
          <input type="text" name="contenido" requires /><br></p>
          <input type="submit" value="Enviar" />
        </fieldset>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $titulo = isset($datos['titulo']) ? htmlspecialchars(trim(strip_tags($datos['titulo']))) : null;
        $contenido = isset($datos['contenido']) ? htmlspecialchars(trim(strip_tags($datos['contenido']))) : null;

        if ( empty($titulo) || empty($contenido) ) {
            $result[] = "Los campos título y contenido son obligatorios. ";
        }
        else {
          $comentario = new Comentarios_foro();
          $comentario->setId($comentario->getNumComentarios()+1);
          $comentario->setIdForo($this->idEntrada);
          $comentario->setIdRedactor($this->id_redactor);
          $comentario->setRolRedactor($this->rol_redactor);
          $comentario->setTitulo($titulo);
          $comentario->setContenidoComentario($contenido);
          $comentario->setFecha(date('Y-m-d h:i:s'));
          $comentario->insertComentario();
        }

        return $result;
    }
}
?>
