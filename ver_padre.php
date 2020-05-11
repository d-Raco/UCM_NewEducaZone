<?php
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/config.php';
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
        $padre = new Padre();
        $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $padre->getPadre();

        echo "<h1>".$padre->getNombre(). " " .$padre->getAp1(). " " .$padre->getAp2()."</h1>";
        echo "<p>Correo electrónico: " .$padre->getCorreo(). ".</p>";
        echo "<p>Teléfono móvil: " .$padre->getMovil(). ".</p>";
        echo "<p>Teléfono fijo: " .$padre->getFijo(). ".</p>";

        echo "<p>Hijos: </p>";

        $result = $padre->getHijos();

        while($hijo = $result->fetch_assoc()){
          echo "<div class=\"imagen_hijo\"><img src=\"" .$hijo["foto"]. "\"  width=\"150\" height=\"150\"><br><a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">" .$hijo["nombre"]. " " .$hijo["apellido1"]. " " .$hijo["apellido2"]. "</a><div>";
        }
      ?>
        <div id="Editar">

      <form method="post">
        <input type="submit" name="Edit" value="EDITAR">
      </form>

    </div>
</div>
    </div>

    <?php
      if(isset($_POST["Edit"])){
        include("EditarPadre.php");
      }
    ?>
   </div>
  </body>
</html>
