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
    <div id="procesarSignin">
        <?php
          $codigo = $_REQUEST["codigo"];
          $contraseña1 = $_REQUEST["contraseña1"];
          $contraseña2 = $_REQUEST["contraseña2"];

          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }
          else{
            $conn->set_charset("utf8");
            $sql = "SELECT * FROM codigos_de_acceso WHERE codigo = '$codigo'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              if($contraseña1 == $contraseña2){

                $filaCodigo = $result->fetch_assoc();
                $DNI = $filaCodigo["id_alumnos"];

                $apellido1 = $_REQUEST["apellido1"];
                $apellido2 = $_REQUEST["apellido2"];
                $nombre = $_REQUEST["nombre"];
                $movil = $_REQUEST["movil"];
                $telefono = $_REQUEST["telefono"];
                $correo = $_REQUEST["correo"];
                $usuario = $_REQUEST["usuario"];

                $sql = "SELECT id FROM tutor_legal";
                $result = $conn->query($sql)
                     or die ($conn->error. " en la línea ".(__LINE__-1));
                $id = $result->num_rows + 1;


                $sql = "INSERT INTO tutor_legal (id, nombre, apellido1, apellido2, telefono_movil, telefono_fijo, correo, usuario, contraseña) 
                  VALUES ('$id', '$nombre', '$apellido1', '$apellido2', '$movil', '$telefono', '$correo', '$usuario', '$contraseña1')";

                if ($conn->query($sql) === TRUE) { } 
                else { echo "Error: " . $sql . "<br>" . $conn->error;}

                $sql = "UPDATE alumnos SET id_tutor_legal='$id' WHERE DNI='$DNI'";

                if ($conn->query($sql) === TRUE) {
                  echo "Nuevo registro creado.";
                  ?>
                     <a href='./login.php'>Login</a>
                  <?php
                } 
                else { echo "Error updating record: " . $conn->error;}

              }
              else{
                echo "Las contraseñas no coinciden";
              }
            }
            else{echo "El código de acceso es incorrecto";}
          }    
        ?>
      </div>

  </body>
</html>
