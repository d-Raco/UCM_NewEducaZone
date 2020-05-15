<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/sidebarIzq.css">
  </head>
  <body>
    <?php
      $padre = new Padre();
      $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
      $padre->getPadre();
      $result = $padre->getHijos();

    echo
    "<div class='sidebar'>
      <img src='./img/usuario.png'  width=\"200\" height=\"200\">

      <div class='dropdown_sidebar'>
        <a class='dropbtn_sidebar'>".$_SESSION['name']."</a>
        <div class='dropdown-content_sidebar'>";
          while($hijo = $result->fetch_assoc()){
            echo "<a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">".$hijo["nombre"]." ".$hijo["apellido1"]." ".$hijo["apellido2"]."</a><br>";
          }
          echo "</a><br>
        </div>
      </div>
      <a href='ver_padre.php'>Mis datos</a>
      <a href='padre_msgnuevo.php'>Mis mensajes</a>
      <a href='foro_seleccion.php'>Foro</a>
      <a href='calendario.php'>Calendario</a>
    </div>";
    ?>

  </body>
</html>
