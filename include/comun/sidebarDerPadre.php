<?php
  require_once __DIR__ . '/../dao/Padre.php';

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Detalles</title>
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">
  </head>
  <body>
    <div id="sidebarDer">
     <ul><a href="ver_padre.php">Inicio</a></ul><br>

      <?php
        $pdao = new Padre();
        $p = $pdao->getPadre(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $result = $pdao->getHijos($p->getId());

        while($hijo = $result->fetch_assoc()){
          echo "<ul><img src=\"" .$hijo["foto"]. "\"  width=\"150\" height=\"150\"><ul>";
          echo "<ul><a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">".$hijo["nombre"]."</a><br><br>";
        }
      ?>
    </div>

  </body>
</html>
