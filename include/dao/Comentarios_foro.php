<?php
//Clase encargada de actualizar la información del objeto Comentarios_foro en la BBDD

class Comentarios_foro {

  private $id = "";
  private $id_relacion = "";
  private $reply = "";
  private $id_redactor = "";
  private $rol_redactor = "";
  private $titulo = "";
  private $contenido_comentario = "";
  private $fecha = "";

  public function getId(){return $this->id;}
  public function getIdRelacion(){return $this->id_relacion;}
  public function getReply(){return $this->reply;}
  public function getIdRedactor(){return $this->id_redactor;}
  public function getRolRedactor(){return $this->rol_redactor;}
  public function getTitulo(){return $this->titulo;}
  public function getContenidoComentario(){return $this->contenido_comentario;}
  public function getFecha(){return $this->fecha;}

  public function setId($_id){$this->id = $_id;}
  public function setIdRelacion($id_relacion){$this->id_relacion = $id_relacion;}
  public function setReply($reply){$this->reply = $reply;}
  public function setIdRedactor($id_redactor){$this->id_redactor = $id_redactor;}
  public function setRolRedactor($rol_redactor){$this->rol_redactor = $rol_redactor;}
  public function setTitulo($titulo){$this->titulo = $titulo;}
  public function setContenidoComentario($contenido_comentario){$this->contenido_comentario = $contenido_comentario;}
  public function setFecha($fecha){$this->fecha = $fecha;}


  public function getNumComentarios(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM comentarios_foro";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function getComentarios(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id_relacion = $conn->real_escape_string(self::getIdRelacion());

    $sql = "SELECT * FROM comentarios_foro WHERE id_relacion = '$id_relacion' AND reply = 0 ORDER BY fecha DESC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getReplies(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());

    $sql = "SELECT * FROM comentarios_foro WHERE id_relacion = '$id' AND reply = 1 ORDER BY fecha ASC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function insertComentario(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());
    $id_relacion = $conn->real_escape_string(self::getIdRelacion());
    $reply = $conn->real_escape_string(self::getReply());
    $id_redactor = $conn->real_escape_string(self::getIdRedactor());
    $rol_redactor = $conn->real_escape_string(self::getRolRedactor());
    $titulo = $conn->real_escape_string(self::getTitulo());
    $contenido_comentario = $conn->real_escape_string(self::getContenidoComentario());
    $fecha = $conn->real_escape_string(self::getFecha());

    $sql = "INSERT INTO comentarios_foro (id,id_relacion,reply,id_redactor,rol_redactor,fecha,titulo,contenido_comentario)
            VALUES ('$id','$id_relacion','$reply','$id_redactor','$rol_redactor','$fecha','$titulo','$contenido_comentario')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }
}
