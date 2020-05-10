<?php
require_once __DIR__ . '/../dao/Profesor.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">
  </head>
  <body>
    <div id="sidebarIzq">
      <div id="imagen_alumno">
        <?php
          $profesor = new Profesor();
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $profesor->getProfe();
          echo "<img src=\"" .$profesor->getFoto(). "\" width=\"150\" height=\"150\">";
        ?>
      </div>
     <h3><?php echo htmlspecialchars(trim(strip_tags($_SESSION["name"]))) ?></h3>
        <ul><a href="ver_profesor.php">Perfil</a></ul>
        <ul><a href="cursos.php">Clases</a></ul>
        <ul><a href="horario_profesor.php">Horario</a></ul>
        <ul><a href="mensajeriaClases.php">Mensajería</a></ul>
        <ul><a href="foro_seleccion.php">Foro</a></ul>
        <ul><a>Calendario</a></ul>
    </div>

  </body>
</html>
