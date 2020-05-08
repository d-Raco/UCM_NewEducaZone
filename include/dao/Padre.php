<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD

class Padre {

  private $id = "";
  private $nombre = "";
  private $apellido1 = "";
  private $apellido2 = "";
  private $telefono_movil = "";
  private $telefono_fijo = "";
  private $correo = "";
  private $usuario = "";
  private $contraseña = "";

  public function getId(){return $this->id;}
  public function getNombre(){return $this->nombre;}
  public function getAp1(){return $this->apellido1;}
  public function getAp2(){return $this->apellido2;}
  public function getMovil(){return $this->telefono_movil;}
  public function getFijo(){return $this->telefono_fijo;}
  public function getCorreo(){return $this->correo;}
  public function getUsuario(){return $this->usuario;}
  public function getContraseña(){return $this->contraseña;}

  public function setId($_id){$this->id = $_id;}
  public function setNombre($_nombre){$this->nombre = $_nombre;}
  public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
  public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
  public function setMovil($_telefono_movil){$this->telefono_movil = $_telefono_movil;}
  public function setFijo($_telefono_fijo){$this->telefono_fijo = $_telefono_fijo;}
  public function setCorreo($_correo){$this->correo = $_correo;}
  public function setUsuario($_usuario){$this->usuario = $_usuario;}
  public function setContraseña($_contraseña){$this->contraseña = $_contraseña;}

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

  public function registro($nombre, $ap1, $ap2, $movil, $fijo, $correo, $usuario, $contraseña) {
  	$app = Aplicacion::getSingleton();
  	$conn = $app->conexionBD();

  	$id = self::getTotalPadres() + 1;

   	$query = "INSERT INTO tutor_legal VALUES  ('$id' , '$nombre' , '$ap1' , '$ap2' , '$movil' , '$fijo' , '$correo' , '$usuario' , '$contraseña')";
	  $result = $conn->query($query)
          or die ($conn->error. " en la línea ".(__LINE__-1));
  }

	public function delete($p) {
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();
		$query("DELETE Usuarios where id = '" . $conn->real_escape_string($p->id) . "'");
	}

	public function getPadre($usuario) {
		$padre = NULL;
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from tutor_legal where usuario = '%s'", $conn->real_escape_string($usuario));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
      $fila = $result->fetch_assoc();
      self::setId($fila['id']);
      self::setNombre($fila['nombre']);
      self::setAp1($fila['apellido1']);
      self::setAp2($fila['apellido2']);
      self::setMovil($fila['telefono_movil']);
      self::setFijo($fila['telefono_fijo']);
      self::setCorreo($fila['correo']);
      self::setUsuario($fila['usuario']);
      self::setContraseña($fila['contraseña']);
      $padre = $this;
    }

	    return $padre;
	}

    public function getHijos($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from alumnos where id_tutor_legal = '%s'", $conn->real_escape_string($id));
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

    public function updateDatosPadre( $nombre, $ap1,$ap2,$telefono_movil,$telefono_fijo,$correo,$id){
         $app = Aplicacion::getSingleton();
          $conn = $app->conexionBD();

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
      }


}
