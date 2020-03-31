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
      <h1>Destinatario</h1>
      <?php
         $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
         if ($conn->connect_error) {
           die("Fallo de conexion con la base de datos: " . $conn->connect_error);
         }
         else{
          //echo 
           $conn->set_charset("utf8");
           $nombre = $conn->real_escape_string($_SESSION['name']);
           $sql = "SELECT id FROM profesores WHERE usuario = '$nombre'";
           $result = $conn->query($sql)
               or die ($conn->error. " en la línea ".(__LINE__-1));

           if($result->num_rows > 0){
             $fila = $result->fetch_assoc();
             $id = $fila["id"];

             $sql = "SELECT id FROM asignaturas WHERE id_profesor = '$id'";
             $result = $conn->query($sql)
                 or die ($conn->error. " en la línea ".(__LINE__-1));

             if($result->num_rows > 0){
               while($fila = $result->fetch_assoc()){
                 $id_asignatura = $fila["id"];

                 $sql = "SELECT id, curso, letra, titulación, numero_alumnos FROM clases WHERE id_asignatura1 = '$id' OR id_asignatura2 = '$id' OR id_asignatura3 = '$id' OR id_asignatura4 = '$id' OR id_asignatura5 = '$id' OR id_asignatura6 = '$id'";
                 $result = $conn->query($sql)
                     or die ($conn->error. " en la línea ".(__LINE__-1));

                 if($result->num_rows > 0){
                   $fila = $result->fetch_assoc();
                   echo "<p><a href=\"MensajeriaAlumnos.php?id=" .$fila["id"]. "&curso=" .$fila["curso"]. "&letra=" .$fila["letra"]. "&titulación=" .$fila["titulación"]. "\">" .$fila["curso"]. "º " .$fila["titulación"]. " " .$fila["letra"]. "</a> (Número de alumnos: " .$fila["numero_alumnos"]. ")</p>";
                 }
                 else{
                   echo "Ninguna clase en la base de datos tiene asignada la asignatura con id " .$id_asignatura;
                 }
               }
             }
             else{
               echo "El profesor con id " .$id. " no imparte en nignuna asignatura.";
             }
           }
           else{
             echo "El usuario con nombre " .$nombre. " no se encuentra en la base de datos.";
           }
         }
         $conn->close();
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
