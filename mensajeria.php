<?php
require_once __DIR__ . '/include/dao/DAO_Mensajes.php';
require_once __DIR__ . '/include/FormularioMensajeria.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería</title>
    <link rel="stylesheet" type="text/css" href="css/mensajeria.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) ){
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
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
        $form = new FormularioMensajeria(htmlspecialchars(trim(strip_tags($_REQUEST["tutor"]))), htmlspecialchars(trim(strip_tags($_REQUEST["profesor"]))));
        $form->gestiona();
      }
      echo "</div>";

      ?>
     </div>
    </body>
  </html>
