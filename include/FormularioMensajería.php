<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Mensajes.php';
require_once __DIR__ . '/Form.php';

class FormularioMensajería extends Form
{
    private $tutor;
    private $profesor;
    private $idOrig;
    private $rolOrig;
    private $idDest;
    private $rolDest;

    public function __construct($tutor, $profesor) {
        parent::__construct('formMensajería');

        $this->tutor = $tutor;
        $this->profesor = $profesor;
        if($_SESSION['rol'] == 'profesor'){
          $this->idOrig = $profesor;
          $this->rolOrig = "profesor";
          $this->idDest = $tutor;
          $this->rolDest = "padre";
        }
        else if($_SESSION['rol'] == 'padre'){
          $this->idOrig = $tutor;
          $this->rolOrig = "padre";
          $this->idDest = $profesor;
          $this->rolDest = "profesor";
        }
    }

    protected function generaCamposFormulario($datos)
    {
        $html = <<<EOF
        <fieldset>
            <p class="msg"> Escribe aquí tu mensaje: <br/>
            <input type="varchar" name="contenido_msg"></p>
            <input type="hidden" name="tutor" value="$this->tutor">
            <input type="hidden" name="profesor" value="$this->profesor">
            <input type="file" name="fileupload" value="fileupload">
            <input class="msg" type="submit" name="enviado" value="Submit">
        </fieldset>
        EOF;

        $mensaje = new Mensajes();

        setlocale(LC_TIME,"es_ES");

        $resultEnviados = $mensaje->getMensajes($this->idOrig, $this->rolOrig, $this->idDest, $this->rolDest);
        $resultRecibidos = $mensaje->getMensajes($this->idDest, $this->rolDest, $this->idOrig, $this->rolOrig);

        echo "<p>ENVIADOS:</p>";

        if($resultEnviados->num_rows > 0){
          while($fila = $resultEnviados->fetch_assoc()){
            echo "<p>"  .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. " ";
            if($fila["archivo"] != null) {
              echo '<a href="include/descargarArchivo.php?id=' .$fila["id"]. '"> <img src="img/file.png" width="20" height="20">';
              echo ' ' .$fila["nombre_archivo"]. '</a>';
            }
            echo "</p>";
          }
        }
        else{
           echo "<p>No hay mensajes</p>";
        }

        echo "<p>RECIBIDOS:</p>";

        if($resultRecibidos->num_rows > 0){
          while($fila = $resultRecibidos->fetch_assoc()){
            echo "<p>"  .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. " ";
            if($fila["archivo"] != null) {
              echo '<a href="include/descargarArchivo.php?id=' .$fila["id"]. '"> <img src="img/file.png" width="20" height="20">';
              echo ' ' .$fila["nombre_archivo"]. '</a>';
            }
            echo "</p>";          }
        }
        else{
          echo "<p>No hay mensajes</p>";
        }

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $msg = isset($datos['contenido_msg']) ? htmlspecialchars(trim(strip_tags($datos['contenido_msg']))) : null;
        $file = isset($_FILES['fileupload']) ? $_FILES['fileupload'] : null;

        if ( empty($msg) && empty($file['name']) ) {
            $result[] = "Hay que enviar mínimo un mensaje o archivo. ";
        }
        else {
          $mensaje = new Mensajes();
          $mensaje->setId($mensaje->getNumMensajes()+1);
          $mensaje->setIdOrigen($this->idOrig);
          $mensaje->setRolOrigen($this->rolOrig);
          $mensaje->setIdDestinatario($this->idDest);
          $mensaje->setRolDestinatario($this->rolDest);
          $mensaje->setMsg($msg);
          $mensaje->setDate(date('Y-m-d h:i:s'));
          // $mensaje->setEtiqueta
          if(!empty($file['name'])){
            $fp      = fopen($file['tmp_name'], 'r');
            $content = fread($fp, filesize($file['tmp_name']));
            $content = addslashes($content);
            fclose($fp);
            $mensaje->setNombreArchivo($file['name']);
            $mensaje->setArchivo($content);
            $mensaje->setTamañoArchivo($_FILES['fileupload']['size']);
            $mensaje->setTipoArchivo($_FILES['fileupload']['type']);
          }

          $mensaje->insertMensaje();
        }
        return $result;
    }
}
?>
