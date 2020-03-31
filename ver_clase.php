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
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");        
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div id="contenido">
      <?php
        $id = $_GET['id'];

        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $conn->set_charset("utf8");
          $sql = "SELECT DNI, nombre, apellido1, apellido2 FROM alumnos WHERE id_clase = '$id'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            echo "<p>Alumnos de la clase</p>";
            $i = 1;
            while($fila = $result->fetch_assoc()){
              echo "<p><a href=\"alumno.php?id=" .$fila["DNI"]. "\">" .$i. ". " .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</a></p>";
              $i = $i + 1;
            }
          }
          else{
            echo "No hay clases con id " .$id;
          }
        }
      ?>
    </div>

    <?php
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarDerProfesor.php");        
      }
      else{
        include("include/comun/sidebarDerPadre.php");
      }
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
