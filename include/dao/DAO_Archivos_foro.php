<?php

require_once __DIR__ . '/../transfer/Archivos_foro.php';


class DAO_Archivos_foro{

	public function insertArchivo($_archivo){
	    $app = Aplicacion::getSingleton();
	    $conn = $app->conexionBD();

	    $id = $conn->real_escape_string($_archivo->getId());
	    $idForo = $conn->real_escape_string($_archivo->getIdForo());
	    $nombreArchivo = $conn->real_escape_string($_archivo->getNombreArchivo());
	    $tamanoArchivo = $conn->real_escape_string($_archivo->getTamanoArchivo());
	    $archivo = $conn->real_escape_string($_archivo->getArchivo());
	    $tipoArchivo = $conn->real_escape_string($_archivo->getTipoArchivo());

	    $sql = "INSERT INTO archivos_foro (id,id_foro,nombre_archivo,tamano_archivo,archivo,tipo_archivo)
	            VALUES ('$id','$idForo','$nombreArchivo','$tamanoArchivo','$archivo','$tipoArchivo')";

	    $conn->query($sql)
	        or die ($conn->error. " en la línea ".(__LINE__-1));
	}

	public function getNumArchivos(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM archivos_foro";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function getArchivos($archivos){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string($archivos->getIdForo());

    $sql = "SELECT * FROM archivos_foro WHERE id_foro = '$id'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result;
  }

  public function getArchivoById($arch){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string($arch->getId());

    $sql = "SELECT * FROM archivos_foro WHERE id = '$id'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $fila = $result->fetch_Assoc();
			$arch->setIdForo($fila["id_foro"]);
		  $arch->setNombreArchivo($fila["nombre_archivo"]);
		  $arch->setTamanoArchivo($fila["tamano_archivo"]);
		  $arch->setArchivo($fila["archivo"]);
		  $arch->setTipoArchivo($fila["tipo_archivo"]);
    }
		else{
			$arch->setId(0);
		}
  }
}

?>
