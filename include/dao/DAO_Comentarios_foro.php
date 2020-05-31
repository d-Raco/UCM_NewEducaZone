<?php
require_once __DIR__ . '/../transfer/Comentarios_foro.php';

class DAO_Comentarios_foro{

  public function getNumComentarios(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM comentarios_foro";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function getComentarios($id){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id_relacion = $conn->real_escape_string($id);

    $sql = "SELECT * FROM comentarios_foro WHERE id_relacion = '$id_relacion' AND reply = 0 ORDER BY fecha ASC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getReplies($id){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM comentarios_foro WHERE id_relacion = '$id' AND reply = 1 ORDER BY fecha ASC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function insertComentario($comentario){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string($comentario->getId());
    $id_relacion = $conn->real_escape_string($comentario->getIdRelacion());
    $reply = $conn->real_escape_string($comentario->getReply());
    $id_redactor = $conn->real_escape_string($comentario->getIdRedactor());
    $rol_redactor = $conn->real_escape_string($comentario->getRolRedactor());
    $titulo = $conn->real_escape_string($comentario->getTitulo());
    $contenido_comentario = $conn->real_escape_string($comentario->getContenidoComentario());
    $fecha = $conn->real_escape_string($comentario->getFecha());

    $sql = "INSERT INTO comentarios_foro (id,id_relacion,reply,id_redactor,rol_redactor,fecha,titulo,contenido_comentario)
            VALUES ('$id','$id_relacion','$reply','$id_redactor','$rol_redactor','$fecha','$titulo','$contenido_comentario')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }

}

?>
