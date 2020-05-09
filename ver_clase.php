<?php
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ver_Clase</title>
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
        $id = htmlspecialchars(trim(strip_tags($_GET["id"])));

        $clase = new Clases();
        $clase->setId($id);

        $result = $clase->getAlumnos();
        $i = 1;

        if ($_SESSION['rol'] == "profesor"){
          while($fila = $result->fetch_assoc()){
            echo "<p><a href=\"ver_alumno.php?id=" .$fila["DNI"]. "\">" .$i. ". " .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</a></p>";
            $i = $i + 1;
          }
        }
        else{
          while($fila = $result->fetch_assoc()){
            echo "<p>" .$i. ". " .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</p>";
            $i = $i + 1;
          }
        }
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
