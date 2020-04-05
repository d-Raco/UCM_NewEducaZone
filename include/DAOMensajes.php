<?php
//Clase encargada de actualizar la información del objeto Calificaciones en la BBDD
  require_once('mensaje.php');

class MensajesDAO {

  public function getNumMensajes(){
    global $app;
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM mensajería";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertMensaje($m){
    global $app;
		$conn = $app->conexionBD();

    $idorig = $m->getIdOrigen();
    $rolorigen = $m->getRolOrigen();
    $iddestino = $m->getIdDestinatario();
    $roldest = $m->getRolDestinatario();
    $mensaje = $m->getMsg();
    $tiempo = $m->getDate();

    $sql = "INSERT INTO mensajería (id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora)
            VALUES ('$idorig','$rolorigen','$iddestino','$roldest','$mensaje','$tiempo')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }

  public function getMensajes($idOrig, $rolOrig, $idDest, $rolDest){
    global $app;
		$conn = $app->conexionBD();

    $sql = "SELECT contenido_msg,fecha_hora FROM mensajería WHERE id_origen = '$idOrig' AND rol_origen = '$rolOrig' AND id_destinatario = '$idDest' AND rol_destinatario = '$rolDest'";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }
}
?>
