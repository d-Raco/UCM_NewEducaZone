<?php
  require_once('config.php');

  class Mensaje{
    private $id = "";
    private $id_origen = "";
    private $rol_origen = "";
    private $id_destinatario = "";
    private $rol_destinatario = "";
    private $contenido_msg = "";
    private $fecha_hora = "";

    public function __construct($_id, $_idorigen, $_rolorigen, $_iddest, $_roldest,$msg, $date){
      $this->id = $_id;
      $this->id_origen = $_idorigen;
      $this->rol_origen = $_rolorigen;
      $this->id_destinatario = $_iddest;
      $this->rol_destinatario = $_roldest;
      $this->contenido_msg = $msg;
      $this->fecha_hora = $date;
    }

    public function getId(){return $this->id;}
    public function getIdOrigen(){return $this->id_origen;}
    public function getIdDestinatario(){return $this->id_destinatario;}
    public function getRolOrigen(){return $this->rol_origen;}
    public function getRolDestinatario(){return $this->rol_destinatario;}
    public function getMsg(){return $this->contenido_msg;}
    public function getDate(){return $this->fecha_hora;}

    public function setId($_id){$this->id = $_id;}
    public function setIdOrigen($_idorigen){$this->id_origen = $_idorigen;}
    public function setIdDestinatario($_iddest){$this->id_destinatario = $_iddest;}
    public function setRolOrigen($_rolorigen){$this->rol_origen = $_rolorigen;}
    public function setRolDestinatario($_roldest){$this->rol_destinatario = $_roldest;}
    public function setMsg($msg){$this->contenido_msg = $msg;}
    public function setDate($date){$this->fecha_hora = $date;}
  }
