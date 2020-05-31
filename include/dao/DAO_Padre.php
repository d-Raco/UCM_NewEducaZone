<?php
require_once __DIR__ . '/../transfer/Padre.php';


class DAO_Padre{

	public function getTotalPadres(){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query="SELECT * FROM tutor_legal";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        $rows = $result->num_rows;
        $result->free();

        return $rows;
	}

	public function registro($padre) {
	  	$app = Aplicacion::getSingleton();
	  	$conn = $app->conexionBD();

	  	$id = self::getTotalPadres() + 1;
	  	$nombre = $conn->real_escape_string($padre->getNombre());
	  	$ap1 = $conn->real_escape_string($padre->getAp1());
	  	$ap2 = $conn->real_escape_string($padre->getAp2());
	  	$movil = $conn->real_escape_string($padre->getMovil());
	  	$fijo = $conn->real_escape_string($padre->getFijo());
	  	$correo = $conn->real_escape_string($padre->getCorreo());
	  	$usuario = $conn->real_escape_string($padre->getUsuario());
	  	$contrasena = $conn->real_escape_string($padre->getContrasena());
	    $foto = $conn->real_escape_string($padre->getFoto());

	   	$query = "INSERT INTO tutor_legal VALUES  ( '$id' , '$nombre' , '$ap1' , '$ap2' , '$movil' , '$fijo' , '$correo' , '$usuario' , '$contrasena' , '$foto')";
		$result = $conn->query($query)
	          or die ($conn->error. " en la línea ".(__LINE__-1));

	}

	public function getPadre($padre) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from tutor_legal where usuario = '%s'", $conn->real_escape_string($padre->getUsuario()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
	      $fila = $result->fetch_assoc();
	      $padre->setId($fila['id']);
	      $padre->setNombre($fila['nombre']);
	      $padre->setAp1($fila['apellido1']);
	      $padre->setAp2($fila['apellido2']);
	      $padre->setMovil($fila['telefono_movil']);
	      $padre->setFijo($fila['telefono_fijo']);
	      $padre->setCorreo($fila['correo']);
	      $padre->setUsuario($fila['usuario']);
	      $padre->setContrasena($fila['password']);
	      $padre->setFoto($fila['foto']);
	    }
	}

  public function getPadreById($padre) {
  		$app = Aplicacion::getSingleton();
  		$conn = $app->conexionBD();

      $id = $padre->getId();

  		$query = sprintf("SELECT * from tutor_legal where id = '%s'", $conn->real_escape_string($id));
  		$result = $conn->query($query)
              or die ($conn->error. " en la línea ".(__LINE__-1));
  		if($result->num_rows > 0){
        $fila = $result->fetch_assoc();
        $padre->setId($id);
        $padre->setUsuario($fila['usuario']);
        $padre->setNombre($fila['nombre']);
        $padre->setAp1($fila['apellido1']);
        $padre->setAp2($fila['apellido2']);
        $padre->setMovil($fila['telefono_movil']);
        $padre->setFijo($fila['telefono_fijo']);
        $padre->setCorreo($fila['correo']);
        $padre->setUsuario($fila['usuario']);
        $padre->setContrasena($fila['password']);
        $padre->setFoto($fila['foto']);
      }
      else{
        return NULL;
      }
  	}

    public function getHijos($padre) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();
        $query = sprintf("SELECT * from alumnos where id_tutor_legal = '%s'", $conn->real_escape_string($padre->getId()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

     public function getIdPadre($usuario){
      $app = Aplicacion::getSingleton();
      $conn = $app->conexionBD();

      $sql = sprintf("SELECT id FROM tutor_legal WHERE usuario = '%s'", $conn->real_escape_string($usuario));
      $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $result->free();
        return $row["id"];
      }
      else{
        echo "<p>No se ha encontrado ningún padre con usuario ".$usuario.".</p>";
      }
    }


    public function updateDatosPadre( $nombre, $ap1,$ap2,$telefono_movil,$telefono_fijo,$correo,$contrasena, $foto){
         $app = Aplicacion::getSingleton();
          $conn = $app->conexionBD();

          $id = self::getId();
          if($nombre != NULL){
            $sql = "UPDATE tutor_legal  SET nombre = '$nombre'  WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));


          }
           if($ap1 != NULL){
            $sql = "UPDATE tutor_legal SET apellido1 = '$ap1'  WHERE id = '$id'    ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($ap2 != NULL){
            $sql = "UPDATE tutor_legal SET apellido2 = '$ap2'  WHERE id = '$id'    ";
             $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($telefono_movil != NULL){
            $sql = "UPDATE tutor_legal SET telefono_movil = '$telefono_movil' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          } if($telefono_fijo != NULL){
            $sql = "UPDATE tutor_legal SET telefono_fijo = '$telefono_fijo' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($correo != NULL){
            $sql = "UPDATE tutor_legal SET correo = '$correo' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($contrasena != NULL){
            $sql = "UPDATE tutor_legal SET password = '$contrasena' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
          if($foto != NULL){
            $sql = "UPDATE tutor_legal SET foto = '$foto' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
      }

      public function codigo_acceso($codigo){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from codigos_de_acceso where codigo = '%s'", $conn->real_escape_string($codigo));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
          $query = sprintf("DELETE Usuarios where codigo = '%s'", $conn->real_escape_string($codigo));
          return TRUE;
        }
        else{
          return FALSE;
        }
    }

}

?>
