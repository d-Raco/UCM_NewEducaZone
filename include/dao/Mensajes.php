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
  private $etiqueta = "";
  private $nombre_archivo = "";
  private $archivo = "";
  private $tamaño_archivo = "";
  private $tipo_archivo = "";

  public function getId(){return $this->id;}
  public function getIdOrigen(){return $this->id_origen;}
  public function getIdDestinatario(){return $this->id_destinatario;}
  public function getRolOrigen(){return $this->rol_origen;}
  public function getRolDestinatario(){return $this->rol_destinatario;}
  public function getMsg(){return $this->contenido_msg;}
  public function getDate(){return $this->fecha_hora;}
  public function getEtiqueta(){return $this->etiqueta;}
  public function getNombreArchivo(){return $this->nombre_archivo;}
  public function getArchivo(){return $this->archivo;}
  public function getTamañoArchivo(){return $this->tamaño_archivo;}
  public function getTipoArchivo(){return $this->tipo_archivo;}

  public function setId($_id){$this->id = $_id;}
  public function setIdOrigen($_idorigen){$this->id_origen = $_idorigen;}
  public function setIdDestinatario($_iddest){$this->id_destinatario = $_iddest;}
  public function setRolOrigen($_rolorigen){$this->rol_origen = $_rolorigen;}
  public function setRolDestinatario($_roldest){$this->rol_destinatario = $_roldest;}
  public function setMsg($msg){$this->contenido_msg = $msg;}
  public function setDate($date){$this->fecha_hora = $date;}
  public function setEtiqueta($etiqueta){$this->etiqueta = $etiqueta;}
  public function setNombreArchivo($nombre){$this->nombre_archivo = $nombre;}
  public function setArchivo($archivo){$this->archivo = $archivo;}
  public function setTamañoArchivo($tamaño){$this->tamaño_archivo = $tamaño;}
  public function setTipoArchivo($tipo){$this->tipo_archivo = $tipo;}

  public function getNumMensajes(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM mensajería";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertMensaje(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id  = $conn->real_escape_string(self::getId());
    $idorig = $conn->real_escape_string(self::getIdOrigen());
    $rolorigen = $conn->real_escape_string(self::getRolOrigen());
    $iddestino = $conn->real_escape_string(self::getIdDestinatario());
    $roldest = $conn->real_escape_string(self::getRolDestinatario());
    $mensaje = $conn->real_escape_string(self::getMsg());
    $tiempo = $conn->real_escape_string(self::getDate());
    $etiqueta = $conn->real_escape_string(self::getEtiqueta());
    $nombre_archivo = $conn->real_escape_string(self::getNombreArchivo());
    $archivo = $conn->real_escape_string(self::getArchivo());
    $tamaño_archivo = $conn->real_escape_string(self::getTamañoArchivo());
    $tipo_archivo = $conn->real_escape_string(self::getTipoArchivo());

    $sql = "INSERT INTO mensajería (id,id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora,etiqueta,nombre_archivo,archivo,tamaño_archivo,tipo_archivo)
            VALUES ('$id','$idorig','$rolorigen','$iddestino','$roldest','$mensaje','$tiempo','$etiqueta','$nombre_archivo','$archivo','$tamaño_archivo','$tipo_archivo')";

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

    $sql = "SELECT * FROM mensajería WHERE id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getMensajeById(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
    $id = $conn->real_escape_string(self::getId());

    $sql = "SELECT nombre_archivo,archivo,tipo_archivo,tamaño_archivo FROM mensajería WHERE id = '$id'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    $fila = $result->fetch_assoc();
    self::setNombreArchivo($fila["nombre_archivo"]);
    self::setArchivo($fila["archivo"]);
    self::setTipoArchivo($fila["tipo_archivo"]);
    self::setTamañoArchivo($fila["tamaño_archivo"]);
  }

  public function getMensajesByDate($id_Orig, $rol_Orig, $id_Dest, $rol_Dest){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $idOrig = $conn->real_escape_string($id_Orig);
    $rolOrig = $conn->real_escape_string($rol_Orig);
    $idDest = $conn->real_escape_string($id_Dest);
    $rolDest = $conn->real_escape_string($rol_Dest);

    $sql = "SELECT * FROM mensajería WHERE (id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest') OR (id_origen = '$idDest' AND rol_origen = '$rolDest' AND id_destinatario = '$idOrig' AND rol_destinatario = '$rolOrig') ORDER BY fecha_hora ASC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
    return $result;
  }
}
