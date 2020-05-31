<?php
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ver_Clase</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
   <div id ="ver_clase">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div class ="contenido" style="margin-left: 250px;">
      <?php
        $id = htmlspecialchars(trim(strip_tags($_GET["id"])));

        $clase = new Clases();
        $clase->setId($id);

        $dao_clase = new DAO_Clases();
        $result = $dao_clase->getAlumnos($id);

        if ($_SESSION['rol'] == "profesor"){
          $dao_clase->setClase($clase);
          echo "<h1>Clase de ".$clase->getCurso()." ".$clase->getLetra()." ".$clase->getTitul()."</h1><br>";

          echo "<div class='w3-container'><ul class=\"w3-ul\">";
          while($fila = $result->fetch_assoc()){
            echo
            "<li>
              <img src=".$fila["foto"]." class=\" w3-circle \" style=\"width:50px\">
                <a href=\"ver_alumno.php?id=" .$fila["DNI"]. "\">"." ".$fila["nombre"]." ".$fila["apellido1"]." ".$fila["apellido2"]."</a><br>
            </li>";
          }
          echo "</div>";
        }
        else{
          $nombre = htmlspecialchars(trim(strip_tags($_GET["nombre"])));
          $ap1 = htmlspecialchars(trim(strip_tags($_GET["ap1"])));
          $ap2 = htmlspecialchars(trim(strip_tags($_GET["ap2"])));

          echo "<h1>Clase de ".$nombre." ".$ap1." ".$ap2."</h1><br>";
          echo "<div class='w3-container'><ul class=\"w3-ul\">";
          while($fila = $result->fetch_assoc()){
          echo "
            <li>
              <img src=".$fila["foto"]." class=\" w3-circle \" style=\"width:50px\">
                <a>"." ".$fila["nombre"]." ".$fila["apellido1"]." ".$fila["apellido2"]."</a><br>
            </li>";
          }
          echo "</div>";
        }
      ?>
    </div>

    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
