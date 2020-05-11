<?php
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/config.php';
 require_once __DIR__ . '/include/FormularioEditarProfesor.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/estiloEditar.css">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  </head>
  <body>
    <?php
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="alumno">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenedor">
       <?php
     $form = new FormularioEditProfesor();
      $form->gestiona();
        
    ?>
    </div>
    </div>

    <?php
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");

    
    ?>
   </div>
  </body>
</html>
