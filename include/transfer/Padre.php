<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD

class Padre {

  private $id = "";
  private $nombre = "";
  private $apellido1 = "";
  private $apellido2 = "";
  private $telefono_movil = "";
  private $telefono_fijo = "";
  private $correo = "";
  private $usuario = "";
  private $contrasena = "";
  private $foto= NULL;

  public function getId(){return $this->id;}
  public function getNombre(){return $this->nombre;}
  public function getAp1(){return $this->apellido1;}
  public function getAp2(){return $this->apellido2;}
  public function getMovil(){return $this->telefono_movil;}
  public function getFijo(){return $this->telefono_fijo;}
  public function getCorreo(){return $this->correo;}
  public function getUsuario(){return $this->usuario;}
  public function getContrasena(){return $this->contrasena;}
  public function getFoto(){
    if(is_null($this->foto)){
      return "./img/usuario.png";
    }
    else{return $this->foto;}
  }

  public function setId($_id){$this->id = $_id;}
  public function setNombre($_nombre){$this->nombre = $_nombre;}
  public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
  public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
  public function setMovil($_telefono_movil){$this->telefono_movil = $_telefono_movil;}
  public function setFijo($_telefono_fijo){$this->telefono_fijo = $_telefono_fijo;}
  public function setCorreo($_correo){$this->correo = $_correo;}
  public function setUsuario($_usuario){$this->usuario = $_usuario;}
  public function setContrasena($_contrasena){$this->contrasena = $_contrasena;}
  public function setFoto($_foto){$this->foto = $_foto;}

}
