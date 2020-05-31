<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Selecciona foro</title>
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
      <h1>Selecciona foro</h1>
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      echo "<div class='w3-container'><ul class=\"w3-ul\">";

      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);

        $dao_usuario = new DAO_Padre();
        $dao_usuario->getPadre($usuario);

        $result = $dao_usuario->getHijos($usuario);
        while($row = $result->fetch_assoc()){
          echo '<li>
                <a href="foro.php?idClase=' .$row["id_clase"]. '">Foro a la clase de ' .$row["nombre"]. '</a><br>
          </li>';
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $usuario = new Profesor();
        $usuario->setUsuario($username);
        $dao_usuario = new DAO_Profesor();
        $dao_usuario->getProfe($usuario);

        $clases = new Clases();
        $clases->setIdTutor($usuario->getId());
        $dao_clases = new DAO_Clases();
        $result = $dao_clases->getClaseByTutor($usuario->getId());

        while($row = $result->fetch_assoc()){
          echo '<li>
                <a href="foro.php?idClase=' .$row["id"]. '">Foro a la clase ' .$row["curso"]. 'º ' .$row["letra"]. ' ' .$row["titulacion"]. '</a>
          </li>';
        }
      }
      echo "</div>";
      ?>
    </div>

    <?php
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
