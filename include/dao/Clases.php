<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD

class Clases {

    private $id = "";
    private $curso = "";
    private $letra = "";
    private $titulacion = "";
    private $id_tutor_clase = "";
    private $numero_alumnos = "";
    private $id_asignatura1 = "";
    private $id_asignatura2 = "";
    private $id_asignatura3 = "";
    private $id_asignatura4 = "";
    private $id_asignatura5 = "";
    private $id_asignatura6 = "";

    public function getId(){return $this->id;}
    public function getCurso(){return $this->curso;}
    public function getLetra(){return $this->letra;}
    public function getTitul(){return $this->titulacion;}
    public function getIdTutor(){return $this->id_tutor_clase;}
    public function getNAlum(){return $this->numero_alumnos;}
    public function getAs1(){return $this->id_asignatura1;}
    public function getAs2(){return $this->id_asignatura2;}
    public function getAs3(){return $this->id_asignatura3;}
    public function getAs4(){return $this->id_asignatura4;}
    public function getAs5(){return $this->id_asignatura5;}
    public function getAs6(){return $this->id_asignatura6;}


    public function setId($_id){$this->id = $_id;}
    public function setCurso($_curso){$this->curso = $_curso;}
    public function setLetra($_letra){$this->letra = $_letra;}
    public function setTitul($_titulacion){$this->titulacion = $_titulacion;}
    public function setIdTutor($_id_tutor_clase){$this->id_tutor_clase = $_id_tutor_clase;}
    public function setNAlum($_numero_alumnos){$this->numero_alumnos = $_numero_alumnos;}
    public function setAs1($_id_asignatura1){$this->id_asignatura1 = $_id_asignatura1;}
    public function setAs2($_id_asignatura2){$this->id_asignatura2 = $_id_asignatura2;}
    public function setAs3($_id_asignatura3){$this->id_asignatura3 = $_id_asignatura3;}
    public function setAs4($_id_asignatura4){$this->id_asignatura4 = $_id_asignatura4;}
    public function setAs5($_id_asignatura5){$this->id_asignatura5 = $_id_asignatura5;}
    public function setAs6($_id_asignatura6){$this->id_asignatura6 = $_id_asignatura6;}

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

	public function getClaseByAsignatura($id) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();
    $id = $conn->real_escape_string($id);

		$query = "SELECT * from clases WHERE id_asignatura1 = '$id' OR id_asignatura2 = '$id' OR id_asignatura3 = '$id' OR id_asignatura4 = '$id' OR id_asignatura5 = '$id' OR id_asignatura6 = '$id'";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

		if($result->num_rows > 0){
        $fila = $result->fetch_assoc();

        self::setId($fila['id']);
        self::setCurso($fila['curso']);
        self::setLetra($fila['letra']);
        self::setTitul($fila['titulación']);
        self::setNAlum($fila['numero_alumnos']);
        self::setAs1($fila['id_asignatura1']);
        self::setAs2($fila['id_asignatura2']);
        self::setAs3($fila['id_asignatura3']);
        self::setAs4($fila['id_asignatura4']);
        self::setAs5($fila['id_asignatura5']);
        self::setAs6($fila['id_asignatura6']);
    }
	}

    public function getAsignaturas() {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT DISTINCT * FROM asignaturas WHERE id_profesor = '%s'", $conn->real_escape_string(self::getIdTutor()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAlumnos() {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT DNI, nombre, apellido1, apellido2, id_tutor_legal FROM alumnos WHERE id_clase = '%s'", $conn->real_escape_string(self::getId()));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return NULL;
        }
    }

    public function getAsignaturaProfesor() {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $a1 = $conn->real_escape_string(self::getAs1());
        $a2 = $conn->real_escape_string(self::getAs2());
        $a3 = $conn->real_escape_string(self::getAs3());
        $a4 = $conn->real_escape_string(self::getAs4());
        $a5 = $conn->real_escape_string(self::getAs5());
        $a6 = $conn->real_escape_string(self::getAs6());

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
}
