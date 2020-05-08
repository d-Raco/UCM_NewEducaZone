<?php
require_once __DIR__ . '/include/dao/Profesor.php';
  require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
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
      <?php
        $profesor = new Profesor();

        if ($_SESSION['rol'] == "profesor"){
          $p = $profesor->getProfe(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        }
        else{
          $usuarioProfe = htmlspecialchars(trim(strip_tags($_GET["profesor"])));
          $id_padre = htmlspecialchars(trim(strip_tags($_GET["tutor"])));
          $p = $profesor->getProfe($usuarioProfe);
          echo "<img src=\"" .$p->getFoto(). "\"  width=\"150\" height=\"150\">";
        }

        echo "<h1>".$p->getNombre(). " " .$p->getAp1(). " " .$p->getAp2()."</h1>";
        echo "<p>Colegio: " .$p->getCentro($p->getIdCentro()). ".</p>";
        echo "<p>Despacho: " .$p->getDespacho(). ".</p>";
        echo "<p>Correo: " .$p->getCorreo(). ".</p>";
        echo "<p>Asignaturas: </p>";
        $result = $p->getAsignaturas($p->getId());

        while($asig = $result->fetch_assoc()){
          echo "<ol>".$asig["nombre_asignatura"]."</ol>";
        }

        if ($_SESSION['rol'] == "padre"){
          $msg = NULL;
          echo "<p><a href=\"mensajeria.php?tutor=".$id_padre."&profesor=".$p->getId()."&contenido_msg=".$msg."\">Enviar mensaje</a></p>";
        }
          if ($_SESSION['rol'] == "profesor"){
      ?>



    <div id="Editar">

      <form method="post">
        <input type="submit" name="Edit" value="EDITAR">
      </form>

    </div>
    <?php
  }?>
</div>
    <?php


      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarDerProfesor.php");
         if(isset($_POST["Edit"])){
              include("EditarProfe.php");
            }
      }
      else{
        include("include/comun/sidebarDerPadre.php");
      }
      include("include/comun/pie.php");

           
    ?>
   </div>
  </body>
</html>
