<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">
  </head>
  <body>
    <div id="sidebarIzq">
      <div id="imagen_alumno">
        <?php
            $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

            if ($conn->connect_error) {
              die("Fallo de conexion con la base de datos: " . $conn->connect_error);
            }
            else{
              $conn->set_charset("utf8");
              $usuario = $conn->real_escape_string($_SESSION['name']);
              $sql = "SELECT foto FROM profesores WHERE usuario = '$usuario'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                $fila = $result->fetch_assoc();
                echo "<img src=\"" .$fila["foto"]. "\" width=\"150\" height=\"150\">";
              }
              else{
                echo "Ningún profesor tiene el usuario " .$usuario. "en la base de datos.";
              }
            }
            $conn->close();
        ?>
      </div>
     <h3><?php echo $_SESSION["name"] ?></h3>
        <ul><a href="clases.php">Clases</a></ul>
        <ul><a href="horario_profesor.php">Horario</a></ul>
        <ul><a href="mensajeriaClases.php">Mensajería</a></ul>
        <ul><a>Calendario</a></ul>
    </div>

  </body>
</html>
