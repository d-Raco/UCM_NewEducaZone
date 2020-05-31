<?php
//Clase encargada de actualizar la información del objeto Calificaciones en la BBDD

class Incidencias {

  private $id = "";
  private $id_asignatura = "";
  private $id_alumno = "";
  private $msg_incidencia = "";

  public function getId(){return $this->id;}
  public function getIdAsignatura(){return $this->id_asignatura;}
  public function getIdAlumno(){return $this->id_alumno;}
  public function getMsgIncidencia(){return $this->msg_incidencia;}

  public function setId($_id){$this->id = $_id;}
  public function setIdAsignatura($idAsignatura){$this->id_asignatura = $idAsignatura;}
  public function setIdAlumno($idAlumno){$this->id_alumno = $idAlumno;}
  public function setMsgIncidencia($msg){$this->msg_incidencia = $msg;}

  
}
