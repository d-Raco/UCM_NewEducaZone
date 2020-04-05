<?php
  require_once('include/DAOPadre.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Padre</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="alumno">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
    ?>
    <div id="contenido">
      <?php
        $pdao = new PadreDAO();
        $p = $pdao->getPadre($_SESSION['name']);

        echo "<h1>".$p->getNombre(). " " .$p->getAp1(). " " .$p->getAp2()."</h1>";
        echo "<p>Correo electrónico: " .$p->getCorreo(). ".</p>";
        echo "<p>Teléfono móvil: " .$p->getMovil(). ".</p>";
        echo "<p>Teléfono fijo: " .$p->getFijo(). ".</p>";

        echo "<p>Hijos: </p>";

        $result = $pdao->getHijos($p->getId());

        while($hijo = $result->fetch_assoc()){
          echo "<ol><a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">" .$hijo["nombre"]. " " .$hijo["apellido1"]. " " .$hijo["apellido2"]. "</a></ol>";
        }  
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
