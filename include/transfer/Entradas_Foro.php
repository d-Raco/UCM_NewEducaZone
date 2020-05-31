<?php
//Clase encargada de actualizar la información del objeto Entradas_foro en la BBDD

class Entradas_foro {

  private $id = "";
  private $id_clase = "";
  private $titulo_foro = "";
  private $id_creador = "";
  private $rol_creador = "";
  private $permisos = "";
  private $contenido = "";
  private $fecha = "";

  public function getId(){return $this->id;}
  public function getIdClase(){return $this->id_clase;}
  public function getTituloForo(){return $this->titulo_foro;}
  public function getIdCreador(){return $this->id_creador;}
  public function getRolCreador(){return $this->rol_creador;}
  public function getPermisos(){return $this->permisos;}
  public function getContenido(){return $this->contenido;}
  public function getFecha(){return $this->fecha;}

  public function setId($id){ $this->id = $id;}
  public function setIdClase($idClase){ $this->id_clase = $idClase;}
  public function setTituloForo($titulo){ $this->titulo_foro = $titulo;}
  public function setIdCreador($idCreador){ $this->id_creador = $idCreador;}
  public function setRolCreador($rolCreador){ $this->rol_creador = $rolCreador;}
  public function setPermisos($permisos){ $this->permisos = $permisos;}
  public function setContenido($contenido){ $this->contenido = $contenido;}
  public function setFecha($fecha){ $this->fecha = $fecha;}

  
}
