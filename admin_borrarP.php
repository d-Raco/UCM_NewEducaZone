<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/Formularioborrar.php';
require_once __DIR__ . '/include/FormularioborrarA.php';
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Borrar</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <?php

      include("include/comun/cabecera.php");
    ?>
    <div class="signin">
      <div class="registrate">
      
      </div>
      <br></br>
      <h2>      Introduce el usuario del profesor a borrar.</h2>
      <?php

      $form = new Formularioborrar();
      $form->gestiona();

      ?>


  <br></br>
  <br></br>
      <h2>     Introduce el dni del alumno a borrar.</h2>
<?php

      $form = new FormularioborrarA();
      $form->gestiona();

      ?>

      <br><br>
     
    </div>
     <?php
        include("include/comun/pie.php");

      ?>
  </body>
</html>
