<?php
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Clases para Mensajería</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) || $_SESSION['rol'] != 'profesor'){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <h1>Destinatario</h1>
      <?php
      $profesor = new Profesor();
      $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION['name']))));
      $profesor->getProfe();
      $idProfesor = $profesor->getId();
      $clases = $profesor->getAsignaturasProfesor();
      foreach($clases as &$value){
        echo "<p><a href=\"mensajeriaAlumnos.php?id=" .$value["id"]. "&profesor=" .$idProfesor. "\">" .$value["curso"]. "º " .$value["titulación"]. " " .$value["letra"]. "</a> (Número de alumnos: " .$value["numero_alumnos"]. ")</p>";
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
