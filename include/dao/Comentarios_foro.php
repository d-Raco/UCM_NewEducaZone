<?php
//Clase encargada de actualizar la información del objeto Comentarios_foro en la BBDD

class Comentarios_foro {

  private $id = "";
  private $id_foro = "";
  private $id_redactor = "";
  private $rol_redactor = "";
  private $titulo = "";
  private $contenido_comentario = "";
  private $fecha = "";

  public function getId(){return $this->id;}
  public function getIdForo(){return $this->id_foro;}
  public function getIdRedactor(){return $this->id_redactor;}
  public function getRolRedactor(){return $this->rol_redactor;}
  public function getTitulo(){return $this->titulo;}
  public function getContenidoComentario(){return $this->contenido_comentario;}
  public function getFecha(){return $this->fecha;}

  public function setId($_id){$this->id = $_id;}
  public function setIdForo($id_foro){$this->id_foro = $id_foro;}
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

    $idForo = $conn->real_escape_string(self::getIdForo());

    $sql = "SELECT * FROM comentarios_foro WHERE id_foro = '$idForo' ORDER BY fecha DESC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function insertComentario(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());
    $id_foro = $conn->real_escape_string(self::getIdForo());
    $id_redactor = $conn->real_escape_string(self::getIdRedactor());
    $rol_redactor = $conn->real_escape_string(self::getRolRedactor());
    $titulo = $conn->real_escape_string(self::getTitulo());
    $contenido_comentario = $conn->real_escape_string(self::getContenidoComentario());
    $fecha = $conn->real_escape_string(self::getFecha());

    $sql = "INSERT INTO comentarios_foro (id,id_foro,id_redactor,rol_redactor,fecha,titulo,contenido_comentario)
            VALUES ('$id','$id_foro','$id_redactor','$rol_redactor','$fecha','$titulo','$contenido_comentario')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }
}
