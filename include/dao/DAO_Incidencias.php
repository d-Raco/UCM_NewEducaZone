<?php
require_once __DIR__ . '/../transfer/Incidencias.php';


class DAO_Incidencias{

  public function getAsignaturasCompartidas($idAlumno, $idProfesor){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idAlumno = $conn->real_escape_string($idAlumno);
    $idProfesor = $conn->real_escape_string($idProfesor);

    $sql = "SELECT a.id, a.nombre_asignatura FROM asignaturas a
            JOIN clases c ON c.id_asignatura1 = a.id || c.id_asignatura2 = a.id || c.id_asignatura3 = a.id || c.id_asignatura4 = a.id || c.id_asignatura5 = a.id || c.id_asignatura6 = a.id
            JOIN alumnos al ON  c.id = al.id_clase
            WHERE a.id_profesor = '$idProfesor' && al.DNI = '$idAlumno'";

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
      echo "<p>El alumno con id ".$idAlumno." no asiste a ninguna asignatura que imparta el profesor con id ".$idProfesor.".</p>";
    }
  }

  public function getInfo($incidencia){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idAlumno = $conn->real_escape_string($incidencia->getIdAlumno());
    $idAsignatura = $conn->real_escape_string($incidencia->getIdAsignatura());

    $sql = "SELECT a.nombre_asignatura, al.nombre, al.apellido1, al.apellido2 FROM alumnos al
            JOIN clases c ON c.id = al.id_clase
            JOIN asignaturas a ON c.id_asignatura1 = a.id OR c.id_asignatura2 = a.id OR c.id_asignatura3 = a.id OR c.id_asignatura4 = a.id OR c.id_asignatura5 = a.id OR c.id_asignatura6 = a.id
            WHERE a.id = '$idAsignatura' && al.DNI = '$idAlumno'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $result->free();
      return $row;
    }
    else{
      echo "<p>El alumno con id ".$idAlumno." no asiste a ninguna asignatura con id ".$idAsignatura.".</p>";
    }
  }

  public function getIncidencias($incidencia){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idAlumno = $conn->real_escape_string($incidencia->getIdAlumno());
    $idAsignatura = $conn->real_escape_string($incidencia->getIdAsignatura());

    $sql = "SELECT msg_incidencia FROM incidencias WHERE id_asignatura = '$idAsignatura' && id_alumno = '$idAlumno'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $i = 0;
      $incidencias = array();
      while($filaIncidencias = $result->fetch_assoc()){
        $incidencias[$i] = $filaIncidencias;
        $i = $i + 1;
      }
      $result->free();
      return $incidencias;
    }
    else{
      echo "<p>No hay ninguna incidencia del alumno con id ".$idAlumno." en la asignatura con id ".$idAsignatura.".</p>";
    }
  }

  public function getIncidenciasDetalladas($incidencia){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $idAlumno = $conn->real_escape_string($incidencia->getIdAlumno());

    $sql = "SELECT a.nombre_asignatura, i.msg_incidencia FROM incidencias i JOIN asignaturas a ON i.id_asignatura = a.id
            WHERE i.id_alumno = '$idAlumno'";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $i = 0;
      $incidencias = array();
      while($filaIncidencias = $result->fetch_assoc()){
        $incidencias[$i] = $filaIncidencias;
        $i = $i + 1;
      }
      $result->free();
      return $incidencias;
    }
    else{
      echo "<p>No existen incidencias del alumno con id ".$idAlumno.".</p>";
    }
  }

  public function getNumIncidencias(){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $sql = "SELECT id FROM incidencias";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    return $result->num_rows;
  }

  public function insertIncidencia($incidencia){
    $app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

    $id = $conn->real_escape_string($incidencia->getId());
    $asignatura = $conn->real_escape_string($incidencia->getIdAsignatura());
    $dniAlumno = $conn->real_escape_string($incidencia->getIdAlumno());
    $incidencia = $conn->real_escape_string($incidencia->getMsgIncidencia());

    $sql = "INSERT INTO incidencias (id, id_asignatura, id_alumno, msg_incidencia)
            VALUES ('$id', '$asignatura', '$dniAlumno', '$incidencia')";

		$result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if(!$result){
      echo "<p>No se ha podido insertar una nueva incidencia en la base de datos.</p>";
    }
  }

  public function getUltimaIncidencia($idAlumno){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBD();

    $sql = "SELECT a.nombre_asignatura, i.msg_incidencia FROM incidencias i JOIN asignaturas a ON i.id_asignatura = a.id WHERE id_alumno = '$idAlumno'";
    $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    if($result->num_rows > 0){
      $i = 1;
      while($fila = $result->fetch_assoc()){
        if($i == $result->num_rows){
          return $fila["nombre_asignatura"].": ".$fila["msg_incidencia"];
        }
        $i++;
      }
    }
    else{
      return "<p>No hay ninguna incidencia.</p>";
    }
  }

}

?>
