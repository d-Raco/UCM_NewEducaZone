<?php
require_once __DIR__ . '/../dao/Profesor.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/sidebarIzq.css">
  </head>
  <body>
  <?php
    $profesor = new Profesor();
    $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
    $profesor->getProfe();

    echo 
    "<div class='sidebar'>
      <img src=\"" .$profesor->getFoto(). "\" width=\"200\" height=\"200\">
      <a class='nombre_profe'>".htmlspecialchars(trim(strip_tags($_SESSION["name"])))."</a>
      <a href='ver_profesor.php'>Mis datos</a>
      <a href='mensajeriaClases.php'>Mis mensajes</a>
      <a href='foro_seleccion.php'>Foro</a>
      <a href='cursos.php'>Clases</a>
      <a href='horario_profesor.php'>Horario</a>
    </div>";
  ?>

  </body>
</html>
