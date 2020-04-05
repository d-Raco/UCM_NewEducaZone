<?php
  require_once('config.php');

  class Alumno{
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

    public function __construct($_DNI, $_nombre, $_apellido1, $_apellido2, $_id_centro, $_id_clase, $_observaciones_medicas, $_id_tutor_legal, $_fecha_nacimiento, $_id_calificaciones, $_foto){
      $this->DNI = $_DNI;
      $this->nombre = $_nombre;
      $this->apellido1 = $_apellido1;
      $this->apellido2 = $_apellido2;
      $this->id_centro = $_id_centro;
      $this->id_clase = $_id_clase;
      $this->observaciones_medicas = $_observaciones_medicas;
      $this->id_tutor_legal = $_id_tutor_legal;
      $this->fecha_nacimiento = $_fecha_nacimiento;
      $this->id_calificaciones = $_id_calificaciones;
      $this->foto = $_foto;
    } 

    public function getDNI(){return $this->DNI;}
    public function getNombre(){return $this->nombre;}
    public function getAp1(){return $this->apellido1;}
    public function getAp2(){return $this->apellido2;}
    public function getIdCentro(){return $this->id_centro;}
    public function getIdClase(){return $this->id_clase;}
    public function getOM(){return $this->observaciones_medicas;}
    public function getTutor(){return $this->id_tutor_legal;}
    public function getFecha(){return $this->fecha_nacimiento;}
    public function getCal(){return $this->id_calificaciones;}
    public function getFoto(){return $this->foto;}


    public function setDNI($_DNI){$DNI = $_DNI;}
    public function setNombre($_nombre){$nombre = $_nombre;}
    public function setAp1($_apellido1){$apellido1 = $_apellido1;}
    public function setAp2($_apellido2){$apellido2 = $_apellido2;}
    public function setIdCentro($_id_centro){$id_centro = $_id_centro;}
    public function setIdClase($_id_clase){$id_clase = $_id_clase;}
    public function setOM($_observaciones_medicas){$observaciones_medicas = $_observaciones_medicas;}
    public function setTutor($_id_tutor_legal){$id_tutor_legal = $_id_tutor_legal;}
    public function setFecha($_fecha_nacimiento){$fecha_nacimiento = $_fecha_nacimiento;}
    public function setCal($_DNI){$id_calificaciones = $_id_calificaciones;}
    public function setFoto($_DNI){$foto = $_foto;}

  }
