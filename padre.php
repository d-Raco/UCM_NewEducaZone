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

              $sql = "SELECT * FROM alumnos WHERE id_tutor_legal = '$id'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                $filaAlumno = $result->fetch_assoc();
                echo "<h1>" .$filaAlumno["nombre"]. " " .$filaAlumno["apellido1"]. " " .$filaAlumno["apellido2"]. "</h2>";
                echo "<img src=\"" .$filaAlumno["foto"]. "\"  width=\"150\" height=\"150\">";
                echo "<p>Fecha de nacimiento: " .$filaAlumno["fecha_nacimiento"]. ".</p>";
                echo "<p>DNI: " .$filaAlumno["DNI"]. ".</p>";

                $idClase = $filaAlumno["id_clase"];
                $sql = "SELECT * FROM clases WHERE id = '$idClase'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  $filaClase = $result->fetch_assoc();
                  echo "<p>Clase: " .$filaClase["curso"]. "º " .$filaClase["titulación"]. " " .$filaClase["letra"]. ".</p>";
                }
                else{
                  echo "La clase con id " .$idClase. " no se encuentra en la base de datos.";
                }

                $idCentro = $filaAlumno["id_centro"];
                $sql = "SELECT * FROM centros WHERE id = '$idCentro'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  $filaCentro = $result->fetch_assoc();
                  echo "<p>Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", " .$filaCentro["provincia"]. ").</p>";
                }
                else{
                  echo "El centro con id " .$idCentro. " no se encuentra en la base de datos.";
                }

                $idTutor = $filaAlumno["id_tutor_legal"];
                $sql = "SELECT * FROM tutor_legal WHERE id = '$idTutor'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  $filaTutor = $result->fetch_assoc();
                  echo "<p>Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. " Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").</p>";
                }
                else{
                  echo "No hay ningún tutor legal con al id " .$idTutor. " en la base de datos.";
                }

                echo "<p>Observaciones médicas: " .$filaAlumno["observaciones_medicas"]. "</p>";
                echo "<a href=\"ver_calificaciones_padre.php?id=" .$filaAlumno["id_calificaciones"]. "\">Calificaciones</a>";
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
