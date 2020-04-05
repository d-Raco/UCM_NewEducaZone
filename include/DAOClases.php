<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
  require_once('clases.php');

class ClasesDAO {

    public function inserta($p) {
    	global $app;
    	$conn = $app->conexionBD();

    	$id = $this->getTotalPadres() + 1;
    	$nombre = $p->getNombre();
    	$ap1 = $p->getAp1();
    	$ap2 = $p->getAp2();
    	$movil = $p->getMovil();
    	$fijo = $p->getFijo();
    	$correo = $p->getCorreo();
    	$usuario = $p->getUsuario();
    	$contraseña = $p->getContraseña();

    	$p->setId($id);

     	$query = "INSERT INTO tutor_legal VALUES  ( '$id' , '$nombre' , '$ap1' , '$ap2' , '$movil' , '$fijo' , '$correo' , '$usuario' , '$contraseña')";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    }

	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $p->id . "'");
	}

	public function getClase($id) {
		$p = NULL;
		global $app;
		$conn = $app->conexionBD();

		$query = "SELECT * from clases WHERE id_asignatura1 = '$id' OR id_asignatura2 = '$id' OR id_asignatura3 = '$id' OR id_asignatura4 = '$id' OR id_asignatura5 = '$id' OR id_asignatura6 = '$id'";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

	    	$c = new Clases($fila['id'], $fila['curso'], $fila['letra'], $fila['titulación'], $fila['id_tutor_clase'], $fila['numero_alumnos'], $fila['id_asignatura1'], $fila['id_asignatura2'], $fila['id_asignatura3'], $fila['id_asignatura4'], $fila['id_asignatura5'], $fila['id_asignatura6']);
        }

	    return $c;
	}

    public function getAsignaturas($id) {
        global $app;
        $conn = $app->conexionBD();

        $query = "SELECT DISTINCT * FROM asignaturas WHERE id_profesor = '$id'";
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
        global $app;
        $conn = $app->conexionBD();

        $query = "SELECT DNI, nombre, apellido1, apellido2, id_tutor_legal FROM alumnos WHERE id_clase = '$id'";
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAsignaturaProfesor($c) {
        global $app;
        $conn = $app->conexionBD();

        $a1 = $c->getAs1();
        $a2 = $c->getAs2();
        $a3 = $c->getAs3();
        $a4 = $c->getAs4();
        $a5 = $c->getAs5();
        $a6 = $c->getAs6();

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
        global $app;
        $conn = $app->conexionBD();

        $sql = "SELECT * FROM asignaturas WHERE id = '$id'";
        $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else{
            return NULL;
        }
    }
}

?>
