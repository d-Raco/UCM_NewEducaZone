<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/FormularioForo.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Crea un foro</title>
    <link rel="stylesheet" type="text/css" href="css/foro.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login'])){
         $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
         echo "<script>window.open('".$url."','_self');</script>";
         //header("Location: ./login.php");
         //exit;
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
    <div class="contenido" style = "margin-left: 230px;">
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      $idClase = htmlspecialchars(trim(strip_tags($_REQUEST["idClase"])));
      $bien = FALSE;
      $id = null;
      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);
        $dao_usuario = new DAO_Padre();
        $dao_usuario->getPadre($usuario);
        $id = $usuario->getId();
        $result = $dao_usuario->getHijos($usuario);
        while($row = $result->fetch_assoc()){
          if($row["id_clase"] === $idClase){
            $bien = TRUE;
          }
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $usuario = new Profesor();
        $usuario->setUsuario($username);
        $dao_usuario = new DAO_Profesor();
        $dao_usuario->getProfe($usuario);
        $id = $usuario->getId();

        $clases = new Clases();
        $clases->setIdTutor($usuario->getId());
        $dao_clases = new DAO_Clases();
        $result = $dao_clases->getClaseByTutor($id);
        while($row = $result->fetch_assoc()){
          if($row["id"] === $idClase){
            $bien = TRUE;
          }
        }
      }

      if($bien){
        $form = new FormularioForo(htmlspecialchars(trim(strip_tags($_POST["idClase"]))), htmlspecialchars(trim(strip_tags($id))), htmlspecialchars(trim(strip_tags($_SESSION['rol']))));
        $form->gestiona();
      }
      else{
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }
      ?>
    </div>

   </div>
  </body>
</html>
