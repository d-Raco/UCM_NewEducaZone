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
          $id = $_GET["id"];
          $conn->set_charset("utf8");
          $sql = "SELECT * FROM calificaciones WHERE id = '$id'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $filaCal = $result->fetch_assoc();
            echo "<h1>Calificaciones</h1>";
             echo "<table style=\"width:55%\" frame = \"border\" rules = \"all\">
                <tr>
                  <th>Asignatura</th>
                  <th>Nota</th>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura1"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota1"]."</td>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura2"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota2"]."</td>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura3"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota3"]."</td>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura4"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota4"]."</td>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura5"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota5"]."</td>
                </tr>
                <tr>"
                  $idA = $filaCal["id_asignatura6"];
                  $sql = "SELECT nombre_asignatura FROM asignaturas WHERE id = '$idA'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  $asign = $result->fetch_assoc();
                  "<td>".$asign["nombre_asignatura"]."</td>
                  <td>".$filaCal["nota6"]."</td>
                </tr>
              </table>";

          }
          else{

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
