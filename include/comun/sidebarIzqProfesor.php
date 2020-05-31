<?php
require_once __DIR__ . '/../dao/DAO_Profesor.php';
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/sidebarIzq.css">
	<script>
	function goBack() {
	  window.history.back();
	}
	</script>
  </head>
  <body>
  <?php
    $profesor = new Profesor();
    $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
    $dao_profesor = new DAO_Profesor();
    $dao_profesor->getProfe($profesor);

    echo
    "<div class='sidebar'>
      <img src=\"" .$profesor->getFoto(). "\" width=\"200\" height=\"200\">
      <p>".htmlspecialchars(trim(strip_tags($_SESSION["name"])))."</p>
      <a href='ver_profesor.php'>Mis datos</a>
      <a href='mensajeriaClases.php'>Mis mensajes</a>
      <a href='foro_seleccion.php'>Foro</a>
      <a href='cursos.php'>Clases</a>
      <a href='horario_profesor.php'>Horario</a>
      <a href='calendario.php'>Calendario</a></br>
      <div class='back'>
		<img src='img/back-button-64-64.png' onclick='goBack()'></img>
	  </div>
    </div>";
  ?>

  </body>
</html>
