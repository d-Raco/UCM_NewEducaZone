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
        $pdao = new Profesor();
        $adao = new Alumno();

        $profesor = $pdao->getProfe(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $alumno = $adao->getAlumno(htmlspecialchars(trim(strip_tags($_GET["idAl"]))));
        $c = new Calificaciones($alumno->getCal(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        echo "<h1>Calificación de " .$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2(). ":</h1>";

        $cdao->setNota(htmlspecialchars(trim(strip_tags($_GET["idAsignatura"]))), htmlspecialchars(trim(strip_tags($_GET["notaNueva"]))));
        
        $filaAsignaturas = $c->getFilaAsignaturasProfesor($profesor->getId());

        foreach ($filaAsignaturas as &$value) {
          echo "<p>" .$value["nombre_asignatura"]. ": ";
          echo $c->getNotaAsignaturaById($value["id"]). "</p>";

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
