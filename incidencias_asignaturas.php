<?php
require_once('include/DAOIncidencias.php');
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
        $idao = new IncidenciasDAO();

        $asignaturas = $idao->getAsignaturasCompartidas($_GET['alumno'], $_GET['profesor']);

        foreach ($asignaturas as &$value) {
          echo "<p><a href=\"incidencias_profesor.php?id=".$_GET['alumno']."&idAsignatura=".$value["id"]."\">".$value["nombre_asignatura"]."</a></p>";
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
