<?php
//Clase encargada de actualizar la información del objeto Entradas_foro en la BBDD

class Entradas_foro {

  private $id = "";
  private $id_clase = "";
  private $titulo_foro = "";
  private $id_creador = "";
  private $rol_creador = "";
  private $permisos = "";
  private $contenido = "";
  private $fecha = "";

  public function getId(){return $this->id;}
  public function getIdClase(){return $this->id_clase;}
  public function getTituloForo(){return $this->titulo_foro;}
  public function getIdCreador(){return $this->id_creador;}
  public function getRolCreador(){return $this->rol_creador;}
  public function getPermisos(){return $this->permisos;}
  public function getContenido(){return $this->contenido;}
  public function getFecha(){return $this->fecha;}

  public function setId($id){ $this->id = $id;}
  public function setIdClase($idClase){ $this->id_clase = $idClase;}
  public function setTituloForo($titulo){ $this->titulo_foro = $titulo;}
  public function setIdCreador($idCreador){ $this->id_creador = $idCreador;}
  public function setRolCreador($rolCreador){ $this->rol_creador = $rolCreador;}
  public function setPermisos($permisos){ $this->permisos = $permisos;}
  public function setContenido($contenido){ $this->contenido = $contenido;}
  public function setFecha($fecha){ $this->fecha = $fecha;}

  public function getEntradasForoByClase(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idClase = $conn->real_escape_string(self::getIdClase());

    $sql = "SELECT * FROM entradas_foro WHERE id_clase = '$idClase' ORDER BY fecha DESC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getEntradaForoByClaseAndId(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idClase = $conn->real_escape_string(self::getIdClase());
    $id = $conn->real_escape_string(self::getId());

    $sql = "SELECT * FROM entradas_foro WHERE id_clase = '$idClase' AND id = $id";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      self::setTituloForo($row["titulo_foro"]);
      self::setIdCreador($row["id_creador"]);
      self::setRolCreador($row["rol_creador"]);
      self::setPermisos($row["permisos"]);
      self::setContenido($row["contenido"]);
      self::setFecha($row["fecha"]);
    }
    else{
      self::setId(0);
    }
  }

  public function getNumEntradas(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM entradas_foro";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertEntrada(){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());
    $idClase = $conn->real_escape_string(self::getIdClase());
    $titulo = $conn->real_escape_string(self::getTituloForo());
    $idCreador = $conn->real_escape_string(self::getIdCreador());
    $rolCreador = $conn->real_escape_string(self::getRolCreador());
    $permisos = $conn->real_escape_string(self::getPermisos());
    $contenido = $conn->real_escape_string(self::getContenido());
    $fecha = $conn->real_escape_string(self::getFecha());

    $sql = "INSERT INTO entradas_foro (id,id_clase,titulo_foro,id_creador,rol_creador,permisos,contenido,fecha)
            VALUES ('$id','$idClase','$titulo','$idCreador','$rolCreador','$permisos','$contenido','$fecha')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }
}
