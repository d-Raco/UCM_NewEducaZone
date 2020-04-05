<?php 
//Clase encargada de actualizar la información del objeto Usuario en la BBDD 
  require_once('alumno.php');

class AlumnoDAO {

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
	 
	public function getAlumno($id) { 
		$p = NULL; 
		global $app;
		$conn = $app->conexionBD();      
		
		$query = "SELECT * from alumnos where DNI = '$id'"; 
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

	    	$p = new Alumno($fila['DNI'], $fila['nombre'], $fila['apellido1'], $fila['apellido2'], $fila['id_centro'], $fila['id_clase'], $fila['observaciones_medicas'], $fila['id_tutor_legal'], $fila['fecha_nacimiento'], $fila['id_calificaciones'], $fila['foto']);         
        }

	    return $p;     
	} 

    public function getClase($id_clase) {  
        global $app;
        $conn = $app->conexionBD();      
        
        $query = "SELECT * from clases where id = '$id_clase'"; 
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
        if($result->num_rows > 0){
            return $result->fetch_assoc(); 
        }
        else{
            return NULL;
        }
    }

    public function getCentro($id_centro) { 
        $p = NULL; 
        global $app;
        $conn = $app->conexionBD();      
        
        $query = "SELECT * from centros where id = '$id_centro'"; 
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
        if($result->num_rows > 0){
            return $result->fetch_assoc(); 
        }

        return $p;     
    } 

    public function getTutor($id_tutor) { 
        $p = NULL; 
        global $app;
        $conn = $app->conexionBD();      
        
        $query = "SELECT * from tutor_legal where id = '$id_tutor'"; 
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
        if($result->num_rows > 0){
            return $result->fetch_assoc(); 
        }

        return $p;     
    } 

    public function getProfesores($id_clase) { 
        $p = NULL; 
        global $app;
        $filaClase = $this->getClase($id_clase);
        $conn = $app->conexionBD();  
        
        $a1 = $filaClase["id_asignatura1"];
        $a2 = $filaClase["id_asignatura2"];
        $a3 = $filaClase["id_asignatura3"];
        $a4 = $filaClase["id_asignatura4"];
        $a5 = $filaClase["id_asignatura5"];
        $a6 = $filaClase["id_asignatura6"];
        $sql = "SELECT id_profesor, nombre_asignatura FROM asignaturas WHERE id = '$a1' || id = '$a2' || id = '$a3' || id = '$a4' || id = '$a5' || id = '$a6'";
        $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));        
        if($result->num_rows > 0){
            return $result; 
        }

        return $p;     
    }

    public function getProfe($id_profe) { 
        $p = NULL; 
        global $app;
        $conn = $app->conexionBD();      
        
        $query = "SELECT * from profesores where id = '$id_profe'"; 
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
        if($result->num_rows > 0){
            return $result->fetch_assoc(); 
        }

        return $p;   
    }


}

?>