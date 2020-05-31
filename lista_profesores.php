<?php
require_once __DIR__ . '/include/dao/DAO_Alumno.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <div id ="lista_profesores">
    <?php
      if (!isset($_SESSION['login']) ){
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }

      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }

      echo '<div class="contenido" style="margin-left: 250px;">';
        $alumno = new Alumno();
        $alumno->setDNI(htmlspecialchars(trim(strip_tags($_REQUEST["idAlumno"]))));
        $dao_alumno = new DAO_Alumno();
        $dao_alumno->getAlumno($alumno);
        $result = $dao_alumno->getProfesores($alumno->getIdClase());

        $idProfe = NULL;

       echo "<h1>Profesores</h1>";

        echo "<div class='w3-container'><ul class=\"w3-ul\">";
        while($filaAsignatura = $result->fetch_assoc()){
          $filaProfesor = $dao_alumno->getProfe($filaAsignatura['id_profesor']);
          if($idProfe != $filaAsignatura['id_profesor']){
            echo "<li>
            <img src=".$filaProfesor["foto"]." class=\" w3-circle \" style=\"width:50px\">
            <a href=\"ver_profesor.php?profesor=" .$filaProfesor['usuario']. "&tutor=" .$alumno->getIdTutor(). "\">
               ".$filaProfesor["nombre"]. " " .$filaProfesor["apellido1"]. " " .$filaProfesor["apellido2"]. " (" .$filaAsignatura["nombre_asignatura"]. ")
            </a><br>
          </li>";
          }
          $idProfe = $filaAsignatura['id_profesor'];
        }
        echo "</div></div>";

      include("include/comun/pie.php");
      ?>
ç    </body>
  </html>
