<?php 
//Clase encargada de actualizar la información del objeto Usuario en la BBDD
class Alumno {

    private $DNI = "";
    private $nombre = "";
    private $apellido1 = "";
    private $apellido2 = "";
    private $id_centro = "";
    private $id_clase = "";
    private $observaciones_medicas = "";
    private $id_tutor_legal = "";
    private $fecha_nacimiento = "";
    private $id_calificaciones = "";
    private $foto = "";

    public function getDNI(){return $this->DNI;}
    public function getNombre(){return $this->nombre;}
    public function getAp1(){return $this->apellido1;}
    public function getAp2(){return $this->apellido2;}
    public function getIdCentro(){return $this->id_centro;}
    public function getIdClase(){return $this->id_clase;}
    public function getOM(){return $this->observaciones_medicas;}
    public function getIdTutor(){return $this->id_tutor_legal;}
    public function getFecha(){return $this->fecha_nacimiento;}
    public function getCal(){return $this->id_calificaciones;}
    public function getFoto(){return $this->foto;}


    public function setDNI($_DNI){$this->DNI = $_DNI;}
    public function setNombre($_nombre){$this->nombre = $_nombre;}
    public function setAp1($_apellido1){$this->apellido1 = $_apellido1;}
    public function setAp2($_apellido2){$this->apellido2 = $_apellido2;}
    public function setIdCentro($_id_centro){$this->id_centro = $_id_centro;}
    public function setIdClase($_id_clase){$this->id_clase = $_id_clase;}
    public function setOM($_observaciones_medicas){$this->observaciones_medicas = $_observaciones_medicas;}
    public function setTutor($_id_tutor_legal){$this->id_tutor_legal = $_id_tutor_legal;}
    public function setFecha($_fecha_nacimiento){$this->fecha_nacimiento = $_fecha_nacimiento;}
    public function setCal($_id_calificaciones){$this->id_calificaciones = $_id_calificaciones;}
    public function setFoto($_foto){$this->foto = $_foto;}

}
