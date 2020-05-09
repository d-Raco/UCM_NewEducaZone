<?php
require_once __DIR__ . '/include/dao/Calificaciones.php';
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Alumno.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calificaciones Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) || ($_SESSION['rol'] != 'profesor')){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <?php
        $profesor = new Profesor();
        $alumno = new Alumno();

        $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $profesor->getProfe();
        $alumno->setDNI(htmlspecialchars(trim(strip_tags($_GET["idAl"]))));
        $alumno->getAlumno();
        $calificación = new Calificaciones();
        $calificación->setId(htmlspecialchars(trim(strip_tags($alumno->getCal()))));
        $calificación->getCal();
        $calificación->setNota(htmlspecialchars(trim(strip_tags($_GET["idAsignatura"]))), htmlspecialchars(trim(strip_tags($_GET["notaNueva"]))));

        echo "<h1>Calificación de " .$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2(). ":</h1>";

        $calificación->getCal();
        $filaAsignaturas = $calificación->getFilaAsignaturasProfesor($profesor->getId());

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
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
