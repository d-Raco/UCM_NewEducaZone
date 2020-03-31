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
      <?php
         $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
         if ($conn->connect_error) {
           die("Fallo de conexion con la base de datos: " . $conn->connect_error);
         }
         else{
           $conn->set_charset("utf8");
           $nombre = $conn->real_escape_string($_SESSION['name']);
           $sql = "SELECT * FROM profesores WHERE usuario = '$nombre'";
           $result = $conn->query($sql)
               or die ($conn->error. " en la línea ".(__LINE__-1));

           if($result->num_rows > 0){
             $fila = $result->fetch_assoc();

             echo "<h1>" .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</h1>";

             $idCentro = $fila["id_centro"];
             $sql = "SELECT * FROM centros WHERE id = '$idCentro'";
             $result = $conn->query($sql)
                 or die ($conn->error. " en la línea ".(__LINE__-1));

             if($result->num_rows > 0){
               $filaCentro = $result->fetch_assoc();
               echo "<p>Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", " .$filaCentro["provincia"]. ").</p>";
             }
             else{
               echo "No se enccontró ningún centro en la base de datos con id " .$idCentro. ".";
             }

             echo "<p>Despacho: " .$fila["despacho"]. ".</p>";
             echo "<p>Correo: " .$fila["correo"]. "</p>";

             $id = $fila["id"];
             $sql = "SELECT DISTINCT nombre_asignatura FROM asignaturas WHERE id_profesor = '$id'";
             $result = $conn->query($sql)
                 or die ($conn->error. " en la línea ".(__LINE__-1));

             if($result->num_rows > 0){
               echo "<p>Asignaturas que imparte: </p>";
               while($filaAsignatura = $result->fetch_assoc()){
                 echo "<pre>     " .$filaAsignatura["nombre_asignatura"]. "</pre>";
               }
             }
             else{
               echo "No se encontró ninguna asignatura asociada al id profesor " .$id. " en la base de datos.";
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
