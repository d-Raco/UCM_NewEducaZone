<?php
//Clase encargada de actualizar la información del objeto Calificaciones en la BBDD

class Calificaciones {

  private $id = "";
  private $id_asignatura1 = "";
  private $nota1 = "";
  private $id_asignatura2 = "";
  private $nota2 = "";
  private $id_asignatura3 = "";
  private $nota3 = "";
  private $id_asignatura4 = "";
  private $nota4 = "";
  private $id_asignatura5 = "";
  private $nota5 = "";
  private $id_asignatura6 = "";
  private $nota6 = "";

  public function getId(){return $this->id;}
  public function getIdAsignatura1(){return $this->id_asignatura1;}
  public function getNotaAsignatura1(){return $this->nota1;}
  public function getIdAsignatura2(){return $this->id_asignatura2;}
  public function getNotaAsignatura2(){return $this->nota2;}
  public function getIdAsignatura3(){return $this->id_asignatura3;}
  public function getNotaAsignatura3(){return $this->nota3;}
  public function getIdAsignatura4(){return $this->id_asignatura4;}
  public function getNotaAsignatura4(){return $this->nota4;}
  public function getIdAsignatura5(){return $this->id_asignatura5;}
  public function getNotaAsignatura5(){return $this->nota5;}
  public function getIdAsignatura6(){return $this->id_asignatura6;}
  public function getNotaAsignatura6(){return $this->nota6;}

  public function getIdAsignatura($i){
    switch($i){
      case 1:
        return $this->getIdAsignatura1();
        break;
      case 2:
        return $this->getIdAsignatura2();
        break;
      case 3:
        return $this->getIdAsignatura3();
        break;
      case 4:
        return $this->getIdAsignatura4();
        break;
      case 5:
        return $this->getIdAsignatura5();
        break;
      case 6:
        return $this->getIdAsignatura6();
        break;
    }
  }

  public function getNotaAsignatura($i){
    switch($i){
      case 1:
        return $this->getNotaAsignatura1();
        break;
      case 2:
        return $this->getNotaAsignatura2();
        break;
      case 3:
        return $this->getNotaAsignatura3();
        break;
      case 4:
        return $this->getNotaAsignatura4();
        break;
      case 5:
        return $this->getNotaAsignatura5();
        break;
      case 6:
        return $this->getNotaAsignatura6();
        break;
    }
  }

  public function getNotaAsignaturaById($id){
    switch($id){
      case $this->getIdAsignatura1():
        return $this->getNotaAsignatura1();
        break;
      case $this->getIdAsignatura2():
        return $this->getNotaAsignatura2();
        break;
      case $this->getIdAsignatura3():
        return $this->getNotaAsignatura3();
        break;
      case $this->getIdAsignatura4():
        return $this->getNotaAsignatura4();
        break;
      case $this->getIdAsignatura5():
        return $this->getNotaAsignatura5();
        break;
      case $this->getIdAsignatura6():
        return $this->getNotaAsignatura6();
        break;
    }
  }

  public function setId($_id){$this->id = $_id;}
  public function setIdAsignatura1($_idasignatura1){$this->id_asignatura1 = $_idasignatura1;}
  public function setNotaAsignatura1($_nota1){$this->nota1 = $_nota1;}
  public function setIdAsignatura2($_idasignatura2){$this->id_asignatura2 = $_idasignatura2;}
  public function setNotaAsignatura2($_nota2){$this->nota2 = $_nota2;}
  public function setIdAsignatura3($_idasignatura3){$this->id_asignatura3 = $_idasignatura3;}
  public function setNotaAsignatura3($_nota3){$this->nota3 = $_nota3;}
  public function setIdAsignatura4($_idasignatura4){$this->id_asignatura4 = $_idasignatura4;}
  public function setNotaAsignatura4($_nota4){$this->nota4 = $_nota4;}
  public function setIdAsignatura5($_idasignatura5){$this->id_asignatura5 = $_idasignatura5;}
  public function setNotaAsignatura5($_nota5){$this->nota5 = $_nota5;}
  public function setIdAsignatura6($_idasignatura6){$this->id_asignatura6 = $_idasignatura6;}
  public function setNotaAsignatura6($_nota6){$this->nota6 = $_nota6;}

  public function setIdAsignatura($i, $id_asignatura){
    switch($i){
      case 1:
        $this->setIdAsignatura1($id_asignatura);
        break;
      case 2:
        $this->setIdAsignatura2($id_asignatura);
        break;
      case 3:
        $this->setIdAsignatura3($id_asignatura);
        break;
      case 4:
        $this->setIdAsignatura4($id_asignatura);
        break;
      case 5:
        $this->setIdAsignatura5($id_asignatura);
        break;
      case 6:
        $this->setIdAsignatura6($id_asignatura);
        break;
    }
  }

  public function setNotaAsignatura($i, $nota){
    switch($i){
      case 1:
        $this->setNotaAsignatura1($nota);
        break;
      case 2:
        $this->setNotaAsignatura2($nota);
        break;
      case 3:
        $this->setNotaAsignatura3($nota);
        break;
      case 4:
        $this->setNotaAsignatura4($nota);
        break;
      case 5:
        $this->setNotaAsignatura5($nota);
        break;
      case 6:
        $this->setNotaAsignatura6($nota);
        break;
    }
  }

  public function getNombreAsignatura($i){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idA = self::getIdAsignatura($conn->real_escape_string($i));

		$sql = sprintf("SELECT nombre_asignatura FROM asignaturas WHERE id = '%s'", $conn->real_escape_string($idA));
		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $result->free();
      return $row["nombre_asignatura"];
    }
    else{
      echo "<p>No se ha encontrado una asignatura con id ".$idA.".</p>";
    }
	}

  public function getFilaAsignaturasProfesor($idProfesor){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $a1 = $conn->real_escape_string(self::getIdAsignatura1());
    $a2 = $conn->real_escape_string(self::getIdAsignatura2());
    $a3 = $conn->real_escape_string(self::getIdAsignatura3());
    $a4 = $conn->real_escape_string(self::getIdAsignatura4());
    $a5 = $conn->real_escape_string(self::getIdAsignatura5());
    $a6 = $conn->real_escape_string(self::getIdAsignatura6());

    $idProfesor = $conn->real_escape_string($idProfesor);

    $sql = "SELECT id, nombre_asignatura FROM asignaturas WHERE (id = '$a1' || id = '$a2' || id = '$a3' || id = '$a4' || id = '$a5' || id = '$a6') && id_profesor = '$idProfesor'";
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
      echo "<p>No se han encontrado asignaturas del alumno que sean dadas por el profesor con id ".$idProfesor.".</p>";
    }
  }

  public function setNota($idAsignatura, $nota){

    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $id = $conn->real_escape_string(self::getId());
    $nota = $conn->real_escape_string($nota);

    if($nota != NULL && $idAsignatura != NULL){
      if($nota >= 0 && $nota <= 10){
        switch($conn->real_escape_string($idAsignatura)){
          case $conn->real_escape_string(self::getIdAsignatura1()):
            $sql = "UPDATE calificaciones SET nota1 = '$nota' WHERE id = '$id'";
            break;
          case $conn->real_escape_string(self::getIdAsignatura2()):
            $sql = "UPDATE calificaciones SET nota2 = '$nota' WHERE id = '$id'";
            break;
          case $conn->real_escape_string(self::getIdAsignatura3()):
            $sql = "UPDATE calificaciones SET nota3 = '$nota' WHERE id = '$id'";
            break;
          case $conn->real_escape_string(self::getIdAsignatura4()):
            $sql = "UPDATE calificaciones SET nota4 = '$nota' WHERE id = '$id'";
            break;
          case $conn->real_escape_string(self::getIdAsignatura5()):
            $sql = "UPDATE calificaciones SET nota5 = '$nota' WHERE id = '$id'";
            break;
          case $conn->real_escape_string(self::getIdAsignatura6()):
            $sql = "UPDATE calificaciones SET nota6 = '$nota' WHERE id = '$id'";
            break;
        }

        $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

        if(!$result){
          echo "<p>No se ha encontrado ninguna calificación con id ".$id.".</p>";
        }
      }
      else{
        echo "<p>Nota no válida</p>";
      }
    }
  }
}
