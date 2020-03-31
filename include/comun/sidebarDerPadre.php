<?php
  require_once('include/config.php');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detalles</title>
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">
  </head>
  <body>

    <div id="sidebarDer">
     <ul><a href="padre.php">Inicio</a></ul><br>

      <?php
          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $conn->set_charset("utf8");
            $usuario = $conn->real_escape_string($_SESSION['name']);
            $sql = "SELECT a.nombre, a.foto, a.DNI FROM alumnos a JOIN tutor_legal t ON t.id = a.id_tutor_legal WHERE t.usuario = '$usuario'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                  echo "<ul><img src=\"" .$row["foto"]. "\"  width=\"150\" height=\"150\"><ul>";
                  echo "<ul><a href=\"alumno.php?id=".$row["DNI"]."\">".$row["nombre"]."</a><br><br>";
                }
            }
            else{echo "En la base de datos no se encuentra ningún usuario con nombre " .$usuario. "."; }
          }
          $conn->close();
      ?>
    </div>

  </body>
</html>
