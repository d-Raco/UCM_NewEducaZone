<?php
require_once __DIR__ . '/include/dao/Alumno.php';
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
        header("Location: ./login.php");
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
        $alumno->getAlumno();
        $result = $alumno->getProfesores();

        $idProfe = NULL;

       echo "<h1>Profesores</h1>";

        echo "<div class='w3-container'><ul class=\"w3-ul\">";
        while($filaAsignatura = $result->fetch_assoc()){
          $filaProfesor = $alumno->getProfe($filaAsignatura['id_profesor']);
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
