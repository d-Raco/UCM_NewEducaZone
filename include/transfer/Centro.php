<?php
//Clase encargado de la entrada y salida de datos sobre centro
//Artur Amon 2020

class Centro
{
    private $id = "";
    private $nombre = "";
    private $provincia = "";
    private $direccion = "";
    private $telefono = "";
    private $email = "";


    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombre;}
    public function getProvincia(){return $this->provincia;}
    public function getDireccion(){return $this->direccion;}
    public function getTelefono(){return $this->telefono;}
    public function getEmail(){return $this->email;}

    public function setId($id){$this->id = $id;}
    public function setNombre($nombre){$this->nombre = $nombre;}
    public function setProvincia($provincia){$this->provincia = $provincia;}
    public function setDireccion($direccion){$this->direccion = $direccion;}
    public function setTelefono($telefono){$this->telefono = $telefono;}
    public function setEmail($email){$this->email = $email;}

}