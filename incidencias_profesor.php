<?php
require_once('include/DAOIncidencias.php');
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
        $idao = new IncidenciasDAO();

        $row = $idao->getInfo($_GET['id'], $_GET['idAsignatura']);

        echo "<h2>Incidencias de " .$row["nombre"]. " " .$row["apellido1"]. " " .$row["apellido2"]. " en la asignatura de " .$row["nombre_asignatura"]. "</h2>";

        $incidencias = $idao->getIncidencias($_GET['id'], $_GET['idAsignatura']);

        if(!empty($incidencias)){
          foreach($incidencias as &$value){
              echo $value['msg_incidencia'] . "<hr>";
          }
        }
        echo "<form action=\"include/process_incidencias.php\" method=\"get\">
            <input type=\"hidden\" name=\"idAlumno\" value=\"" .$_GET['id']. "\">
            <input type=\"hidden\" name=\"idAsignatura\" value=\"" .$_GET['idAsignatura']. "\">
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
