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
          $conn->set_charset("utf8");
          $sql = "SELECT t.id, a.nombre, a.apellido1, a.apellido2, a.id_clase FROM tutor_legal t JOIN alumnos a ON id = id_tutor_legal
            WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));
          if($result->num_rows > 0){
            echo "<h1>Mensaje Nuevo</h1>";
            while ($filaAlumno = $result->fetch_assoc()){
              echo "<h2>Profesores de ".$filaAlumno['nombre']. " " .$filaAlumno['apellido1']. " " .$filaAlumno['apellido2']. ":</h2>";
              $clase = $filaAlumno['id_clase'];
              $id_tutor = $filaAlumno['id'];
              $sql = "SELECT * FROM clases WHERE id = '$clase'";
              $result2 = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));
              if($result2->num_rows > 0){
                $filaClase = $result2->fetch_assoc();
                $a1 = $filaClase["id_asignatura1"];
                $a2 = $filaClase["id_asignatura2"];
                $a3 = $filaClase["id_asignatura3"];
                $a4 = $filaClase["id_asignatura4"];
                $a5 = $filaClase["id_asignatura5"];
                $a6 = $filaClase["id_asignatura6"];
                $sql = "SELECT  a.nombre_asignatura, p.id, p.nombre, p.apellido1, p.apellido2 FROM asignaturas a JOIN profesores p ON a.id_profesor = p.id WHERE a.id = '$a1' || a.id = '$a2' || a.id = '$a3' || a.id = '$a4' || a.id = '$a5' || a.id = '$a6'";
                $result3 = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));
                if($result3->num_rows > 0){
                  while ($filaProfe = $result3->fetch_assoc()){
                    $contenido_msg = NULL;
                    echo "<ol><a href=\"mensajeria.php?tutor=".$id_tutor."&profesor=".$filaProfe['id']."&contenido_msg=".$contenido_msg."\">".$filaProfe['nombre']." ".$filaProfe['apellido1']." ".$filaProfe['apellido2']." (".$filaProfe['nombre_asignatura'].")</a></ol>";
                  }
                }
              }
            }
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
