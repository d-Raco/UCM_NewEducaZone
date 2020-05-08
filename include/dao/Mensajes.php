<?php
//Clase encargada de actualizar la información del objeto Calificaciones en la BBDD

class Mensajes {

  private $id = "";
  private $id_origen = "";
  private $rol_origen = "";
  private $id_destinatario = "";
  private $rol_destinatario = "";
  private $contenido_msg = "";
  private $fecha_hora = "";

  public function getId(){return $this->id;}
  public function getIdOrigen(){return $this->id_origen;}
  public function getIdDestinatario(){return $this->id_destinatario;}
  public function getRolOrigen(){return $this->rol_origen;}
  public function getRolDestinatario(){return $this->rol_destinatario;}
  public function getMsg(){return $this->contenido_msg;}
  public function getDate(){return $this->fecha_hora;}

  public function setId($_id){$this->id = $_id;}
  public function setIdOrigen($_idorigen){$this->id_origen = $_idorigen;}
  public function setIdDestinatario($_iddest){$this->id_destinatario = $_iddest;}
  public function setRolOrigen($_rolorigen){$this->rol_origen = $_rolorigen;}
  public function setRolDestinatario($_roldest){$this->rol_destinatario = $_roldest;}
  public function setMsg($msg){$this->contenido_msg = $msg;}
  public function setDate($date){$this->fecha_hora = $date;}

  public function getNumMensajes(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM mensajería";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertMensaje($m){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idorig = $conn->real_escape_string($m->getIdOrigen());
    $rolorigen = $conn->real_escape_string($m->getRolOrigen());
    $iddestino = $conn->real_escape_string($m->getIdDestinatario());
    $roldest = $conn->real_escape_string($m->getRolDestinatario());
    $mensaje = $conn->real_escape_string($m->getMsg());
    $tiempo = $conn->real_escape_string($m->getDate());

    $sql = "INSERT INTO mensajería (id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora)
            VALUES ('$idorig','$rolorigen','$iddestino','$roldest','$mensaje','$tiempo')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }

  public function getMensajes($idOrig, $rolOrig, $idDest, $rolDest){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idOrig = $conn->real_escape_string($idOrig);
    $rolOrig = $conn->real_escape_string($rolOrig);
    $idDest = $conn->real_escape_string($idDest);
    $rolDest = $conn->real_escape_string($rolDest);

    $sql = "SELECT contenido_msg,fecha_hora FROM mensajería WHERE id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }
}
