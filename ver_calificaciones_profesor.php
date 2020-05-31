<?php
require_once __DIR__ . '/include/dao/DAO_Calificaciones.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Alumno.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calificaciones Profesor</title>
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
   <div class="cali" style="margin-top: 100px;">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido" style = "margin-left: 230px">
      <?php
        $profesor = new Profesor();
        $dao_profesor = new DAO_Profesor;

        $alumno = new Alumno();
        $dao_alumno = new DAO_Alumno();

        $calificación = new Calificaciones();
        $dao_cal = new DAO_Calificaciones();

        $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $dao_profesor->getProfe($profesor);
        $alumno->setDNI(htmlspecialchars(trim(strip_tags($_GET["idAl"]))));
        $dao_alumno->getAlumno($alumno);
        $calificación->setId(htmlspecialchars(trim(strip_tags($alumno->getCal()))));
        $dao_cal->getCal($calificación);
        $dao_cal->setNota($calificación, htmlspecialchars(trim(strip_tags($_GET["idAsignatura"]))), htmlspecialchars(trim(strip_tags($_GET["notaNueva"]))));

        echo "<h1>Calificación de " .$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2(). ":</h1>";

        $dao_cal->getCal($calificación);
        $filaAsignaturas = $dao_cal->getFilaAsignaturasProfesor($calificación, $profesor->getId());

        foreach ($filaAsignaturas as &$value) {
          echo "<p>" .$value["nombre_asignatura"]. ": ";
          echo $calificación->getNotaAsignaturaById($value["id"]). "</p>";

          echo "<form method=\"get\">";
            echo "<p> Escribe aquí la nueva nota:";
            echo "<input type=\"varchar\" name=\"notaNueva\"></p>";
            echo "<input type=\"hidden\" name=\"idAl\" value=\"" .htmlspecialchars(trim(strip_tags($_GET["idAl"]))). "\">";
            echo "<input type=\"hidden\" name=\"idAsignatura\" value=\"" .$value["id"]. "\">";
            echo "<input class=\"nota\" type=\"submit\" value=\"Submit\">";
          echo "</form>";
        }
      ?>
    </div>

    <?php
      //include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
