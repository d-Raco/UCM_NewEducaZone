<?php
  require_once('include/config.php');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
  </head>
  <body>

  <?php
    include("include/comun/cabecera.php");
  ?>

    <br><br>

    <div class="container">
      <img class="mainImage" src="img/prueba.jpg" alt="main Image">
      <div class="center">Conecta con tu hijo</div>
    </div>

    <div class="cuadrados">
      <div class="cuadrado">
        <h1>Acercamiento al profesor</h1>
        <p>Ofrecemos un servicio de mensajería que te permitirá contactar con los profesores de forma sencilla y amigable para concertar citas o resolver dudas.</p>
      </div>

      <div class="cuadrado">
        <h1>Agenda electrónica</h1>
        <p>Revisa la agenda de tu hijo: deberes, exámenes, vacaciones, tutorías, etc.</p>
      </div>

      <div class="cuadrado">
        <h1>Revisa incidencias</h1>
        <p>Permitimos que los profesores pongan comentarios para que conozcas el rendimiento de tu hijo y su comportamiento en las clases.</p>
      </div>
    </div>

    <div class="cuadrados">
      <div class="cuadrado">
        <h1>Progreso a tiempo real</h1>
        <p>Puedes visualizar las calificaciones de tus hijos sin tener que pasar por el colegio.</p>
      </div>

      <div class="cuadrado">
        <h1>Sencillo, intuitivo y útil</h1>
        <p>Con una interfaz gráfica sencilla y clara mantenemos una máxima funcionalidad para que no te tengas que preocupar de nada.</p>
      </div>
    </div>

  </body>
</html>
