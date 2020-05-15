<?php
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
      <link rel="stylesheet" href="css/tablas.css">
  </head>
  <body>
   
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div class ="horario" style="margin-top: 100px;">
    <div id="contenido" style = "margin-left: 200px;">
      <?php
        $clase = new Clases();
        $clase->setAs1(htmlspecialchars(trim(strip_tags($_GET["id1"]))));
        $clase->setAs2(htmlspecialchars(trim(strip_tags($_GET["id2"]))));
        $clase->setAs3(htmlspecialchars(trim(strip_tags($_GET["id3"]))));
        $clase->setAs4(htmlspecialchars(trim(strip_tags($_GET["id4"]))));
        $clase->setAs5(htmlspecialchars(trim(strip_tags($_GET["id5"]))));
        $clase->setAs6(htmlspecialchars(trim(strip_tags($_GET["id6"]))));
        $asignaturas = array();

        $asignaturas[1] =  $clase->getAsignatura($clase->getAs1());
        $asignaturas[2] =  $clase->getAsignatura($clase->getAs2());
        $asignaturas[3] =  $clase->getAsignatura($clase->getAs3());
        $asignaturas[4] =  $clase->getAsignatura($clase->getAs4());
        $asignaturas[5] =  $clase->getAsignatura($clase->getAs5());
        $asignaturas[6] =  $clase->getAsignatura($clase->getAs6());
        ?>

        <div id="fondoDIV">
                <?php
                echo "<h1 id='tituloTabla'>Horario de ".htmlspecialchars(trim(strip_tags($_GET["id"])))."</h1>";
                ?>
          <div class="container">
        <?php
        echo "<table id='tablaHorario'>";
        echo "<tr id='filas'>";
        echo "<th id='cabecera'>Horas</th>";
        echo "<th id='cabecera'>Lunes</th>";
        echo "<th id='cabecera'>Martes</th>";
        echo "<th id='cabecera'>Miércoles</th>";
        echo "<th id='cabecera'>Jueves</th>";
        echo "<th id='cabecera'>Viernes</th>";
        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td id='columna'>9:00-10:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["lunes_inicio"] == 9) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["martes_inicio"] == 9) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["miercoles_inicio"] == 9) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["jueves_inicio"] == 9) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_inicio"] == 9) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td id='columna'>10:00-11:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 10) || ($value["lunes_fin"] == 11)) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 10) || ($value["martes_fin"] == 11)) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 10) || ($value["miercoles_fin"] == 11)) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 10) || ($value["jueves_fin"] == 11)) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 10) || ($value["viernes_fin"] == 11)) && $empty){
            echo "<td id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>11:00-12:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 11) || ($value["lunes_fin"] == 12)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 11) || ($value["martes_fin"] == 12)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 11) || ($value["miercoles_fin"] == 12)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 11) || ($value["jueves_fin"] == 12)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 11) || ($value["viernes_fin"] == 12)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>12:00-13:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 12) || ($value["lunes_fin"] == 13)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 12) || ($value["martes_fin"] == 13)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 12) || ($value["miercoles_fin"] == 13)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 12) || ($value["jueves_fin"] == 13)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 12) || ($value["viernes_fin"] == 13)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>13:00-14:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 13) || ($value["lunes_fin"] == 14)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 13) || ($value["martes_fin"] == 14)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 13) || ($value["miercoles_fin"] == 14)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 13) || ($value["jueves_fin"] == 14)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 13) || ($value["viernes_fin"] == 14)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>14:00-15:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 14) || ($value["lunes_fin"] == 15)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 14) || ($value["martes_fin"] == 15)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 14) || ($value["miercoles_fin"] == 15)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 14) || ($value["jueves_fin"] == 15)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 14) || ($value["viernes_fin"] == 15)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>15:00-16:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["lunes_inicio"] == 15) || ($value["lunes_fin"] == 16)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["martes_inicio"] == 15) || ($value["martes_fin"] == 16)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["miercoles_inicio"] == 15) || ($value["miercoles_fin"] == 16)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["jueves_inicio"] == 15) || ($value["jueves_fin"] == 16)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if((($value["viernes_inicio"] == 15) || ($value["viernes_fin"] == 16)) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "<tr id='filas'>";
        echo "<td  id='columna'>16:00-17:00</td>";

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_fin"] == 17) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_fin"] == 17) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_fin"] == 17) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_fin"] == 17) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        $empty = TRUE;
        foreach ($asignaturas as &$value) {
          if(($value["viernes_fin"] == 17) && $empty){
            echo "<td  id='columna'>" .$value["nombre_asignatura"]. "</td>";
            $empty = FALSE;
          }
        }

        if($empty){
          echo "<td  id='columna'></td>";
        }

        echo "</tr>";
        echo "</table>";

        ?>
      </div>
    </div>
<?php
      ?>
    </div>

    <?php
      if($_SESSION['rol'] == 'profesor'){
      }
      else{
      }
      include("include/comun/pie.php");
    ?>
    </div>
  </body>
</html>
