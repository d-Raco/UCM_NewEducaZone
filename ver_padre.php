<?php
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/config.php';
 require_once __DIR__ . '/include/FormularioEditarPadre.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Padre</title>
    <link rel="stylesheet" type="text/css" href="css/VerPadreyProfe.css">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  </head>
  
  <body>
    <div class="padre">
      <?php
        if (!isset($_SESSION['login'])){
          header("Location: ./login.php");
        }
        include("include/comun/cabecera.php");
        include("include/comun/sidebarIzqPadre.php");
      ?>
      <div class="contenido">
        <div class ="info_flex">
          <div class="cuadradoInfo">
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
                echo "<h1><ol><a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">" .$hijo["nombre"]. " " .$hijo["apellido1"]. " " .$hijo["apellido2"]. "</a></ol></h1>";
              }
            ?>
          </div>
        </div>

         <div class="cuadrados">
          <div class="cuadrado">
            <h1><a href = "Editar_padre.php">Editar Perfil</a></h1>
            <p>Modifica tu perfil para conocer todos tus datos.</p>
          </div>

          <div class="cuadrado">
            <h1><a href = "foro_seleccion.php">Foro</a></h1>
            <p>Comparte historias, fotos y buenos recuerdos de las actividades con el colegio.</p>
          </div>

          <div class="cuadrado">
            <h1><a href = "Editar_padre.php">Mensajeria</a></h1>
            <p>Intercambia mensajes y archivos con los profesores para mantenerte informado de todo lo necesario sobre las clases de tu hijo.</p>
          </div>
        </div>
      </div>
    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
