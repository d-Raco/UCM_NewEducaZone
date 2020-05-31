<?php

require_once __DIR__ . '/../transfer/Calificaciones.php';

class DAO_Calificaciones{

	public function getCal($cal){
			$app = Aplicacion::getSingleton();
			$conn = $app->conexionBD();

			$sql = sprintf("SELECT * FROM calificaciones WHERE id = '%s'", $conn->real_escape_string($cal->getId()));
			$result = $conn->query($sql)
	            or die ($conn->error. " en la línea ".(__LINE__-1));

	    if($result->num_rows > 0){
	      $row = $result->fetch_assoc();
	      $cal->setIdAsignatura1($row["id_asignatura1"]);
	      $cal->setNotaAsignatura1($row["nota1"]);
	      $cal->setIdAsignatura2($row["id_asignatura2"]);
	      $cal->setNotaAsignatura2($row["nota2"]);
	      $cal->setIdAsignatura3($row["id_asignatura3"]);
	      $cal->setNotaAsignatura3($row["nota3"]);
	      $cal->setIdAsignatura4($row["id_asignatura4"]);
	      $cal->setNotaAsignatura4($row["nota4"]);
	      $cal->setIdAsignatura5($row["id_asignatura5"]);
	      $cal->setNotaAsignatura5($row["nota5"]);
	      $cal->setIdAsignatura6($row["id_asignatura6"]);
	      $cal->setNotaAsignatura6($row["nota6"]);
	    }
	    else{
	      echo "<p>No se ha encontrado una asignatura con id ".self::getId().".</p>";
	    }
	}

	public function getNombreAsignatura($calificacion, $i){
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

	    $idA = $calificacion->getIdAsignatura($conn->real_escape_string($i));

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

	  public function getFilaAsignaturasProfesor($calificacion, $idProfesor){
	    $app = Aplicacion::getSingleton();
	    $conn = $app->conexionBD();

	    $a1 = $conn->real_escape_string($calificacion->getIdAsignatura1());
	    $a2 = $conn->real_escape_string($calificacion->getIdAsignatura2());
	    $a3 = $conn->real_escape_string($calificacion->getIdAsignatura3());
	    $a4 = $conn->real_escape_string($calificacion->getIdAsignatura4());
	    $a5 = $conn->real_escape_string($calificacion->getIdAsignatura5());
	    $a6 = $conn->real_escape_string($calificacion->getIdAsignatura6());

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

	  public function notaMedia($idAlumno){
		$app = Aplicacion::getSingleton();
	    $conn = $app->conexionBD();

	    $sql = "SELECT c.nota1, c.nota2, c.nota3, c.nota4, c.nota5, c.nota6 FROM calificaciones c JOIN alumnos a ON a.id_calificaciones = c.id WHERE a.DNI = '$idAlumno'";
	    $result = $conn->query($sql)
	            or die ($conn->error. " en la línea ".(__LINE__-1));
	    if($result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	if(is_null($row["nota1"]) || is_null($row["nota2"]) || is_null($row["nota3"]) || is_null($row["nota4"]) || is_null($row["nota5"]) || is_null($row["nota6"])){
	    		$media = "Las notas aún no estan completas";
	    	}
	    	else{
	    		$media = ($row["nota1"] + $row["nota2"] + $row["nota3"] + $row["nota4"] + $row["nota5"] + $row["nota6"])/6;

	    	}
	    	return $media;
	    }
	  }

	  public function setNota($calificacion, $idAsignatura, $nota){

	    $app = Aplicacion::getSingleton();
	    $conn = $app->conexionBD();

	    $id = $conn->real_escape_string($calificacion->getId());
	    $nota = $conn->real_escape_string($nota);

	    if($nota != NULL && $idAsignatura != NULL){
	      if($nota >= 0 && $nota <= 10){
	        switch($conn->real_escape_string($idAsignatura)){
	          case $conn->real_escape_string($calificacion->getIdAsignatura1()):
	            $sql = "UPDATE calificaciones SET nota1 = '$nota' WHERE id = '$id'";
	            break;
	          case $conn->real_escape_string($calificacion->getIdAsignatura2()):
	            $sql = "UPDATE calificaciones SET nota2 = '$nota' WHERE id = '$id'";
	            break;
	          case $conn->real_escape_string($calificacion->getIdAsignatura3()):
	            $sql = "UPDATE calificaciones SET nota3 = '$nota' WHERE id = '$id'";
	            break;
	          case $conn->real_escape_string($calificacion->getIdAsignatura4()):
	            $sql = "UPDATE calificaciones SET nota4 = '$nota' WHERE id = '$id'";
	            break;
	          case $conn->real_escape_string($calificacion->getIdAsignatura5()):
	            $sql = "UPDATE calificaciones SET nota5 = '$nota' WHERE id = '$id'";
	            break;
	          case $conn->real_escape_string($calificacion->getIdAsignatura6()):
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
