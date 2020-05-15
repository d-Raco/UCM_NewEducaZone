<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/FormularioLogin.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
  </head>
  <body>
    <?php
      include("include/comun/cabecera.php");
    ?>
    <div class="login">
      <?php
        $form = new FormularioLogin();
        $form->gestiona();
      ?>
      <div class="registrate">
        <br>¿Nuevo por aquí? <a href="signin.php">Registrate</a>
      </div>
      <?php
        include("include/comun/pie.php");
      ?>
    </div>
  </body>
</html>
