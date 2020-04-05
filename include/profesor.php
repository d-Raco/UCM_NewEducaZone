<?php
  require_once('config.php');

  class Profesor{
    private $id = ""; 
    private $id_centro = "";
    private $nombre = "";     
    private $apellido1 = "";     
    private $apellido2 = "";  
    private $despacho = ""; 
    private $correo = "";    
    private $usuario = ""; 
    private $contraseña = ""; 
    private $foto = "";

    public function __construct($_id, $_id_centro, $_nombre, $_apellido1, $_apellido2, $_despacho, $_correo, $_usuario, $_contraseña, $_foto){
      $this->id = $_id;
      $this->id_centro = $_id_centro;
      $this->nombre = $_nombre;
      $this->apellido1 = $_apellido1;
      $this->apellido2 = $_apellido2;
      $this->despacho = $_despacho;
      $this->correo = $_correo;
      $this->usuario = $_usuario;
      $this->contraseña = $_contraseña;
      $this->foto = $_foto;
    } 

    public function getId(){return $this->id;}
    public function getIdCentro(){return $this->id_centro;}
    public function getNombre(){return $this->nombre;}
    public function getAp1(){return $this->apellido1;}
    public function getAp2(){return $this->apellido2;}
    public function getDespacho(){return $this->despacho;}
    public function getCorreo(){return $this->correo;}
    public function getUsuario(){return $this->usuario;}
    public function getContraseña(){return $this->contraseña;}
    public function getFoto(){return $this->foto;}

    public function setId($_id){$id = $_id;}
    public function setIdCentro($_id_centro){$id_centro = $_id_centro;}
    public function setNombre($_nombre){$nombre = $_nombre;}
    public function setAp1($_apellido1){$apellido1 = $_apellido1;}
    public function setAp2($_apellido2){$apellido2 = $_apellido2;}
    public function setMovil($_despacho){$despacho = $_despacho;}
    public function setCorreo($_correo){$correo = $_correo;}
    public function setUsuario($_usuario){$usuario = $_usuario;}
    public function setContraseña($_contraseña){$contraseña = $_contraseña;}
    public function setFoto($_foto){$foto = $_foto;}
  }
