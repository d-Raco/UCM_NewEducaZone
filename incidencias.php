<?php
require_once __DIR__ . '/include/dao/Incidencias.php';
require_once __DIR__ . '/include/FormularioIncidencia.php';
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
      if($_SESSION['rol'] == "padre"){
        include("include/comun/sidebarIzqPadre.php");
      }
      elseif($_SESSION['rol'] == "profesor"){
        include("include/comun/sidebarIzqProfesor.php");
      }
    ?>
    <div id="contenido">

		<?php
      if($_SESSION['rol'] == "padre"){
        $incidencia = new Incidencias();
        $incidencia->setIdAsignatura(htmlspecialchars(trim(strip_tags($_GET["idAlumno"]))));
        $incidencias = $incidencia->getIncidenciasDetalladas();

        if(!empty($incidencias)){
          foreach($incidencias as &$value){
              echo "<p>".$value["nombre_asignatura"].": ".$value["msg_incidencia"]."</p><hr>";
          }
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $form = new FormularioIncidencia(htmlspecialchars(trim(strip_tags($_REQUEST["idAlumno"]))), htmlspecialchars(trim(strip_tags($_REQUEST["idAsignatura"]))));
        $form->gestiona();
      }
		?>
	</div>

    <?php
    if($_SESSION['rol'] == "padre"){
      include("include/comun/sidebarDerPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      include("include/comun/sidebarDerProfesor.php");
    }
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
