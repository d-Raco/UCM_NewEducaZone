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
      <?php
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $conn->set_charset("utf8");
          $usuario = $conn->real_escape_string($_SESSION['name']);

          $sql = "SELECT id FROM profesores WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $fila = $result->fetch_assoc();
            $idProfesor = $fila['id'];
            $idAlumno = $_GET['idAl'];

            $sql = "SELECT * FROM alumnos al
              JOIN calificaciones c ON al.id_calificaciones = c.id
              WHERE al.DNI = '$idAlumno'";

            $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              $alumno = $result->fetch_assoc();
              echo "<h1>Calificación de " .$alumno["nombre"]. " " .$alumno["apellido1"]. " " .$alumno["apellido2"]. ":</h1>";

              $a1 = $alumno["id_asignatura1"];
              $a2 = $alumno["id_asignatura2"];
              $a3 = $alumno["id_asignatura3"];
              $a4 = $alumno["id_asignatura4"];
              $a5 = $alumno["id_asignatura5"];
              $a6 = $alumno["id_asignatura6"];

              $nota = $_REQUEST["notaNueva"];
              $idAsigna = $_REQUEST["idAsignatura"];
              $idCali = $alumno["id_calificaciones"];
              if($nota >= 0 && $nota <= 10){
                switch($idAsigna){
                  case $a1:
                    $sql = "UPDATE calificaciones SET nota1 = '$nota' WHERE id = '$idCali'";
                    break;
                  case $a2:
                    $sql = "UPDATE calificaciones SET nota2 = '$nota' WHERE id = '$idCali'";
                    break;
                  case $a3:
                    $sql = "UPDATE calificaciones SET nota3 = '$nota' WHERE id = '$idCali'";
                    break;
                  case $a4:
                    $sql = "UPDATE calificaciones SET nota4 = '$nota' WHERE id = '$idCali'";
                    break;
                  case $a5:
                    $sql = "UPDATE calificaciones SET nota5 = '$nota' WHERE id = '$idCali'";
                    break;
                  case $a6:
                    $sql = "UPDATE calificaciones SET nota6 = '$nota' WHERE id = '$idCali'";
                    break;
                  default:
                    $sql = "";
                    break;
                }
                $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));
              }
              else{
                echo "<p>Nota no válida</p>";
              }

              $sql = "SELECT id, nombre_asignatura FROM asignaturas WHERE (id = '$a1' || id = '$a2' || id = '$a3' || id = '$a4' || id = '$a5' || id = '$a6') && id_profesor = '$idProfesor'";

              $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                while($asignatura = $result->fetch_assoc()){
                  echo "<p>" .$asignatura["nombre_asignatura"]. ": </p>";
                  switch($asignatura["id"]){
                    case $a1:
                      echo "<p>" .$alumno["nota1"]. "</p>";
                      break;
                    case $a2:
                      echo "<p>" .$alumno["nota2"]. "</p>";
                      break;
                    case $a3:
                      echo "<p>" .$alumno["nota3"]. "</p>";
                      break;
                    case $a4:
                      echo "<p>" .$alumno["nota4"]. "</p>";
                      break;
                    case $a5:
                      echo "<p>" .$alumno["nota5"]. "</p>";
                      break;
                    case $a6:
                      echo "<p>" .$alumno["nota6"]. "</p>";
                      break;
                    default:
                      echo "<p>No se ha encontrado ninguna nota</p>";
                      break;
                  }
                  echo "<form method=\"post\">";
                    echo "<p> Escribe aquí la nueva nota:";
                    echo "<input type=\"varchar\" name=\"notaNueva\"></p>";
                    echo "<input type=\"hidden\" name=\"idAsignatura\" value=\"" .$asignatura["id"]. "\">;
                    echo "<input class=\"nota\" type=\"submit\" value=\"Submit\">";
                  echo "</form>";
                }
              }
            }
          }
          else{
            echo "El profesor/a con usuario: " .$usuario. " no se encuentra en la base de datos.";
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
