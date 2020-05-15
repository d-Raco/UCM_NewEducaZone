<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/dao/Entradas_foro.php';
require_once __DIR__ . '/dao/Archivos_foro.php';

class FormularioForo extends Form
{
    private $idClase;
    private $idCreador;
    private $rolCreador;

    public function __construct($idClase, $idCreador, $rolCreador) {
        parent::__construct('formForo');
        $this->idClase = $idClase;
        $this->idCreador = $idCreador;
        $this->rolCreador = $rolCreador;
    }

    protected function generaCamposFormulario($datos)
    {
        echo "<h2>Crea una entrada para el foro</h2>";

        $html = <<<EOF
        <fieldset>
          <input type="hidden" name="idClase" value="$this->idClase">
          <p>Título de la entrada:</p>
          <input type="text" name="titulo" placeholder="Título" required /><br>
          <p>Contenido de la entrada:</p>
          <textarea name="contenido" placeholder="Texto de la entrada..."></textarea><br>
          <p>¿Deseas que el resto de usuarios puedan comentar en tu entrada?</p>
          <input type="radio" id="si" name="permisos" value="true" required>
          <label for="si">Sí</label><br>
          <input type="radio" id="no" name="permisos" value="false">
          <label for="no">No</label><br>
          <p>Adjuntar archivos a la entrada:</p>
          <input type="file" name="fileupload[]" multiple><br><br>
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
        $permisos = $datos['permisos'] == "true" ? true : false;
        $files = !empty($_FILES['fileupload']['name'][0]) ? $_FILES['fileupload'] : null;
        $total_files = !empty($files) ? count($files['name']) : 0;

        if ( empty($contenido) && $total_files === 0 ) {
            $result[] = "Hay que añadir mínimo contenido o archivo. ";
        }
        else {
          $entrada = new Entradas_foro();
          $entrada->setId($entrada->getNumEntradas()+1);
          $entrada->setIdClase($this->idClase);
          $entrada->setTituloForo($titulo);
          $entrada->setIdCreador($this->idCreador);
          $entrada->setRolCreador($this->rolCreador);
          $entrada->setPermisos($permisos);
          $entrada->setContenido($contenido);
          $entrada->setFecha(date('Y-m-d h:i:s'));
          $entrada->insertEntrada();

          for($key = 0; $key < $total_files; $key++) {
            $archivo = new Archivos_foro();
            $fp      = fopen($files['tmp_name'][$key], 'r');
            $content = fread($fp, filesize($files['tmp_name'][$key]));
            $content = addslashes($content);
            fclose($fp);

            $archivo->setId($archivo->getNumArchivos()+1);
            $archivo->setIdForo($entrada->getId());
            $archivo->setNombreArchivo($files['name'][$key]);
            $archivo->setTamañoArchivo($files['size'][$key]);
            $archivo->setArchivo($content);
            $archivo->setTipoArchivo($files['type'][$key]);
            $archivo->insertArchivo();
          }

          echo "Se ha creado una nueva entrada en el foro. ";
          echo "<a href=\"./foro.php?idClase=" .$this->idClase. "\">Foro</a>";
        }

        return $result;
    }
}
?>
