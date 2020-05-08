<?php
require_once __DIR__ . '/include/dao/Incidencias.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Incidencias Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="alumno">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
    ?>
    <div id="contenido">

		<?php
      $idao = new Incidencias();

      $incidencias = $idao->getIncidenciasDetalladas(htmlspecialchars(trim(strip_tags($_GET["id"]))));

      if(!empty($incidencias)){
        foreach($incidencias as &$value){
            echo "<p>".$value["nombre_asignatura"].": ".$value["msg_incidencia"]."</p><hr>";
        }
      }
		?>
	</div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
