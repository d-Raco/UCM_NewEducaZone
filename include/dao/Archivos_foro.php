<?php
//Clase encargada de actualizar la información del objeto archivos_foro en la BBDD

class Archivos_foro {

  private $id = "";
  private $id_foro = "";
  private $nombre_archivo = "";
  private $tamaño_archivo = "";
  private $archivo = "";
  private $tipo_archivo = "";


  public function getId(){return $this->id;}
  public function getIdForo(){return $this->id_foro;}
  public function getNombreArchivo(){return $this->nombre_archivo;}
  public function getTamañoArchivo(){return $this->tamaño_archivo;}
  public function getArchivo(){return $this->archivo;}
  public function getTipoArchivo(){return $this->tipo_archivo;}

  public function setId($id){ $this->id = $id;}
  public function setIdForo($idForo){ $this->id_foro = $idForo;}
  public function setNombreArchivo($nombreArchivo){ $this->nombre_archivo = $nombreArchivo;}
  public function setTamañoArchivo($tamañoArchivo){ $this->tamaño_archivo = $tamañoArchivo;}
  public function setArchivo($archivo){ $this->archivo = $archivo;}
  public function setTipoArchivo($tipoArchivo){ $this->tipo_archivo = $tipoArchivo;}

  public function getNumArchivos(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM archivos_foro";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function getArchivos(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getIdForo());

    $sql = "SELECT * FROM archivos_foro WHERE id_foro = '$id'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getArchivoById(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());

    $sql = "SELECT * FROM archivos_foro WHERE id = '$id'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $fila = $result->fetch_Assoc();

      self::setIdForo($fila["id_foro"]);
      self::setNombreArchivo($fila["nombre_archivo"]);
      self::setTamañoArchivo($fila["tamaño_archivo"]);
      self::setArchivo($fila["archivo"]);
      self::setTipoArchivo($fila["tipo_archivo"]);
    }
    else{
      self::setId(0);
    }
  }

  public function insertArchivo(){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());
    $idForo = $conn->real_escape_string(self::getIdForo());
    $nombreArchivo = $conn->real_escape_string(self::getNombreArchivo());
    $tamañoArchivo = $conn->real_escape_string(self::getTamañoArchivo());
    $archivo = $conn->real_escape_string(self::getArchivo());
    $tipoArchivo = $conn->real_escape_string(self::getTipoArchivo());

    $sql = "INSERT INTO archivos_foro (id,id_foro,nombre_archivo,tamaño_archivo,archivo,tipo_archivo)
            VALUES ('$id','$idForo','$nombreArchivo','$tamañoArchivo','$archivo','$tipoArchivo')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }
}
