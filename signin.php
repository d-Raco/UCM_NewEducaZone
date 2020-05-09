<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/FormularioRegistro.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php
      include("include/comun/cabecera.php");
    ?>
    <div id="signin">
      <?php
      $form = new FormularioRegistro();
      $form->gestiona();
      ?>
    </div>
    <?php
      include("include/comun/pie.php");
    ?>
  </body>
</html>
