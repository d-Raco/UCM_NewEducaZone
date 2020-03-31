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
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{

          if ($_SESSION["rol"] == "padre"){


            $idprofesor = $_GET["profesor"];
            $idtutor = $_GET["tutor"];

            $conn->set_charset("utf8");
            $sql = "SELECT * FROM profesores WHERE id = '$idprofesor'";
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
                  echo "<ol>" .$filaAsignatura["nombre_asignatura"]. "</ol>";
                }
                $contenido_msg = NULL;
                echo "<a href=\"mensajeria.php?tutor=".$idtutor."&profesor=".$idprofesor."&contenido_msg=".$contenido_msg."\">Enviar un mensaje</a>";
              }
              else{
                echo "No se encontró ninguna asignatura asociada al id profesor " .$id. " en la base de datos.";
              }

             }
            else{
              //echo "El usuario con nombre " .$nombre. " no se encuentra en la base de datos.";
            }
          }
          elseif ($_SESSION["rol"] == "profesor"){


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

        }
        $conn->close();
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
