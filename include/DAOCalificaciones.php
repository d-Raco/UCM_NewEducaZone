<?php
//Clase encargada de actualizar la información del objeto Calificaciones en la BBDD
  require_once('calificaciones.php');

class CalificacionesDAO {

	public function __construct(){

	}

	public function setCalificaciones($c){
		global $app;
		$conn = $app->conexionBD();

    $id = $c->getId();
		$sql = "SELECT * FROM calificaciones WHERE id = '$id'";
		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();

      $c->setIdAsignatura1($row["id_asignatura1"]);
      $c->setNotaAsignatura1($row["nota1"]);
      $c->setIdAsignatura2($row["id_asignatura2"]);
      $c->setNotaAsignatura2($row["nota2"]);
      $c->setIdAsignatura3($row["id_asignatura3"]);
      $c->setNotaAsignatura3($row["nota3"]);
      $c->setIdAsignatura4($row["id_asignatura4"]);
      $c->setNotaAsignatura4($row["nota4"]);
      $c->setIdAsignatura5($row["id_asignatura5"]);
      $c->setNotaAsignatura5($row["nota5"]);
      $c->setIdAsignatura6($row["id_asignatura6"]);
      $c->setNotaAsignatura6($row["nota6"]);

      $result->free();
    }
    else{
      echo "<p>No se han encontrado las calificaciones del id ".$id.".</p>";
    }
	}

  public function getNombreAsignatura($c, $i){
		global $app;
		$conn = $app->conexionBD();

    $idA = $c->getIdAsignatura($i);

		$sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
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

  public function getFilaAsignaturasProfesor($c, $idProfesor){
    global $app;
    $conn = $app->conexionBD();

    $a1 = $c->getIdAsignatura1();
    $a2 = $c->getIdAsignatura2();
    $a3 = $c->getIdAsignatura3();
    $a4 = $c->getIdAsignatura4();
    $a5 = $c->getIdAsignatura5();
    $a6 = $c->getIdAsignatura6();

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

  public function setNota($c, $idAsignatura, $nota){

    global $app;
    $conn = $app->conexionBD();
    $id = $c->getId();

    if($nota != NULL && $idAsignatura != NULL){
      if($nota >= 0 && $nota <= 10){
        switch($idAsignatura){
          case $c->getIdAsignatura1():
            $sql = "UPDATE calificaciones SET nota1 = '$nota' WHERE id = '$id'";
            break;
          case $c->getIdAsignatura2():
            $sql = "UPDATE calificaciones SET nota2 = '$nota' WHERE id = '$id'";
            break;
          case $c->getIdAsignatura3():
            $sql = "UPDATE calificaciones SET nota3 = '$nota' WHERE id = '$id'";
            break;
          case $c->getIdAsignatura4():
            $sql = "UPDATE calificaciones SET nota4 = '$nota' WHERE id = '$id'";
            break;
          case $c->getIdAsignatura5():
            $sql = "UPDATE calificaciones SET nota5 = '$nota' WHERE id = '$id'";
            break;
          case $c->getIdAsignatura6():
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

?>
