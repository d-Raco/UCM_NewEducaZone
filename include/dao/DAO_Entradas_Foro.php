<?php
require_once __DIR__ . '/../transfer/Entradas_Foro.php';

class DAO_Entradas_foro{

  public function getEntradasForoByClase($clase){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idClase = $conn->real_escape_string($clase->getId());

    $sql = "SELECT * FROM entradas_foro WHERE id_clase = '$idClase' ORDER BY fecha DESC";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getEntradaForoByClaseAndId($entrada){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idClase = $conn->real_escape_string($entrada->getIdClase());
    $id = $conn->real_escape_string($entrada->getId());

    $sql = "SELECT * FROM entradas_foro WHERE id_clase = '$idClase' AND id = $id";

    $result = $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $entrada->setTituloForo($row["titulo_foro"]);
      $entrada->setIdCreador($row["id_creador"]);
      $entrada->setRolCreador($row["rol_creador"]);
      $entrada->setPermisos($row["permisos"]);
      $entrada->setContenido($row["contenido"]);
      $entrada->setFecha($row["fecha"]);
    }
    else{
      $entrada->setId(0);
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

  public function insertEntrada($entrada){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $id = $conn->real_escape_string($entrada->getId());
    $idClase = $conn->real_escape_string($entrada->getIdClase());
    $titulo = $conn->real_escape_string($entrada->getTituloForo());
    $idCreador = $conn->real_escape_string($entrada->getIdCreador());
    $rolCreador = $conn->real_escape_string($entrada->getRolCreador());
    $permisos = $conn->real_escape_string($entrada->getPermisos());
    $contenido = $conn->real_escape_string($entrada->getContenido());
    $fecha = $conn->real_escape_string($entrada->getFecha());

    $sql = "INSERT INTO entradas_foro (id,id_clase,titulo_foro,id_creador,rol_creador,permisos,contenido,fecha)
            VALUES ('$id','$idClase','$titulo','$idCreador','$rolCreador','$permisos','$contenido','$fecha')";

    $conn->query($sql)
        or die ($conn->error. " en la línea ".(__LINE__-1));
  }

}

?>
