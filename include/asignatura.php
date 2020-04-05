<?php
  require_once('config.php');

  class Asignatura{
    private $id = "";
    private $id_profesor = "";
    private $nombre_asignatura = "";
    private $lunes_inicio = "";
    private $lunes_fin = "";
    private $martes_inicio = "";
    private $martes_fin = "";
    private $miercoles_inicio = "";
    private $miercoles_fin = "";
    private $jueves_inicio = "";
    private $jueves_fin = "";
    private $viernes_inicio = "";
    private $viernes_fin = "";

    public function __construct($_id, $_idprofesor, $_nombre, $_li, $_lf, $_mi, $_mf, $_xi, $_xf, $_ji, $_jf, $_vi, $_vf){
      $this->id = $_id;
      $this->id_profesor = $_idprofesor;
      $this->nombre_asignatura = $_nombre;
      $this->lunes_inicio = $_li;
      $this->lunes_fin = $_lf;
      $this->martes_inicio = $_mi;
      $this->martes_fin = $_mf;
      $this->miercoles_inicio = $_xi;
      $this->miercoles_fin = $_xf;
      $this->jueves_inicio = $_ji;
      $this->jueves_fin = $_jf;
      $this->viernes_inicio = $_vi;
      $this->viernes_fin = $_vf;

    }

    public function getId(){return $this->id;}
    public function getIdProfesor(){return $this->id_profesor;}
    public function getNombreAsignatura(){return $this->nombre_asignatura;}
    public function getLI(){return $this->lunes_inicio;}
    public function getLF(){return $this->lunes_fin;}
    public function getMI(){return $this->martes_inicio;}
    public function getMF(){return $this->martes_fin;}
    public function getXI(){return $this->miercoles_inicio;}
    public function getXF(){return $this->miercoles_fin;}
    public function getJI(){return $this->jueves_inicio;}
    public function getJF(){return $this->jueves_fin;}
    public function getVI(){return $this->viernes_inicio;}
    public function getVF(){return $this->viernes_fin;}


    public function setId($_id){$this->id = $_id;}
    public function setIdProfesor($_idprofesor){$this->id_profesor = $_idprofesor;}
    public function setNombreAsignatura($_nombre){$this->nombre_asignatura = $_nombre;}
    public function setLI($_li){$this->lunes_inicio = $_li;}
    public function setLF($_lf){$this->lunes_fin = $_lf;}
    public function setMI($_mi){$this->martes_inicio = $_mi;}
    public function setMF($_mf){$this->martes_fin = $_mf;}
    public function setXI($_xi){$this->miercoles_inicio = $_xi;}
    public function setXF($_xf){$this->miercoles_fin = $_xf;}
    public function setJI($_ji){$this->jueves_inicio = $_ji;}
    public function setJF($_jf){$this->jueves_fin = $_jf;}
    public function setVI($_vi){$this->viernes_inicio = $_vi;}
    public function setVF($_vf){$this->viernes_fin = $_vf;}

  }
