<?php
  require_once('config.php');

  class Incidencia{
    private $id = "";
    private $id_asignatura = "";
    private $id_alumno = "";
    private $msg_incidencia = "";

    public function __construct($_id, $idAsignatura, $idAlumno, $msg){
      $this->id = $_id;
      $this->id_asignatura = $idAsignatura;
      $this->id_alumno = $idAlumno;
      $this->msg_incidencia = $msg;
    }

    public function getId(){return $this->id;}
    public function getIdAsignatura(){return $this->id_asignatura;}
    public function getIdAlumno(){return $this->id_alumno;}
    public function getMsgIncidencia(){return $this->msg_incidencia;}

    public function setId($_id){$this->id = $_id;}
    public function setIdAsignatura($idAsignatura){$this->id_asignatura = $idAsignatura;}
    public function setIdAlumno($idAlumno){$this->id_alumno = $idAlumno;}
    public function setMsgIncidencia($msg){$this->msg_incidencia = $msg;}
  }
