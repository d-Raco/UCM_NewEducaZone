<?php
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cursos</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) || ($_SESSION['rol'] != 'profesor')){
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }
    ?>
   <div id ="cursos">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div class ="contenido" style="margin-left: 250px;">
      <h1>Clases</h1>
      <?php
        $profesor = new Profesor();
        $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $dao_profesor = new DAO_Profesor();
        $dao_profesor->getProfe($profesor);

        $clase = new Clases();
        $clase->setIdTutor($profesor->getId());
        $dao_clase = new DAO_Clases();
        $result = $dao_clase->getAsignaturas($profesor->getId());
        $idClase = NULL;

        echo "<div class='w3-container'><ul class=\"w3-ul\">";
        while($fila = $result->fetch_assoc()){
          $id_asignatura = $fila["id"];
          $dao_clase->getClaseByAsignatura($clase, $id_asignatura);
          if($idClase != $clase->getId()){
            echo
            "<li>
              <a href=\"ver_clase.php?id=" .$clase->getId(). "&idProfe=".$profesor->getId()."\">" .$clase->getCurso(). "º " .$clase->getTitul(). " " .$clase->getLetra(). "</a> (Número de alumnos: " .$clase->getNAlum(). ")
            </li>";
          }
          $idClase = $clase->getId();
        }
        echo "</div>";
      ?>
    </div>

    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
