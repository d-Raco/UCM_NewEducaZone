<?php
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/dao/Profesor.php';
  require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Horario Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) || $_SESSION['rol'] != 'profesor'){
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
         $cdao = new Clases();
         $pdao = new Profesor();

         $p = $pdao->getProfe(htmlspecialchars(trim(strip_tags($_SESSION['name']))));
         $rs = $cdao->getAsignaturas($p->getId());

         if($rs->num_rows > 0){
           $i = 0;
           $asignaturas = array();
           while($filaAsignatura = $rs->fetch_assoc()){
             $asignaturas[$i] = $filaAsignatura;
             $i = $i + 1;
           }

           echo "<table>";
           echo "<tr>";
           echo "<th>Horas</th>";
           echo "<th>Lunes</th>";
           echo "<th>Martes</th>";
           echo "<th>Miércoles</th>";
           echo "<th>Jueves</th>";
           echo "<th>Viernes</th>";
           echo "</tr>";
           echo "<tr>";
           echo "<td>9:00-10:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["lunes_inicio"] == 9) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["martes_inicio"] == 9) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["miercoles_inicio"] == 9) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["jueves_inicio"] == 9) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_inicio"] == 9) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>10:00-11:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 10) || ($value["lunes_fin"] == 11)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 10) || ($value["martes_fin"] == 11)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 10) || ($value["miercoles_fin"] == 11)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 10) || ($value["jueves_fin"] == 11)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 10) || ($value["viernes_fin"] == 11)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>11:00-12:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 11) || ($value["lunes_fin"] == 12)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 11) || ($value["martes_fin"] == 12)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 11) || ($value["miercoles_fin"] == 12)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 11) || ($value["jueves_fin"] == 12)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 11) || ($value["viernes_fin"] == 12)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>12:00-1:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 12) || ($value["lunes_fin"] == 13)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 12) || ($value["martes_fin"] == 13)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 12) || ($value["miercoles_fin"] == 13)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 12) || ($value["jueves_fin"] == 13)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 12) || ($value["viernes_fin"] == 13)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>1:00-2:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 13) || ($value["lunes_fin"] == 14)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 13) || ($value["martes_fin"] == 14)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 13) || ($value["miercoles_fin"] == 14)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 13) || ($value["jueves_fin"] == 14)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 13) || ($value["viernes_fin"] == 14)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>2:00-3:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 14) || ($value["lunes_fin"] == 15)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 14) || ($value["martes_fin"] == 15)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 14) || ($value["miercoles_fin"] == 15)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 14) || ($value["jueves_fin"] == 15)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 14) || ($value["viernes_fin"] == 15)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>3:00-4:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["lunes_inicio"] == 15) || ($value["lunes_fin"] == 16)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["martes_inicio"] == 15) || ($value["martes_fin"] == 16)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["miercoles_inicio"] == 15) || ($value["miercoles_fin"] == 16)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["jueves_inicio"] == 15) || ($value["jueves_fin"] == 16)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if((($value["viernes_inicio"] == 15) || ($value["viernes_fin"] == 16)) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "<tr>";
           echo "<td>4:00-5:00</td>";

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_fin"] == 17) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_fin"] == 17) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_fin"] == 17) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_fin"] == 17) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           $empty = TRUE;
           foreach ($asignaturas as &$value) {
             if(($value["viernes_fin"] == 17) && $empty){
               echo "<td>" .$value["nombre_asignatura"]. "</td>";
               $empty = FALSE;
             }
           }

           if($empty){
             echo "<td></td>";
           }

           echo "</tr>";
           echo "</table>";

         }
         else{
           echo "No se encontró ninguna asignatura asociada al id profesor " .$id. " en la base de datos.";
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
