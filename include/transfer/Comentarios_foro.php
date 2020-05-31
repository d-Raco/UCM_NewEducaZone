<?php
//Clase encargada de actualizar la información del objeto Comentarios_foro en la BBDD

class Comentarios_foro {

  private $id = "";
  private $id_relacion = "";
  private $reply = "";
  private $id_redactor = "";
  private $rol_redactor = "";
  private $titulo = "";
  private $contenido_comentario = "";
  private $fecha = "";

  public function getId(){return $this->id;}
  public function getIdRelacion(){return $this->id_relacion;}
  public function getReply(){return $this->reply;}
  public function getIdRedactor(){return $this->id_redactor;}
  public function getRolRedactor(){return $this->rol_redactor;}
  public function getTitulo(){return $this->titulo;}
  public function getContenidoComentario(){return $this->contenido_comentario;}
  public function getFecha(){return $this->fecha;}

  public function setId($_id){$this->id = $_id;}
  public function setIdRelacion($id_relacion){$this->id_relacion = $id_relacion;}
  public function setReply($reply){$this->reply = $reply;}
  public function setIdRedactor($id_redactor){$this->id_redactor = $id_redactor;}
  public function setRolRedactor($rol_redactor){$this->rol_redactor = $rol_redactor;}
  public function setTitulo($titulo){$this->titulo = $titulo;}
  public function setContenidoComentario($contenido_comentario){$this->contenido_comentario = $contenido_comentario;}
  public function setFecha($fecha){$this->fecha = $fecha;}

}
