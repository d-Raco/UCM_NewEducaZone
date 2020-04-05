<?php
  require_once('config.php');

  class Padre{
    private $id = ""; 
    private $nombre = "";     
    private $apellido1 = "";     
    private $apellido2 = "";  
    private $telefono_movil = ""; 
    private $telefono_fijo = ""; 
    private $correo = "";    
    private $usuario = ""; 
    private $contraseña = ""; 

    public function __construct($_id, $_nombre, $_apellido1, $_apellido2, $_telefono_movil, $_telefono_fijo, $_correo, $_usuario, $_contraseña){
      $this->id = $_id;
      $this->nombre = $_nombre;
      $this->apellido1 = $_apellido1;
      $this->apellido2 = $_apellido2;
      $this->telefono_movil = $_telefono_movil;
      $this->telefono_fijo = $_telefono_fijo;
      $this->correo = $_correo;
      $this->usuario = $_usuario;
      $this->contraseña = $_contraseña;
    } 

    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getAp1(){return $this->apellido1;}
    public function getAp2(){return $this->apellido2;}
    public function getMovil(){return $this->telefono_movil;}
    public function getFijo(){return $this->telefono_fijo;}
    public function getCorreo(){return $this->correo;}
    public function getUsuario(){return $this->usuario;}
    public function getContraseña(){return $this->contraseña;}

    public function setId($_id){$id = $_id;}
    public function setNombre($_nombre){$nombre = $_nombre;}
    public function setAp1($_apellido1){$apellido1 = $_apellido1;}
    public function setAp2($_apellido2){$apellido2 = $_apellido2;}
    public function setMovil($_telefono_movil){$telefono_movil = $_telefono_movil;}
    public function setFijo($_telefono_fijo){$telefono_fijo = $_telefono_fijo;}
    public function setCorreo($_correo){$correo = $_correo;}
    public function setUsuario($_usuario){$usuario = $_usuario;}
    public function setContraseña($_contraseña){$contraseña = $_contraseña;}
  }
