<?php
require_once __DIR__ . '/../transfer/Profesor.php';

class DAO_Profesor{
	public function getTotalProfes(){
     $app = Aplicacion::getSingleton();
     $conn = $app->conexionBD();

     $query="SELECT * FROM profesores";
     $result = $conn->query($query)
             or die ($conn->error. " en la línea ".(__LINE__-1));
         $rows = $result->num_rows;
         $result->free();

         return $rows+20;
   }

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
	  	$contrasena = $conn->real_escape_string($p->getContrasena());
	    $foto = $conn->real_escape_string($p->getFoto());

	   	$query = "INSERT INTO profesores VALUES  ( '$id' , '$id_centro' , '$nombre' , '$ap1' , '$ap2' , '$despacho' , '$correo' , '$usuario' , '$contrasena' , '$foto')";
		$result = $conn->query($query)
	          or die ($conn->error. " en la línea ".(__LINE__-1));
	}

	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $conn->real_escape_string($p->id) . "'");
	}

	public function getProfe($profesor) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from profesores where usuario = '%s'", $conn->real_escape_string($profesor->getUsuario()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
	      $fila = $result->fetch_assoc();

	      $profesor->setId($fila['id']);
	      $profesor->setIdCentro($fila['id_centro']);
	      $profesor->setNombre($fila['nombre']);
	      $profesor->setAp1($fila['apellido1']);
	      $profesor->setAp2($fila['apellido2']);
	      $profesor->setDespacho($fila['despacho']);
	      $profesor->setCorreo($fila['correo']);
	      $profesor->setUsuario($fila['usuario']);
	      $profesor->setContrasena($fila['password']);
	      $profesor->setFoto($fila['foto']);
	    }
	}

  	public function getProfesorById($profe) {
  		$app = Aplicacion::getSingleton();
  		$conn = $app->conexionBD();
      $id = $profe->getId();

  		$query = sprintf("SELECT * from profesores where id = '%s'", $conn->real_escape_string($id));
  		$result = $conn->query($query)
              or die ($conn->error. " en la línea ".(__LINE__-1));
  		if($result->num_rows > 0){
        $fila = $result->fetch_assoc();
        $profe->setId($id);
        $profe->setUsuario($fila['usuario']);
        $profe->setIdCentro($fila['id_centro']);
        $profe->setNombre($fila['nombre']);
        $profe->setAp1($fila['apellido1']);
        $profe->setAp2($fila['apellido2']);
        $profe->setDespacho($fila['despacho']);
        $profe->setCorreo($fila['correo']);
        $profe->setUsuario($fila['usuario']);
        $profe->setContrasena($fila['password']);
        $profe->setFoto($fila['foto']);
      }
  	}
    public function getCentro2($id) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from centros where id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return $p;
    }
    public function getCentro($id) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from centros where id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            $p = $fila['nombre']. " (" .$fila['direccion']. ", " .$fila['provincia']. ")";
        }

        return $p;
    }

    public function getAsignaturas($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT DISTINCT nombre_asignatura FROM asignaturas WHERE id_profesor = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAsignaturasProfesor($id){
      $app = Aplicacion::getSingleton();
      $conn = $app->conexionBD();

      $idProfesor = $conn->real_escape_string($id);

      $sql = "SELECT DISTINCT c.id, c.curso, c.letra, c.titulacion, c.numero_alumnos FROM clases c JOIN asignaturas a ON (id_asignatura1 = a.id OR id_asignatura2 = a.id OR id_asignatura3 = a.id OR id_asignatura4 = a.id OR id_asignatura5 = a.id OR id_asignatura6 = a.id) WHERE a.id_profesor = '$idProfesor'";
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

    public function updateDatosProfesor( $id, $nombre, $ap1,$ap2,$despacho,$correo,$contrasena){
         $app = Aplicacion::getSingleton();
          $conn = $app->conexionBD();

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
          if($contrasena != NULL){
            $sql = "UPDATE profesores SET password = '$contrasena' WHERE id = '$id'  ";
               $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          }
      }

    public function getIdProfesor($usuario){
       $app = Aplicacion::getSingleton();
       $conn = $app->conexionBD();

       $sql = sprintf("SELECT id FROM profesores WHERE usuario = '%s'", $conn->real_escape_string($usuario));
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

?>
