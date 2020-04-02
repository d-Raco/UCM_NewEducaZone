<! Artur Amon Educazone v2 2020>

<?php
require_once('include/config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<?php
if (!isset($_SESSION['login'])){
    header("Location: ./login.php");
}
?>
<div id ="crearIncidencia">
    <?php
    include("include/comun/cabecera.php");
    include("include/comun/sidebarIzqProfesor.php");
    ?>
    <form method="get" action="incidencias_process.php">
        DNI del alumno que causó la incidencia:
        <input type="text" name="DNI" />
        <br>

        Asignatura de la incidencia:
        <input type="text" name="asignatura" />
        <br>
        Mensaje de la incidencia:
        <input type="text" name="incidencia" />
        <br>


        <input type="submit" value="Enviar">
    </form>
    <?php
    include("include/comun/sidebarDerPadre.php");
    include("include/comun/pie.php");
    ?>
</div>

</body>
</html>
