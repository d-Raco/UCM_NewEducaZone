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
      if (!isset($_SESSION['login']) || ($_SESSION['rol'] != 'profesor')){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <h1>Calificaciones</h1>
      <?php
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $conn->set_charset("utf8");
          $usuario = $conn->real_escape_string($_SESSION['name']);
          $sql = "SELECT id FROM profesores WHERE usuario = '$nombre'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            $idProfesor = $fila['id'];
            $idAlumno = $_GET['idAl'];
            $idCali = $_GET['idCali'];

            $sql = "SELECT al.nombre FROM alumnos al 
              JOIN calificaciones c ON al.id_calificaciones = c.id
              WHERE idAl = '$idAlumno'";

            $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              echo "HOLA";
            }
          else{
            echo "El profesor/a con usuario: " .$nombre. " no se encuentra en la base de datos.";
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