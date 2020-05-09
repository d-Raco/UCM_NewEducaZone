<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/FormularioRegistro.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body>
    <?php
      include("include/comun/cabecera.php");
    ?>
    <div id="signin">
      <div class="registrate">
        <h2>Registrate</h2>
      </div>
      <?php
      $form = new FormularioRegistro();
      $form->gestiona();
      ?>
      <br><br>
    </div>
    <?php
      include("include/comun/pie.php");
    ?>
  </body>
</html>
