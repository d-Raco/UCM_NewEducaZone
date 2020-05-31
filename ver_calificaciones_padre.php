<?php
require_once __DIR__ . '/include/dao/DAO_Calificaciones.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Calificaciones Padre</title>
    <link rel="stylesheet" type="text/css" href="css/tablas.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
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
          <div id="contenido" style = "margin-left: 230px;margin-right: 100px;background-color: #f1f1f1;">
            <h1 id='tituloTabla'>Calificaciones</h1>
            <div id="container">
                <?php
                $calificacion = new Calificaciones();
                $calificacion->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
                $dao_cal = new DAO_Calificaciones();
                $dao_cal->getCal($calificacion);
                echo "<table id='tablaIncidencias'>
              <tr id='filas'>
                <th id='cabecera'>Asignatura</th>
                <th id='cabecera'>Nota</th>
              </tr>";
                for ($i = 1; $i < 7; $i++) {
                    echo "<tr id='filas'>
                <td id='columna1'>" . $dao_cal->getNombreAsignatura($calificacion, $i) . "</td>
                <td id='columna2'>" . $calificacion->getNotaAsignatura($i) . "</td>
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
