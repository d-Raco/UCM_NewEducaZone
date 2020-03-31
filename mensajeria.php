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
      if (!isset($_SESSION['login']) ){
        header("Location: ./login.php");
      }
    ?>
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
      <h1>Mensajería</h1>

              <form method="post">
                <p class="msg"> Escribe aqui tu mensaje: <br/>
                <input type="varchar" name="contenido_msg"></p>
                <input class="msg" type="submit" value="Submit">
              </form>

  <?php
      if($_SESSION['rol'] == 'profesor'){

          $roldest =  "padre";
          $rolorigen = "profesor";
          $mensaje = " ";

          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }


          $usuario = $conn->real_escape_string($_SESSION['name']);


          $conn->set_charset("utf8");
          $sql = "SELECT id FROM profesores WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $idorig = $fila["id"];
          }
          $iddestino = $_REQUEST['id'];
        
          $mensaje = $_REQUEST["contenido_msg"];
          setlocale(LC_TIME,"es_ES");
          $tiempo = date('Y-m-d h:i:s');
         // $tiempo = strftime("%D %H:%M:%S");


          if($mensaje != ""){
            $sql = "INSERT INTO mensajería (id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora)
            VALUES ('$idorig','$rolorigen','$iddestino','$roldest','$mensaje','$tiempo')";
             $conn->query($sql);
          }
      }


      else if($_SESSION['rol'] == 'padre'){
          $roldest =  "profesor";
          $rolorigen = "padre";
          $mensaje = " ";

          $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

          if ($conn->connect_error) {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
          }


          $usuario = $conn->real_escape_string($_SESSION['name']);


          $conn->set_charset("utf8");
          $sql = "SELECT id FROM tutor_legal WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $idorig = $fila["id"];
          }
            $iddestino = $_REQUEST['tutor'];
            $mensaje = $_REQUEST["contenido_msg"];
            setlocale(LC_TIME,"es_ES");
            $tiempo = date('Y-m-d h:i:s');
           // $tiempo = strftime("%D %H:%M:%S");


           if($mensaje != ""){
            $sql = "INSERT INTO mensajería (id_origen,rol_origen,id_destinatario,rol_destinatario,contenido_msg,fecha_hora)
            VALUES ('$idorig','$rolorigen','$iddestino','$roldest','$mensaje','$tiempo')";
             $conn->query($sql);
           }

      }

   
          $sql = "SELECT contenido_msg,fecha_hora FROM mensajería WHERE id_origen = '$idorig' AND id_destinatario = '$iddestino'";
          $resultEnviados = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));



          $sql = "SELECT contenido_msg,fecha_hora FROM mensajería WHERE id_origen = '$iddestino' AND id_destinatario = '$idorig'";
          $resultRecibidos = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

              echo "ENVIADOS: ";

                if($resultEnviados->num_rows > 0){
                     while($fila = $resultEnviados->fetch_assoc()){
                    echo "<p>"  .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. "</p>";
                      }
                  }
                else{
                     echo "No hay mensajes";
                  }

              echo "RECIBIDOS: ";

               if($resultRecibidos->num_rows > 0){
                     while($fila = $resultRecibidos->fetch_assoc()){
                    echo "<p>" .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. "</p>";
                      }
                  }
                else{
                  echo "No hay mensajes";
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
