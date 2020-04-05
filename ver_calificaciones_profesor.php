<?php
  require_once('include/DAOCalificaciones.php');
  require_once('include/DAOProfe.php');
  require_once('include/DAOAlumno.php');
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
        $pdao = new ProfeDAO();
        $adao = new AlumnoDAO();
        $cdao = new CalificacionesDAO();

        $idProfesor = $pdao->getIdProfesor($_SESSION['name']);
        $alumno = $adao->getAlumno($_GET['idAl']);
        $c = new Calificaciones($alumno->getCal(), NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $cdao->setCalificaciones($c);

        echo "<h1>Calificación de " .$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2(). ":</h1>";

        $cdao->setNota($c, $_GET["idAsignatura"], $_GET["notaNueva"]);
        $cdao->setCalificaciones($c);
        $filaAsignaturas = $cdao->getFilaAsignaturasProfesor($c, $idProfesor);

        foreach ($filaAsignaturas as &$value) {
          echo "<p>" .$value["nombre_asignatura"]. ": ";
          echo $c->getNotaAsignaturaById($value["id"]). "</p>";

          echo "<form method=\"get\">";
            echo "<p> Escribe aquí la nueva nota:";
            echo "<input type=\"varchar\" name=\"notaNueva\"></p>";
            echo "<input type=\"hidden\" name=\"idAl\" value=\"" .$_GET['idAl']. "\">";
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
