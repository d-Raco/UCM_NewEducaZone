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
  <div id ="alumno">
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
        if($_SESSION['rol'] == "padre"){
          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
          $id = $conn->real_escape_string($_GET['id']);
          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $usuario = $_SESSION['name'];

            $sql = "SELECT id FROM tutor_legal WHERE usuario = '$usuario'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));
            //COMPROBAMOS SI EXISTE EL USUARIO EXISTE    
            if($result->num_rows > 0){

              $filaPadre = $result->fetch_assoc();
              $idTutor = $filaPadre['id'];
              $sql = "SELECT * FROM alumnos WHERE DNI = '$id' AND id_tutor_legal = '$idTutor'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));
              //COMPROBAMOS SI EL USUARIO Y EL HIJO SE CORRESPONDEN  
              if($result->num_rows > 0){
                
                $filaAlumno = $result->fetch_assoc();
                echo "<h1>" .$filaAlumno["nombre"]. " " .$filaAlumno["apellido1"]. " " .$filaAlumno["apellido2"]. "</h1>";
                echo "<img src=\"" .$filaAlumno["foto"]. "\"  width=\"150\" height=\"150\">";
                echo "<p>Fecha de nacimiento: " .$filaAlumno["fecha_nacimiento"]. ".</p>";
                echo "<p>DNI: " .$filaAlumno["DNI"]. ".</p>";

                $idClase = $filaAlumno["id_clase"];
                $sql = "SELECT * FROM clases WHERE id = '$idClase'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  $filaClase = $result->fetch_assoc();
                  echo "Clase: ";
                  echo "<a href=\"ver_clase.php?id=" .$filaAlumno["id_clase"]. "\">" .$filaClase["curso"]. "º " .$filaClase["titulación"]. " " .$filaClase["letra"]. "</a>";
                  echo "<p><a href=\"horario_alumno.php?id=" .$filaAlumno["nombre"]. "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "\">Horario de la clase</a></p>";
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
                  echo "<p>Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. ". Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").</p>";
                }
                else{
                  echo "No hay ningún tutor legal con el id " .$idTutor. " en la base de datos.";
                }

                echo "<p>Observaciones médicas: " .$filaAlumno["observaciones_medicas"]. "</p>";
                echo "<a href=\"ver_calificaciones_padre.php?id=" .$filaAlumno["id_calificaciones"]. "\">Calificaciones</a>";

                $a1 = $filaClase["id_asignatura1"];
                $a2 = $filaClase["id_asignatura2"];
                $a3 = $filaClase["id_asignatura3"];
                $a4 = $filaClase["id_asignatura4"];
                $a5 = $filaClase["id_asignatura5"];
                $a6 = $filaClase["id_asignatura6"];
                $sql = "SELECT id_profesor, nombre_asignatura FROM asignaturas WHERE id = '$a1' || id = '$a2' || id = '$a3' || id = '$a4' || id = '$a5' || id = '$a6'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  echo "<p>Profesores:</p>";
                  while($filaAsignatura = $result->fetch_assoc()){
                    $idProfesor = $filaAsignatura["id_profesor"];
                    $sql = "SELECT nombre, apellido1, apellido2 FROM profesores WHERE id = '$idProfesor'";
                    $result2 = $conn->query($sql)
                        or die ($conn->error. " en la línea ".(__LINE__-1));

                    if($result2->num_rows > 0){
                      $filaProfesor = $result2->fetch_assoc();
                      echo "<ol><a href=\"profesor.php?profesor=" .$idProfesor. "&tutor=" .$idTutor. "\">     " .$filaProfesor["nombre"]. " " .$filaProfesor["apellido1"]. " " .$filaProfesor["apellido2"]. " (" .$filaAsignatura["nombre_asignatura"]. ")</a></ol>";
                    }
                  }
                }
              }
              else{
                header("Location: login.php");
              }  
            }
            else{
              header("Location: login.php");
            }
          }
          $conn->close();
        }
        elseif($_SESSION['rol'] == "profesor"){
          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
          $id = $conn->real_escape_string($_GET['id']);
          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $usuario = $_SESSION['name'];
            $sql = "SELECT id FROM profesores WHERE usuario = '$usuario'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));
            //COMPROBAMOS SI EXISTE EL USUARIO EXISTE    
            if($result->num_rows > 0){

              $filaProfe = $result->fetch_assoc();
              $idProfe = $filaProfe['id'];
              $idAlumno = $_GET['id'];
              $sql = "SELECT * FROM alumnos WHERE DNI = '$idAlumno'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));
              //COMPROBAMOS SI EL PROFE Y EL ALUMNO SE CORRESPONDEN  
              if($result->num_rows > 0){
                $filaAlumno = $result->fetch_assoc();
                echo "<h1>" .$filaAlumno["nombre"]. " " .$filaAlumno["apellido1"]. " " .$filaAlumno["apellido2"]. "</h1>";
                echo "<img src=\"" .$filaAlumno["foto"]. "\"  width=\"150\" height=\"150\">";
                echo "<p>Fecha de nacimiento: " .$filaAlumno["fecha_nacimiento"]. ".</p>";
                echo "<p>DNI: " .$filaAlumno["DNI"]. ".</p>";
              }
              $idClase = $filaAlumno["id_clase"];
              $sql = "SELECT * FROM clases WHERE id = '$idClase'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                $filaClase = $result->fetch_assoc();
                echo "Clase: ";
                echo "<a href=\"ver_clase.php?id=" .$filaAlumno["id_clase"]. "\">" .$filaClase["curso"]. "º " .$filaClase["titulación"]. " " .$filaClase["letra"]. "</a>";
                echo "<p><a href=\"horario_alumno.php?id=" .$filaAlumno["nombre"]. "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "\">Horario de la clase</a></p>";
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
                echo "<p>Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. ". Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").</p>";
              }
              else{
                echo "No hay ningún tutor legal con el id " .$idTutor. " en la base de datos.";
              }

              echo "<p>Observaciones médicas: " .$filaAlumno["observaciones_medicas"]. "</p>";
              echo "<ol><a href=\"ver_calificaciones_profesor.php?idCali=" .$filaAlumno["id_calificaciones"]. "&idAl=".$idAlumno."\">Calificaciones</a></ol>";
              $contenido_msg = NULL;
              echo "<ol><a href=\"mensajeria.php?tutor=".$idTutor."&profesor=".$idProfe."&contenido_msg=".$contenido_msg."\">Enviar un mensaje</a></ol>";
            } 
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
