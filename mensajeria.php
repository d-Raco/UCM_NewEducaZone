<?php
require_once __DIR__ . '/include/dao/Mensajes.php';
require_once __DIR__ . '/include/FormularioMensajería.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) ){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }

      echo '<div id="contenido">
        <h1>Mensajería</h1>';

      $form = new FormularioMensajería(htmlspecialchars(trim(strip_tags($_POST["tutor"]))), htmlspecialchars(trim(strip_tags($_POST["profesor"]))));
      $form->gestiona();

      echo "</div>";

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
