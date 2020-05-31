<?php
require_once __DIR__ . '/../transfer/Clases.php';

class DAO_Clases{

	public function inserta($p) {
    	$app = Aplicacion::getSingleton();
    	$conn = $app->conexionBD();

    	$id = $this->getTotalPadres() + 1;
    	$nombre = $conn->real_escape_string($p->getNombre());
    	$ap1 = $conn->real_escape_string($p->getAp1());
    	$ap2 = $conn->real_escape_string($p->getAp2());
    	$movil = $conn->real_escape_string($p->getMovil());
    	$fijo = $conn->real_escape_string($p->getFijo());
    	$correo = $conn->real_escape_string($p->getCorreo());
    	$usuario = $conn->real_escape_string($p->getUsuario());
    	$contraseña = $conn->real_escape_string($p->getContraseña());

    	$p->setId($conn->real_escape_string($id));

     	$query = "INSERT INTO tutor_legal VALUES  ( '$id' , '$nombre' , '$ap1' , '$ap2' , '$movil' , '$fijo' , '$correo' , '$usuario' , '$contraseña')";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    }

	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $conn->real_escape_string($p->id) . "'");
	}

    public function setClase($clase){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $id = $conn->real_escape_string($clase->getId());
        $query = "SELECT * from clases WHERE id = '$id'";
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

        if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $clase->setId($fila['id']);
            $clase->setCurso($fila['curso']);
            $clase->setLetra($fila['letra']);
            $clase->setTitul($fila['titulacion']);
            $clase->setNAlum($fila['numero_alumnos']);
            $clase->setAs1($fila['id_asignatura1']);
            $clase->setAs2($fila['id_asignatura2']);
            $clase->setAs3($fila['id_asignatura3']);
            $clase->setAs4($fila['id_asignatura4']);
            $clase->setAs5($fila['id_asignatura5']);
            $clase->setAs6($fila['id_asignatura6']);
        }
    }

	public function getClaseByAsignatura($clase, $id) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
        $id = $conn->real_escape_string($id);

		$query = "SELECT * from clases WHERE id_asignatura1 = '$id' OR id_asignatura2 = '$id' OR id_asignatura3 = '$id' OR id_asignatura4 = '$id' OR id_asignatura5 = '$id' OR id_asignatura6 = '$id'";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $clase->setId($fila['id']);
            $clase->setCurso($fila['curso']);
            $clase->setLetra($fila['letra']);
            $clase->setTitul($fila['titulacion']);
            $clase->setNAlum($fila['numero_alumnos']);
            $clase->setAs1($fila['id_asignatura1']);
            $clase->setAs2($fila['id_asignatura2']);
            $clase->setAs3($fila['id_asignatura3']);
            $clase->setAs4($fila['id_asignatura4']);
            $clase->setAs5($fila['id_asignatura5']);
            $clase->setAs6($fila['id_asignatura6']);
        }
	}

  public function getClaseById($clase) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
        $id = $conn->real_escape_string($clase->getId());

		$query = "SELECT * from clases WHERE id = '$id'";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $clase->setCurso($fila['curso']);
            $clase->setLetra($fila['letra']);
            $clase->setTitul($fila['titulacion']);
            $clase->setNAlum($fila['numero_alumnos']);
            $clase->setAs1($fila['id_asignatura1']);
            $clase->setAs2($fila['id_asignatura2']);
            $clase->setAs3($fila['id_asignatura3']);
            $clase->setAs4($fila['id_asignatura4']);
            $clase->setAs5($fila['id_asignatura5']);
            $clase->setAs6($fila['id_asignatura6']);
        }
	}

    public function getAsignaturas($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();
        $query = sprintf("SELECT DISTINCT * FROM asignaturas WHERE id_profesor = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAlumnos($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT DNI, nombre, apellido1, apellido2, id_tutor_legal, foto FROM alumnos WHERE id_clase = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAsignaturaProfesor($clase) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $a1 = $conn->real_escape_string($clase->getAs1());
        $a2 = $conn->real_escape_string($clase->getAs2());
        $a3 = $conn->real_escape_string($clase->getAs3());
        $a4 = $conn->real_escape_string($clase->getAs4());
        $a5 = $conn->real_escape_string($clase->getAs5());
        $a6 = $conn->real_escape_string($clase->getAs6());

        $sql = "SELECT  a.nombre_asignatura, p.id, p.nombre, p.apellido1, p.apellido2 FROM asignaturas a JOIN profesores p ON a.id_profesor = p.id WHERE a.id = '$a1' || a.id = '$a2' || a.id = '$a3' || a.id = '$a4' || a.id = '$a5' || a.id = '$a6'";
        $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

        if($result->num_rows > 0){
          $i = 0;
          $asignaturas = array();
          while($filaAsignatura = $result->fetch_assoc()){
            $asignaturas[$i] = $filaAsignatura;
            $i = $i + 1;
          }
          $result->free();
          return $asignaturas;
        }
        else{
            return NULL;
        }
    }

    public function getAsignatura($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $sql = sprintf("SELECT * FROM asignaturas WHERE id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else{
            return NULL;
        }
    }

    public function getClaseByTutor($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $sql = sprintf("SELECT id,curso,letra,titulacion FROM clases WHERE id_tutor_clase = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

        if($result->num_rows > 0){
            return $result;
        }
        else{
            echo "El profesor con id " .$id. " no es tutor de ninguna clase.";
        }
    }

}

?>
