<?php
  require_once('include/DAOProfe.php');
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
          $pdao = new ProfeDao();
          $p = $pdao->getProfe($_SESSION['name']);
          echo "<img src=\"" .$p->getFoto(). "\" width=\"150\" height=\"150\">";
        ?>
      </div>
     <h3><?php echo $_SESSION["name"] ?></h3>
        <ul><a href="cursos.php">Clases</a></ul>
        <ul><a href="horario_profesor.php">Horario</a></ul>
        <ul><a href="mensajeriaClases.php">Mensajería</a></ul>
        <ul><a>Calendario</a></ul>
    </div>

  </body>
</html>
