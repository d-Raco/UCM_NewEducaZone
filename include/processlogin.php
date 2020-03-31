<?php
  require_once('config.php');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./style.css">
  </head>
  <body>
    <div id="procesarLogin">
        <?php
          $usuario = $_REQUEST["usuario"];
          $contraseña = $_REQUEST["contraseña"];

          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $conn->set_charset("utf8");
            $sql = "SELECT contraseña FROM tutor_legal WHERE usuario = '$usuario'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              $fila = $result->fetch_assoc();

              if($contraseña == $fila["contraseña"]){
                $_SESSION['login'] = TRUE;
                $_SESSION['name'] = $usuario;
                $_SESSION['rol'] = 'padre';
                $_SESSION['alumno'] = NULL;
                header("Location: ../padre.php");
              }
            }
            else{
              $sql = "SELECT contraseña FROM profesores WHERE usuario = '$usuario'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                $fila = $result->fetch_assoc();

                if($contraseña == $fila["contraseña"]){
                  $_SESSION['login'] = TRUE;
                  $_SESSION['name'] = $usuario;
                  $_SESSION['rol'] = 'profesor';
                  $_SESSION['alumno'] = NULL;
                  header("Location: ../profesor.php");
                }
              }
            }
          }

          echo "Error. Usuario o contraseña invalido: ";
          echo "<a href=\"../login.php\">Login</a>";

        ?>
      </div>

  </body>
</html>
