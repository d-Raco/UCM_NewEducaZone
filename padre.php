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
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="alumno">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
    ?>
    <div id="contenido">
      <?php
          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $conn->set_charset("utf8");
            $usuario = $conn->real_escape_string($_SESSION['name']);
            $sql = "SELECT * FROM tutor_legal WHERE usuario = '$usuario'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              $filaPadre = $result->fetch_assoc();
              $id = $filaPadre["id"];

              echo "<h1>" .$filaPadre["nombre"]. " " .$filaPadre["apellido1"]. " " .$filaPadre["apellido2"]. "</h1>";
              echo "<p>Correo electrónico: " .$filaPadre["correo"]. ".</p>";
              echo "<p>Teléfono móvil: " .$filaPadre["telefono_movil"]. ".</p>";
              echo "<p>Teléfono fijo: " .$filaPadre["telefono_fijo"]. ".</p>";

              $sql = "SELECT DNI, nombre, apellido1, apellido2 FROM alumnos WHERE id_tutor_legal = '$id'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                echo "<p>Hijos: </p>";
                while($filaAlumno = $result->fetch_assoc()){
                  echo "<pre>     <a href=\"alumno.php?id=".$filaAlumno["DNI"]."\">" .$filaAlumno["nombre"]. " " .$filaAlumno["apellido1"]. " " .$filaAlumno["apellido2"]. "</a></pre>";
                }
              }
              else{
                echo "No hay alumnos asociados con el tutor legal con id " .$id. ".";
              }
            }
            else{echo "En la base de datos no se encuentra ningún usuario con nombre " .$usuario. ".";

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
