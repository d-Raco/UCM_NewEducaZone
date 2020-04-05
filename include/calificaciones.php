<?php
  require_once('config.php');

  class Calificaciones{
    private $id = "";
    private $id_asignatura1 = "";
    private $nota1 = "";
    private $id_asignatura2 = "";
    private $nota2 = "";
    private $id_asignatura3 = "";
    private $nota3 = "";
    private $id_asignatura4 = "";
    private $nota4 = "";
    private $id_asignatura5 = "";
    private $nota5 = "";
    private $id_asignatura6 = "";
    private $nota6 = "";

    public function __construct($_id, $_idasignatura1, $_nota1, $_idasignatura2, $_nota2, $_idasignatura3, $_nota3, $_idasignatura4, $_nota4, $_idasignatura5, $_nota5, $_idasignatura6, $_nota6){
      $this->id = $_id;
      $this->id_asignatura1 = $_idasignatura1;
      $this->nota1 = $_nota1;
      $this->id_asignatura2 = $_idasignatura2;
      $this->nota2 = $_nota2;
      $this->id_asignatura3 = $_idasignatura3;
      $this->nota3 = $_nota3;
      $this->id_asignatura4 = $_idasignatura4;
      $this->nota4 = $_nota4;
      $this->id_asignatura5 = $_idasignatura5;
      $this->nota5 = $_nota5;
      $this->id_asignatura6 = $_idasignatura6;
      $this->nota6 = $_nota6;
    }

    public function getId(){return $this->id;}
    public function getIdAsignatura1(){return $this->id_asignatura1;}
    public function getNotaAsignatura1(){return $this->nota1;}
    public function getIdAsignatura2(){return $this->id_asignatura2;}
    public function getNotaAsignatura2(){return $this->nota2;}
    public function getIdAsignatura3(){return $this->id_asignatura3;}
    public function getNotaAsignatura3(){return $this->nota3;}
    public function getIdAsignatura4(){return $this->id_asignatura4;}
    public function getNotaAsignatura4(){return $this->nota4;}
    public function getIdAsignatura5(){return $this->id_asignatura5;}
    public function getNotaAsignatura5(){return $this->nota5;}
    public function getIdAsignatura6(){return $this->id_asignatura6;}
    public function getNotaAsignatura6(){return $this->nota6;}

    public function getIdAsignatura($i){
      switch($i){
        case 1:
          return $this->getIdAsignatura1();
          break;
        case 2:
          return $this->getIdAsignatura2();
          break;
        case 3:
          return $this->getIdAsignatura3();
          break;
        case 4:
          return $this->getIdAsignatura4();
          break;
        case 5:
          return $this->getIdAsignatura5();
          break;
        case 6:
          return $this->getIdAsignatura6();
          break;
      }
    }

    public function getNotaAsignatura($i){
      switch($i){
        case 1:
          return $this->getNotaAsignatura1();
          break;
        case 2:
          return $this->getNotaAsignatura2();
          break;
        case 3:
          return $this->getNotaAsignatura3();
          break;
        case 4:
          return $this->getNotaAsignatura4();
          break;
        case 5:
          return $this->getNotaAsignatura5();
          break;
        case 6:
          return $this->getNotaAsignatura6();
          break;
      }
    }

    public function getNotaAsignaturaById($id){
      switch($id){
        case $this->getIdAsignatura1():
          return $this->getNotaAsignatura1();
          break;
        case $this->getIdAsignatura2():
          return $this->getNotaAsignatura2();
          break;
        case $this->getIdAsignatura3():
          return $this->getNotaAsignatura3();
          break;
        case $this->getIdAsignatura4():
          return $this->getNotaAsignatura4();
          break;
        case $this->getIdAsignatura5():
          return $this->getNotaAsignatura5();
          break;
        case $this->getIdAsignatura6():
          return $this->getNotaAsignatura6();
          break;
      }
    }

    public function setId($_id){$this->id = $_id;}
    public function setIdAsignatura1($_idasignatura1){$this->id_asignatura1 = $_idasignatura1;}
    public function setNotaAsignatura1($_nota1){$this->nota1 = $_nota1;}
    public function setIdAsignatura2($_idasignatura2){$this->id_asignatura2 = $_idasignatura2;}
    public function setNotaAsignatura2($_nota2){$this->nota2 = $_nota2;}
    public function setIdAsignatura3($_idasignatura3){$this->id_asignatura3 = $_idasignatura3;}
    public function setNotaAsignatura3($_nota3){$this->nota3 = $_nota3;}
    public function setIdAsignatura4($_idasignatura4){$this->id_asignatura4 = $_idasignatura4;}
    public function setNotaAsignatura4($_nota4){$this->nota4 = $_nota4;}
    public function setIdAsignatura5($_idasignatura5){$this->id_asignatura5 = $_idasignatura5;}
    public function setNotaAsignatura5($_nota5){$this->nota5 = $_nota5;}
    public function setIdAsignatura6($_idasignatura6){$this->id_asignatura6 = $_idasignatura6;}
    public function setNotaAsignatura6($_nota6){$this->nota6 = $_nota6;}

    public function setIdAsignatura($i, $id_asignatura){
      switch($i){
        case 1:
          $this->setIdAsignatura1($id_asignatura);
          break;
        case 2:
          $this->setIdAsignatura2($id_asignatura);
          break;
        case 3:
          $this->setIdAsignatura3($id_asignatura);
          break;
        case 4:
          $this->setIdAsignatura4($id_asignatura);
          break;
        case 5:
          $this->setIdAsignatura5($id_asignatura);
          break;
        case 6:
          $this->setIdAsignatura6($id_asignatura);
          break;
      }
    }

    public function setNotaAsignatura($i, $nota){
      switch($i){
        case 1:
          $this->setNotaAsignatura1($nota);
          break;
        case 2:
          $this->setNotaAsignatura2($nota);
          break;
        case 3:
          $this->setNotaAsignatura3($nota);
          break;
        case 4:
          $this->setNotaAsignatura4($nota);
          break;
        case 5:
          $this->setNotaAsignatura5($nota);
          break;
        case 6:
          $this->setNotaAsignatura6($nota);
          break;
      }
    }
  }
