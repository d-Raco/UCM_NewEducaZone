<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Form.php';
require_once __DIR__ . '/dao/DAO_Entradas_Foro.php';
require_once __DIR__ . '/dao/DAO_Archivos_foro.php';

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
          $dao_entrada = new DAO_Entradas_foro();

          $entrada->setId($dao_entrada->getNumEntradas()+1);
          $entrada->setIdClase($this->idClase);
          $entrada->setTituloForo($titulo);
          $entrada->setIdCreador($this->idCreador);
          $entrada->setRolCreador($this->rolCreador);
          $entrada->setPermisos($permisos);
          $entrada->setContenido($contenido);
          $entrada->setFecha(date('Y-m-d H:i:s'));
          $dao_entrada->insertEntrada($entrada);

          for($key = 0; $key < $total_files; $key++) {
            $archivo = new Archivos_foro();
            $dao_archivo = new DAO_Archivos_foro();

            $archivo->setId($dao_archivo->getNumArchivos()+1);
            $archivo->setIdForo($entrada->getId());
            $archivo->setNombreArchivo($files['name'][$key]);
            $archivo->setTamanoArchivo($files['size'][$key]);
            $archivo->setArchivo("./archivos/" .$files['name'][$key]);
            $archivo->setTipoArchivo($files['type'][$key]);
            move_uploaded_file($files['tmp_name'][$key], $archivo->getArchivo());
            $dao_archivo->insertArchivo($archivo);
          }
          $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/foro.php?idClase=".$this->idClase;
          echo "<script>window.open('".$url."','_self');</script>";
          //header("Location: ./foro.php?idClase=".$this->idClase");
          //exit;
          exit;
        }

        return $result;
    }
}
?>
