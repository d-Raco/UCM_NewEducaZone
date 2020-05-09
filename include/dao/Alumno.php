<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
class Alumno {

    private $DNI = "";
    private $nombre = "";
    private $apellido1 = "";
    private $apellido2 = "";
    private $id_centro = "";
    private $id_clase = "";
    private $observaciones_medicas = "";
    private $id_tutor_legal = "";
    private $fecha_nacimiento = "";
    private $id_calificaciones = "";
    private $foto = "";

    public function getDNI(){return $this->DNI;}
    public function getNombre(){return $this->nombre;}
    public function getAp1(){return $this->apellido1;}
    public function getAp2(){return $this->apellido2;}
    public function getIdCentro(){return $this->id_centro;}
    public function getIdClase(){return $this->id_clase;}
    public function getOM(){return $this->observaciones_medicas;}
    public function getIdTutor(){return $this->id_tutor_legal;}
    public function getFecha(){return $this->fecha_nacimiento;}
    public function getCal(){return $this->id_calificaciones;}
    public function getFoto(){return $this->foto;}


    public function setDNI($_DNI){$this->DNI = $_DNI;}
    public function setNombre($_nombre){$this->nombre = $_nombre;}
    public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
    public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
    public function setIdCentro($_id_centro){$this->id_centro = $_id_centro;}
    public function setIdClase($_id_clase){$this->id_clase = $_id_clase;}
    public function setOM($_observaciones_medicas){$this->observaciones_medicas = $_observaciones_medicas;}
    public function setTutor($_id_tutor_legal){$this->id_tutor_legal = $_id_tutor_legal;}
    public function setFecha($_fecha_nacimiento){$this->fecha_nacimiento = $_fecha_nacimiento;}
    public function setCal($_id_calificaciones){$this->id_calificaciones = $_id_calificaciones;}
    public function setFoto($_foto){$this->foto = $_foto;}


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
		$query("DELETE Usuarios where id = '" . $p->id . "'");
	}

	public function getAlumno() {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from alumnos where DNI = '%s'", $conn->real_escape_string(self::getDNI()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            self::setDNI($fila['DNI']);
            self::setNombre($fila['nombre']);
            self::setAp1($fila['apellido1']);
            self::setAp2($fila['apellido2']);
            self::setIdCentro($fila['id_centro']);
            self::setIdClase($fila['id_clase']);
            self::setOM($fila['observaciones_medicas']);
            self::setTutor($fila['id_tutor_legal']);
            self::setFecha($fila['fecha_nacimiento']);
            self::setCal($fila['id_calificaciones']);
            self::setFoto($fila['foto']);
        }
	}

    public function getClase() {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from clases where id = '%s'", $conn->real_escape_string(self::getIdClase()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else{
            return NULL;
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
            return $result->fetch_assoc();
        }
        return $p;
    }

    public function getTutor() {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from tutor_legal where id = '%s'", $conn->real_escape_string(self::getIdTutor()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return $p;
    }

    public function getProfesores() {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $filaClase = $this->getClase();
        $conn = $app->conexionBD();

        $a1 = $conn->real_escape_string($filaClase["id_asignatura1"]);
        $a2 = $conn->real_escape_string($filaClase["id_asignatura2"]);
        $a3 = $conn->real_escape_string($filaClase["id_asignatura3"]);
        $a4 = $conn->real_escape_string($filaClase["id_asignatura4"]);
        $a5 = $conn->real_escape_string($filaClase["id_asignatura5"]);
        $a6 = $conn->real_escape_string($filaClase["id_asignatura6"]);
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
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from profesores where id = '%s'", $conn->real_escape_string($id_profe));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }

        return $p;
    }


}
