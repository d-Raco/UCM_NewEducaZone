<?php
require_once __DIR__ . '/../transfer/Mensajes.php';


class DAO_Mensajes{

  public function getNumMensajes(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM mensajeria";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertMensaje($mensaje){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id  = $conn->real_escape_string($mensaje->getId());
    $idorig = $conn->real_escape_string($mensaje->getIdOrigen());
    $rolorigen = $conn->real_escape_string($mensaje->getRolOrigen());
    $iddestino = $conn->real_escape_string($mensaje->getIdDestinatario());
    $roldest = $conn->real_escape_string($mensaje->getRolDestinatario());
    $msg = $conn->real_escape_string($mensaje->getMsg());
    $tiempo = $conn->real_escape_string($mensaje->getDate());
    $etiqueta = $conn->real_escape_string($mensaje->getEtiqueta());
    $nombre_archivo = $conn->real_escape_string($mensaje->getNombreArchivo());
    $archivo = $conn->real_escape_string($mensaje->getArchivo());
    $tamano_archivo = $conn->real_escape_string($mensaje->getTamanoArchivo());
    $tipo_archivo = $conn->real_escape_string($mensaje->getTipoArchivo());

    $sql = "INSERT INTO mensajeria (id,id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora,etiqueta,nombre_archivo,archivo,tamano_archivo,tipo_archivo)
            VALUES ('$id','$idorig','$rolorigen','$iddestino','$roldest','$msg','$tiempo','$etiqueta','$nombre_archivo','$archivo','$tamano_archivo','$tipo_archivo')";

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

    $sql = "SELECT * FROM mensajeria WHERE id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getMensajeById($msg){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
    $id = $conn->real_escape_string($msg->getId());

    $sql = "SELECT nombre_archivo,archivo,tipo_archivo,tamano_archivo FROM mensajeria WHERE id = '$id'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $fila = $result->fetch_assoc();
      $msg->setTamanoArchivo($fila['tamano_archivo']);
      $msg->setTipoArchivo($fila['tipo_archivo']);
      $msg->setNombreArchivo($fila['nombre_archivo']);
      $msg->setArchivo($fila['archivo']);
    }
    else{
      return 0;
    }
  }

  public function getMensajesByDate($id_Orig, $rol_Orig, $id_Dest, $rol_Dest){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $idOrig = $conn->real_escape_string($id_Orig);
    $rolOrig = $conn->real_escape_string($rol_Orig);
    $idDest = $conn->real_escape_string($id_Dest);
    $rolDest = $conn->real_escape_string($rol_Dest);

    $sql = "SELECT * FROM mensajeria WHERE (id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest') OR (id_origen = '$idDest' AND rol_origen = '$rolDest' AND id_destinatario = '$idOrig' AND rol_destinatario = '$rolOrig') ORDER BY fecha_hora ASC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
    return $result;
  }


}

?>
