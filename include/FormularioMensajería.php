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
            <textarea name="contenido_msg" placeholder="Texto del mensaje..."></textarea></p>
            <input type="hidden" name="tutor" value="$this->tutor">
            <input type="hidden" name="profesor" value="$this->profesor">
            <input type="file" name="fileupload">
            <input class="msg" type="submit" name="enviado" value="Submit">
        </fieldset>
        EOF;

        $mensaje = new Mensajes();

        setlocale(LC_TIME,"es_ES");

        $result = $mensaje->getMensajesByDate($this->idOrig, $this->rolOrig, $this->idDest, $this->rolDest);

        if($result->num_rows > 0){
          while($fila = $result->fetch_assoc()){
            if($fila['id_origen'] == $this->idOrig && $fila['rol_origen'] == $this->rolOrig){
              echo "<div class='mssg lighter'>";
                echo "<div class='cabeza_msg'><p>Enviado:</p></div>";
                echo "<div class='mensaje_enviado'><p>" .$fila["contenido_msg"]. "</p></div>";
                if($fila["archivo"] != null) {
                  echo '<a class="archivo_enviado" href="include/descargarArchivoMensajeria.php?id=' .$fila["id"]. '"> <img src="img/file.png" width="20" height="20">';
                  echo ' ' .$fila["nombre_archivo"]. '</a>';
                }
                echo "<div class='hora_msg'>" .$fila["fecha_hora"]. "</div></div>";
            }
            elseif ($fila['id_destinatario'] == $this->idOrig && $fila['rol_destinatario'] == $this->rolOrig) {
              echo "<div class='mssg darker'>";
                echo "<div class='cabeza_msg'><p>Recibido:</p></div>";
                echo "<div class='mensaje_recibido'><p>" .$fila["contenido_msg"]. "</p></div>";
                if($fila["archivo"] != null) {
                  echo '<a class="archivo_recibido" href="include/descargarArchivoMensajeria.php?id=' .$fila["id"]. '"> <img src="img/file.png" width="20" height="20">';
                  echo ' ' .$fila["nombre_archivo"]. '</a>';
                }
              echo "<div class='hora_msg'>" .$fila["fecha_hora"]. "</div></div>";

            }
          }
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
            $mensaje->setNombreArchivo($file['name']);
            $mensaje->setArchivo("./archivos/" . $mensaje->getNombreArchivo());
            $mensaje->setTamañoArchivo($file['size']);
            $mensaje->setTipoArchivo($file['type']);
            move_uploaded_file($file['tmp_name'], $mensaje->getArchivo());
          }

          $mensaje->insertMensaje();
        }
        return $result;
    }
}
?>
