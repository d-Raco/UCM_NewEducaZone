<?php
require_once __DIR__ . '/include/dao/Incidencias.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Asignaturas Incidencias</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<?php
if (!isset($_SESSION['login'])){
    header("Location: ./login.php");
}
?>
<div id ="profesor">
    <?php
    include("include/comun/cabecera.php");
    include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
        <?php
        $idao = new Incidencias();

        $asignaturas = $idao->getAsignaturasCompartidas(htmlspecialchars(trim(strip_tags($_GET["alumno"]))), htmlspecialchars(trim(strip_tags($_GET["profesor"]))));

        foreach ($asignaturas as &$value) {
          echo "<p><a href=\"incidencias_profesor.php?id=".htmlspecialchars(trim(strip_tags($_GET['alumno'])))."&idAsignatura=".$value["id"]."\">".$value["nombre_asignatura"]."</a></p>";
        }
        ?>
    </div>

    <?php
    include("include/comun/sidebarDerProfesor.php");
    include("include/comun/pie.php");
    ?>
</div>
</body>
</html>
