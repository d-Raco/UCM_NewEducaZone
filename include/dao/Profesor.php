<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD

class Profesor {

  private $id = "";
  private $id_centro = "";
  private $nombre = "";
  private $apellido1 = "";
  private $apellido2 = "";
  private $despacho = "";
  private $correo = "";
  private $usuario = "";
  private $contraseña = "";
  private $foto = "";

  public function getId(){return $this->id;}
  public function getIdCentro(){return $this->id_centro;}
  public function getNombre(){return $this->nombre;}
  public function getAp1(){return $this->apellido1;}
  public function getAp2(){return $this->apellido2;}
  public function getDespacho(){return $this->despacho;}
  public function getCorreo(){return $this->correo;}
  public function getUsuario(){return $this->usuario;}
  public function getContraseña(){return $this->contraseña;}
  public function getFoto(){return $this->foto;}

  public function setId($_id){$this->id = $_id;}
  public function setIdCentro($_id_centro){$this->id_centro = $_id_centro;}
  public function setNombre($_nombre){$this->nombre = $_nombre;}
  public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
  public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
  public function setDespacho($_despacho){$this->despacho = $_despacho;}
  public function setCorreo($_correo){$this->correo = $_correo;}
  public function setUsuario($_usuario){$this->usuario = $_usuario;}
  public function setContraseña($_contraseña){$this->contraseña = $_contraseña;}
  public function setFoto($_foto){$this->foto = $_foto;}

  public function inserta($p) {
  	$app = Aplicacion::getSingleton();
  	$conn = $app->conexionBD();

  	$id = $conn->real_escape_string($p->getId());
    $id_centro = $conn->real_escape_string($p->getIdCentro());
  	$nombre = $conn->real_escape_string($p->getNombre());
  	$ap1 = $conn->real_escape_string($p->getAp1());
  	$ap2 = $conn->real_escape_string($p->getAp2());
  	$despacho = $conn->real_escape_string($p->getDespacho());
  	$correo = $conn->real_escape_string($p->getCorreo());
  	$usuario = $conn->real_escape_string($p->getUsuario());
  	$contraseña = $conn->real_escape_string($p->getContraseña());
    $foto = $conn->real_escape_string($p->getFoto());

   	$query = "INSERT INTO profesores VALUES  ( '$id' , '$id_centro' , '$nombre' , '$ap1' , '$ap2' , '$despacho' , '$correo' , '$usuario' , '$contraseña' , '$foto')";
	$result = $conn->query($query)
          or die ($conn->error. " en la línea ".(__LINE__-1));
  }

	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $conn->real_escape_string($p->id) . "'");
	}

	public function getProfe() {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from profesores where usuario = '%s'", $conn->real_escape_string(self::getUsuario()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
      $fila = $result->fetch_assoc();

      self::setId($fila['id']);
      self::setIdCentro($fila['id_centro']);
      self::setNombre($fila['nombre']);
      self::setAp1($fila['apellido1']);
      self::setAp2($fila['apellido2']);
      self::setDespacho($fila['despacho']);
      self::setCorreo($fila['correo']);
      self::setUsuario($fila['usuario']);
      self::setContraseña($fila['contraseña']);
      self::setFoto($fila['foto']);
    }
	}

    public function getCentro() {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from centros where id = '%s'", $conn->real_escape_string(self::getIdCentro()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            $p = $fila['nombre']. " (" .$fila['direccion']. ", " .$fila['provincia']. ")";
        }

        return $p;
    }

    public function getAsignaturas() {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT DISTINCT nombre_asignatura FROM asignaturas WHERE id_profesor = '%s'", $conn->real_escape_string(self::getId()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAsignaturasProfesor(){
      $app = Aplicacion::getSingleton();
      $conn = $app->conexionBD();

      $idProfesor = $conn->real_escape_string(self::getId());

      $sql = "SELECT DISTINCT c.id, c.curso, c.letra, c.titulación, c.numero_alumnos FROM clases c JOIN asignaturas a ON (id_asignatura1 = a.id OR id_asignatura2 = a.id OR id_asignatura3 = a.id OR id_asignatura4 = a.id OR id_asignatura5 = a.id OR id_asignatura6 = a.id) WHERE a.id_profesor = '$idProfesor'";
      $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

      if($result->num_rows > 0){
        $i = 0;
        $clases = array();
        while($filaClases = $result->fetch_assoc()){
          $clases[$i] = $filaClases;
          $i = $i + 1;
        }
        return $clases;
      }
      else{
        echo "<p>No se ha encontrado ninguna clase asociada al profesor con id ".$idProfesor.".</p>";
      }
    }




    public function updateDatosProfesor( $nombre, $ap1,$ap2,$despacho,$correo){
         $app = Aplicacion::getSingleton();
          $conn = $app->conexionBD();

          $id = self::getId();
          if($nombre != NULL){
            $sql = "UPDATE profesores  SET nombre = '$nombre'  WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));


          }
           if($ap1 != NULL){
            $sql = "UPDATE profesores SET apellido1 = '$ap1'  WHERE id = '$id'    ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($ap2 != NULL){
            $sql = "UPDATE profesores SET apellido2 = '$ap2'  WHERE id = '$id'    ";
             $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($despacho != NULL){
            $sql = "UPDATE profesores SET despacho = '$despacho' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
           if($correo != NULL){
            $sql = "UPDATE profesores SET correo = '$correo' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
      }

      public function getIdProfesor(){
       $app = Aplicacion::getSingleton();
       $conn = $app->conexionBD();

       $sql = sprintf("SELECT id FROM profesores WHERE usuario = '%s'", $conn->real_escape_string(self::getUsuario()));
       $result = $conn->query($sql)
               or die ($conn->error. " en la línea ".(__LINE__-1));

       if($result->num_rows > 0){
         $row = $result->fetch_assoc();
         $result->free();
         return $row["id"];
       }
       else{
         echo "<p>No se ha encontrado ningún profesor con usuario ".$usuario.".</p>";
       }
      }
}
