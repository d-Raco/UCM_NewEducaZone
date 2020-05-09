<?php
require_once __DIR__ . '/include/dao/Calificaciones.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calificaciones Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div id="contenido">
      <?php
        $calificación = new Calificaciones();
        $calificación->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
        $calificación->getCal();
        echo "<h1>Calificaciones</h1>";
        echo "<table style=\"width:55%\" frame = \"border\" rules = \"all\">
          <tr>
            <th>Asignatura</th>
            <th>Nota</th>
          </tr>";
        for($i = 1; $i < 7; $i++){
          echo "<tr>
            <td>".$calificación->getNombreAsignatura($i)."</td>
            <td>".$calificación->getNotaAsignatura($i)."</td>
          </tr>";
        }
        echo "</table>";
      ?>
    </div>

    <?php
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarDerProfesor.php");
      }
      else{
        include("include/comun/sidebarDerPadre.php");
      }
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
