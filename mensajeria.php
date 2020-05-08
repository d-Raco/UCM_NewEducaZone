<?php
require_once __DIR__ . '/include/dao/Mensajes.php';
  require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería</title>
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
        <p class="msg"> Escribe aquí tu mensaje: <br/>
        <input type="varchar" name="contenido_msg"></p>
        <input class="msg" type="submit" value="Submit">
      </form>

  <?php
      $mdao = new Mensajes();
      setlocale(LC_TIME,"es_ES");
      if($_SESSION['rol'] == 'profesor'){
        $idOrig = htmlspecialchars(trim(strip_tags($_REQUEST["profesor"])));
        $rolOrig = "profesor";
        $idDest = htmlspecialchars(trim(strip_tags($_REQUEST["tutor"])));
        $rolDest = "padre";
      }
      else if($_SESSION['rol'] == 'padre'){
        $idOrig = htmlspecialchars(trim(strip_tags($_REQUEST["tutor"])));
        $rolOrig = "padre";
        $idDest = htmlspecialchars(trim(strip_tags($_REQUEST["profesor"])));
        $rolDest = "profesor";
      }
      $m = new Mensajes($mdao->getNumMensajes()+1, $idOrig, $rolOrig, $idDest, $rolDest,htmlspecialchars(trim(strip_tags($_REQUEST["contenido_msg"]))), date('Y-m-d h:i:s'));
      // $tiempo = strftime("%D %H:%M:%S");

      if(htmlspecialchars(trim(strip_tags($_REQUEST["contenido_msg"]))) != ""){
        $mdao->insertMensaje($m);
      }

      $resultEnviados = $mdao->getMensajes($idOrig, $rolOrig, $idDest, $rolDest);
      $resultRecibidos = $mdao->getMensajes($idDest, $rolDest, $idOrig, $rolOrig);

      echo "<p>ENVIADOS:</p>";

      if($resultEnviados->num_rows > 0){
        while($fila = $resultEnviados->fetch_assoc()){
          echo "<p>"  .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. "</p>";
        }
      }
      else{
         echo "<p>No hay mensajes</p>";
      }

      echo "<p>RECIBIDOS:</p>";

      if($resultRecibidos->num_rows > 0){
        while($fila = $resultRecibidos->fetch_assoc()){
          echo "<p>" .$fila["fecha_hora"]. " " .$fila["contenido_msg"]. "</p>";
        }
      }
      else{
        echo "<p>No hay mensajes</p>";
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
