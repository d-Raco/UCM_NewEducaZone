<?php
//Clase encargada de actualizar la información del objeto archivos_foro en la BBDD

class Archivos_foro {

  private $id = "";
  private $id_foro = "";
  private $nombre_archivo = "";
  private $tamano_archivo = "";
  private $archivo = "";
  private $tipo_archivo = "";


  public function getId(){return $this->id;}
  public function getIdForo(){return $this->id_foro;}
  public function getNombreArchivo(){return $this->nombre_archivo;}
  public function getTamanoArchivo(){return $this->tamano_archivo;}
  public function getArchivo(){return $this->archivo;}
  public function getTipoArchivo(){return $this->tipo_archivo;}

  public function setId($id){ $this->id = $id;}
  public function setIdForo($idForo){ $this->id_foro = $idForo;}
  public function setNombreArchivo($nombreArchivo){ $this->nombre_archivo = $nombreArchivo;}
  public function setTamanoArchivo($tamanoArchivo){ $this->tamano_archivo = $tamanoArchivo;}
  public function setArchivo($archivo){ $this->archivo = $archivo;}
  public function setTipoArchivo($tipoArchivo){ $this->tipo_archivo = $tipoArchivo;}
 
}
