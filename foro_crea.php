<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/FormularioForo.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foro</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
    include("include/comun/cabecera.php");
    if($_SESSION['rol'] == "padre"){
      include("include/comun/sidebarIzqPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      include("include/comun/sidebarIzqProfesor.php");
    }
    ?>
    <div id="contenido">
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      $idClase = $_REQUEST["idClase"];
      $bien = 0;
      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);
        $usuario->getPadre();
        $result = $usuario->getHijos();
        while($row = $result->fetch_assoc()){
          if($row["id_clase"] === $idClase){
            $bien = 1;
          }
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $usuario = new Profesor();
        $usuario->setUsuario($username);
        $usuario->getProfe();
        $clases = new Clases();
        $clases->setIdTutor($usuario->getId());
        $result = $clases->getClaseByTutor();
        while($row = $result->fetch_assoc()){
          if($row["id"] === $idClase){
            $bien = 1;
          }
        }
      }

      if($bien){
        $form = new FormularioForo(htmlspecialchars(trim(strip_tags($_POST["idClase"]))));
        $form->gestiona();
      }
      else{
        //header("Location: ./login.php");
      }
      ?>
    </div>

    <?php
    if($_SESSION['rol'] == "padre"){
      include("include/comun/sidebarDerPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      include("include/comun/sidebarDerProfesor.php");
    }
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
