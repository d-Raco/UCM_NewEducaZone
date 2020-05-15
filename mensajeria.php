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
    <link rel="stylesheet" type="text/css" href="css/mensajeria.css">
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

      echo '<div class="contenido2" style = "margin-left: 230px; margin-top:100px;">
        <h1>Mensajería</h1>';
      if(empty($_POST["tutor"])){
        echo "El alumno no tiene un tutor legal registrado.";
      }
      else{
        $form = new FormularioMensajería(htmlspecialchars(trim(strip_tags($_REQUEST["tutor"]))), htmlspecialchars(trim(strip_tags($_REQUEST["profesor"]))));
        $form->gestiona();
      }
      echo "</div>";

      ?>
     </div>
    </body>
  </html>
