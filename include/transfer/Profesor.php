<?php
//Clase encargada de actualizar la información del objeto Usuario en la BBDD

class Profesor {

  private $id = "";
  private $id_centro = "";
  private $nombre = "";
  private $apellido1 = "";
  private $apellido2 = "";
  private $despacho = "";
  private $correo = "";
  private $usuario = "";
  private $contrasena = "";
  private $foto = "";

  public function getId(){return $this->id;}
  public function getIdCentro(){return $this->id_centro;}
  public function getNombre(){return $this->nombre;}
  public function getAp1(){return $this->apellido1;}
  public function getAp2(){return $this->apellido2;}
  public function getDespacho(){return $this->despacho;}
  public function getCorreo(){return $this->correo;}
  public function getUsuario(){return $this->usuario;}
  public function getContrasena(){return $this->contrasena;}
  public function getFoto(){return $this->foto;}

  public function setId($_id){$this->id = $_id;}
  public function setIdCentro($_id_centro){$this->id_centro = $_id_centro;}
  public function setNombre($_nombre){$this->nombre = $_nombre;}
  public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
  public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
  public function setDespacho($_despacho){$this->despacho = $_despacho;}
  public function setCorreo($_correo){$this->correo = $_correo;}
  public function setUsuario($_usuario){$this->usuario = $_usuario;}
  public function setContrasena($_contrasena){$this->contrasena = $_contrasena;}
  public function setFoto($_foto){$this->foto = $_foto;}

}
