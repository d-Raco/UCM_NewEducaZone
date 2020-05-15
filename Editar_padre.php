<?php
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/config.php';
 require_once __DIR__ . '/include/FormularioEditarPadre.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estiloEditar.css">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">

  </head>
  <body>
    <div class='editar_padre'>
    <?php
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }

      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");

      $form = new FormularioEditarPadre();
      $form->gestiona();
      ?>
      </div><br><br>
  </body>
</html>
