<?php
//Clase encargada de actualizar la información del objeto Admin en la BBDD

class Admin {


  private $usuario = "";
  private $contrasena = "";
   private $id = "";
  private $foto= NULL;

  public function getUsuario(){return $this->usuario;}
  public function getContrasena(){return $this->contrasena;}
  public function getFoto(){return "./img/avatar.png"; }
  public function getId(){return $this->id;}


  public function setUsuario($_usuario){$this->usuario = $_usuario;}
  public function setContrasena($_contrasena){$this->contrasena = $_contrasena;}
  public function setFoto($_foto){$this->foto = $_foto;}
  public function setId($_id){$this->id = $_id;}
}
