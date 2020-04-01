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
        $id = $_GET['id'];
        $curso = $_GET['curso'];
        $letra = $_GET['letra'];
        $titulación = $_GET['titulación'];

        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $conn->set_charset("utf8");
          $sql = "SELECT DNI, nombre, apellido1, apellido2, id_tutor_legal FROM alumnos WHERE id_clase = '$id'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $i = 1;
            $contenido_msg = NULL;
            while($fila = $result->fetch_assoc()){
              echo "<p><a href=\"mensajeria.php?tutor= ".$fila["id_tutor_legal"]."&profesor= ".$id."&contenido_msg= ".$contenido_msg."\">" .$i. ". Tutor legal de " .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</a></p>";
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
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
