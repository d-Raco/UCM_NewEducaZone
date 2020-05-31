<?php
require_once __DIR__ . '/include/dao/DAO_Incidencias.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Asignaturas Incidencias</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<?php
if (!isset($_SESSION['login'])){
  $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
  echo "<script>window.open('".$url."','_self');</script>";
  //header("Location: ./login.php");
  //exit;
}
?>
<div>
    <?php
    include("include/comun/cabecera.php");
    include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div class="contenido" style="margin-left: 230px;">
        <?php
        echo '<h1>Selecciona la asignatura en la que quieres añadir una incidencia:</h1>';
        $incidencia = new DAO_Incidencias();

        $asignaturas = $incidencia->getAsignaturasCompartidas(htmlspecialchars(trim(strip_tags($_GET["alumno"]))), htmlspecialchars(trim(strip_tags($_GET["profesor"]))));
        echo '<div class="w3-container"><ul class="w3-ul">';
        foreach ($asignaturas as &$value) {
          echo "<li><a href=\"incidencias.php?idAlumno=".htmlspecialchars(trim(strip_tags($_GET['alumno'])))."&idAsignatura=".$value["id"]."\">".$value["nombre_asignatura"]."</a></li>";
        }
        echo '</ul></div></div>';

    //include("include/comun/sidebarDerProfesor.php");
    include("include/comun/pie.php");
    ?>
</div>
</body>
</html>
