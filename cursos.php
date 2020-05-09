<?php
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index</title>
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
      <h1>Clases</h1>
      <?php
        $profesor = new Profesor();
        $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $profesor->getProfe();

        $clase = new Clases();
        $clase->setIdTutor($profesor->getId());
        $result = $clase->getAsignaturas();
        while($fila = $result->fetch_assoc()){
          $id_asignatura = $fila["id"];
          $clase->getClaseByAsignatura($id_asignatura);
          echo "<p><a href=\"ver_clase.php?id=" .$clase->getId(). "\">" .$clase->getCurso(). "º " .$clase->getTitul(). " " .$clase->getLetra(). "</a> (".$fila["nombre_asignatura"].", Número de alumnos: " .$clase->getNAlum(). ")</p>";
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
