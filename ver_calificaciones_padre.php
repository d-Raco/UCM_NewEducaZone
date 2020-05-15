<?php
require_once __DIR__ . '/include/dao/Calificaciones.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Calificaciones Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/tablas.css">
</head>
<body>
    <?php
        include("include/comun/cabecera.php");
        if ($_SESSION['rol'] == 'profesor') {
            include("include/comun/sidebarIzqProfesor.php");
        } else {
            include("include/comun/sidebarIzqPadre.php");
        }
    ?>
    <div class="cali" style="margin-top: 100px;">
        <div id="contenido" style = "margin-left: 250px;">
            <h1 id='tituloTabla'>Calificaciones</h1>
            <div id="container">
                <?php
                $calificación = new Calificaciones();
                $calificación->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
                $calificación->getCal();
                echo "<table id='tablaIncidencias'>
              <tr id='filas'>
                <th id='cabecera'>Asignatura</th>
                <th id='cabecera'>Nota</th>
              </tr>";
                for ($i = 1; $i < 7; $i++) {
                    echo "<tr id='filas'>
                <td id='columna1'>" . $calificación->getNombreAsignatura($i) . "</td>
                <td id='columna2'>" . $calificación->getNotaAsignatura($i) . "</td>
              </tr>";
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
    <?php
        include("include/comun/pie.php");
    ?>
</body>
</html>
