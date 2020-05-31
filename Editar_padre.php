<?php
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/config.php';
 require_once __DIR__ . '/include/FormularioEditarPadre.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estiloEditar.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  </head>
  <body>
    <div class='editar_padre'>
    <?php
      if (!isset($_SESSION['login'])){
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }

      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");

      $form = new FormularioEditarPadre();
      $form->gestiona();
      ?>
      </div><br><br>
  </body>
</html>
