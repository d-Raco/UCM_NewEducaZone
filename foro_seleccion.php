<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Clases.php';
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
      <h1>Selecciona foro</h1>
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      echo "<div class='w3-container'><ul class=\"w3-ul\">";

      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);
        $usuario->getPadre();
        $result = $usuario->getHijos();
        while($row = $result->fetch_assoc()){
          echo '<li>
                <a href="foro.php?idClase=' .$row["id_clase"]. '">Foro a la clase de ' .$row["nombre"]. '.</a><br>
          </li>';
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
          echo '<li>
                <a href="foro.php?idClase=' .$row["id"]. '">Foro a la clase ' .$row["curso"]. 'º ' .$row["letra"]. ' ' .$row["titulación"]. '.</a>
          </li>';
        }
      }
      echo "</div>";
      ?>
    </div>

    <?php
    if($_SESSION['rol'] == "padre"){
      //include("include/comun/sidebarDerPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      //include("include/comun/sidebarDerProfesor.php");
    }
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
