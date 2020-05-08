<?php
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería alumnos</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login']) || $_SESSION['rol'] != 'profesor'){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <h1>Destinatario</h1>
      <?php
        $cdao = new ClasesDAO();
        $rs = $cdao->getAlumnos(htmlspecialchars(trim(strip_tags($_GET["id"]))));

        if($rs->num_rows > 0){
          $i = 1;
          $contenido_msg = NULL;
          while($fila = $rs->fetch_assoc()){
            echo "<p><a href=\"mensajeria.php?tutor=".$fila["id_tutor_legal"]."&profesor=".htmlspecialchars(trim(strip_tags($_GET["profesor"])))."&contenido_msg=".$contenido_msg."\">" .$i. ". Tutor legal de " .$fila["nombre"]. " " .$fila["apellido1"]. " " .$fila["apellido2"]. "</a></p>";
            $i = $i + 1;
          }
        }
        else{
          echo "No hay clases con id " .htmlspecialchars(trim(strip_tags($_GET["id"])));
        }
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
