<?php
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Clases para Mensajería</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/mensajeriaAlumnos.css">
  </head>
  <body>

   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div class="contenido" style = "margin-left: 230px;">
      <h1>Seleccione la clase del alumno a contactar</h1>
      <?php
      $profesor = new Profesor();
      $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
      $dao_profesor = new DAO_Profesor();
      $dao_profesor->getProfe($profesor);
      $idProfesor = $profesor->getId();
      $clases = $dao_profesor->getAsignaturasProfesor($idProfesor);
      echo "<div class='w3-container'><ul class=\"w3-ul\">";
      foreach($clases as &$value){
        echo "<li><a href=\"mensajeriaAlumnos.php?id=" .$value["id"]. "&profesor=" .$idProfesor. "\">" .$value["curso"]. "º " .$value["titulacion"]. " " .$value["letra"]. "</a> (Número de alumnos: " .$value["numero_alumnos"]. ")</li>";
      }
      echo '</ul></div>';
      ?>
    </div>

    <?php
      //include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
