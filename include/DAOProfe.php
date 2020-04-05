<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
  require_once('profesor.php');

class ProfeDAO {

    public function inserta($p) {
    	global $app;
    	$conn = $app->conexionBD();

    	$id = $p->getId();
        $id_centro = $p->getIdCentro();
    	$nombre = $p->getNombre();
    	$ap1 = $p->getAp1();
    	$ap2 = $p->getAp2();
    	$despacho = $p->getDespacho();
    	$correo = $p->getCorreo();
    	$usuario = $p->getUsuario();
    	$contraseña = $p->getContraseña();
        $foto = $p->getFoto();

     	$query = "INSERT INTO profesores VALUES  ( '$id' , '$id_centro' , '$nombre' , '$ap1' , '$ap2' , '$despacho' , '$correo' , '$usuario' , '$contraseña' , '$foto')";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
    }

	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $p->id . "'");
	}

	public function getProfe($usuario) {
		$p = NULL;
		global $app;
		$conn = $app->conexionBD();

		$query = "SELECT * from profesores where usuario = '$usuario'";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

	    	$p = new Profesor($fila['id'], $fila['id_centro'], $fila['nombre'], $fila['apellido1'], $fila['apellido2'], $fila['despacho'], $fila['correo'], $fila['usuario'], $fila['contraseña'], $fila['foto']);
        }

	    return $p;
	}

    public function getCentro($id_centro) {
        $p = NULL;
        global $app;
        $conn = $app->conexionBD();

        $query = "SELECT * from centros where id = '$id_centro'";
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            $p = $fila['nombre']. " (" .$fila['direccion']. ", " .$fila['provincia']. ")";
        }

        return $p;
    }

    public function getAsignaturas($id) {
        global $app;
        $conn = $app->conexionBD();

        $query = "SELECT DISTINCT nombre_asignatura FROM asignaturas WHERE id_profesor = '$id'";
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }
    
    public function getIdProfesor($usuario){
      global $app;
      $conn = $app->conexionBD();

      $sql = "SELECT id FROM profesores WHERE usuario = '$usuario'";
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

    public function getAsignaturasProfesor($idProfesor){
      global $app;
      $conn = $app->conexionBD();

      $sql = "SELECT c.id, c.curso, c.letra, c.titulación, c.numero_alumnos FROM clases c JOIN asignaturas a ON id_asignatura1 = a.id OR id_asignatura2 = a.id OR id_asignatura3 = a.id OR id_asignatura4 = a.id OR id_asignatura5 = a.id OR id_asignatura6 = a.id WHERE a.id = '$idProfesor'";
      $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

      if($result->num_rows > 0){
        $i = 0;
        $clases = array();
        while($filaClases = $result->fetch_assoc()){
          $clases[$i] = $filaClases;
          $i = $i + 1;
        }
        $result->free();
        return $clases;
      }
      else{
        echo "<p>No se ha encontrado ninguna clase asociada al profesor con id ".$idProfesor.".</p>";
      }
    }
}

?>
