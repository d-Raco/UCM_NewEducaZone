<?php
require_once __DIR__ . '/include/dao/Incidencias.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Incidencias Profesor</title>
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

        $row = $idao->getInfo(htmlspecialchars(trim(strip_tags($_GET["id"]))), htmlspecialchars(trim(strip_tags($_GET["idAsignatura"]))));

        echo "<h2>Incidencias de " .$row["nombre"]. " " .$row["apellido1"]. " " .$row["apellido2"]. " en la asignatura de " .$row["nombre_asignatura"]. "</h2>";

        $incidencias = $idao->getIncidencias(htmlspecialchars(trim(strip_tags($_GET["id"]))), htmlspecialchars(trim(strip_tags($_GET["idAsignatura"]))));

        if(!empty($incidencias)){
          foreach($incidencias as &$value){
              echo $value['msg_incidencia'] . "<hr>";
          }
        }
        echo "<form action=\"include/process_incidencias.php\" method=\"get\">
            <input type=\"hidden\" name=\"idAlumno\" value=\"" .htmlspecialchars(trim(strip_tags($_GET['id']))). "\">
            <input type=\"hidden\" name=\"idAsignatura\" value=\"" .htmlspecialchars(trim(strip_tags($_GET['idAsignatura']))). "\">
            <p>Mensaje de la incidencia:
            <input type=\"text\" name=\"incidencia\" /><br></p>
            <input type=\"submit\" value=\"Enviar\" />
        </form>";
        ?>
    </div>

    <?php
    include("include/comun/sidebarDerProfesor.php");
    include("include/comun/pie.php");
    ?>
</div>
</body>
</html>
