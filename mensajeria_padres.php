<?php
  require_once('include/config.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajeria_Padres</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
      
    ?>
    <div id="contenido">
      <?php
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $usuario = $conn->real_escape_string($_SESSION['name']);
        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $sql = "SELECT t.id, a.nombre, a.apellido1, a.apellido2, a.id_clase FROM tutor_legal t JOIN alumnos a ON id = id_tutor_legal
            WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));
          if($result->num_rows > 0){
            echo "<h1>Mensajería</h1>";
            echo "<h2><a href=\"padre_msgnuevo.php\">Nuenvo Mensaje</a></h2>";  
          }
        }
        $conn->close();
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>