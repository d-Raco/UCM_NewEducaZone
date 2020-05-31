<?php
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/config.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Padre</title>
    <link rel="stylesheet" type="text/css" href="css/vista_usuario.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>

  <body>
    <div class="padre">
      <?php
        if (!isset($_SESSION['login'])){
          $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
          echo "<script>window.open('".$url."','_self');</script>";
          //header("Location: ./login.php");
          //exit;
        }
        include("include/comun/cabecera.php");
        include("include/comun/sidebarIzqPadre.php");
      ?>
      <div class="flex_contenido">
        <?php
          $padre = new Padre();
          $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $dao_padre = new DAO_Padre();
          $dao_padre->getPadre($padre);

          $filaTelmovil = $padre->getMovil();
          $filaTelfijo = $padre->getFijo();
          $filaCorreo = $padre->getCorreo();
          $filaHijos = $dao_padre->getHijos($padre);


          echo "<div class='flex_info'>
            <br><h1>".$padre->getNombre(). " " .$padre->getAp1(). " " .$padre->getAp2()."</h1>
          </div>";

          echo "<div class='flex_funciones'>
            <div class = 'column1'>
              <div class = 'informacion'>
                <h4>Detalles del usuario</h4>
                Correo: " .$filaCorreo."<br>
                Teléfono Movil: " .$filaTelmovil."<br>
                Teléfono Fijo: " .$filaTelfijo."<br>";

                while($hijo = $filaHijos->fetch_assoc()){
                 echo " <ol><a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">" .$hijo["nombre"]. " " .$hijo["apellido1"]. " " .$hijo["apellido2"]. "</a></ol> ";
                }
              echo "</div>";

              echo "<div class = 'funciones'>
                <div class='editarperfil'><a href=\"Editar_padre.php?\"><img class='clase_imagen' src='./img/editarperfil.png' alt='logo' height='150' width='150'><a><br>
                <a href = Editar_padre.php>Editar Perfil</a></div>

                <div class='msg'><a href=\"padre_msgnuevo.php\"><img class='clase_imagen' src='./img/mensajeria.png' alt='logo' height='150' width='150'></a><br>
                <a href= mensajeriaClases.php>Mensajeria</a></div>

                <div class='foro'><a href=\"foro_seleccion.php\"><img class='clase_imagen' src='./img/foro.png' alt='logo' height='150' width='150'></a><br>
                <a href= foro_seleccion.php>Foro</a></div>

                <div class='calendario'><a href=\"calendario.php\"><img class='clase_imagen' src='./img/calendario.png' alt='logo' height='150' width='150'></a><br>
                <a href= calendario.php>Calendario</a></div>";
              echo "</div>";
            echo "</div>";

            echo "<div class = 'column2'>";
              echo "<div class = 'hijos'>";
                echo "<h4>Hijos</h4>";
                echo "<div class = 'imagenes_hijos'>";
                  $filaHijos = $dao_padre->getHijos($padre);
                  while($hijo = $filaHijos->fetch_assoc()){
                    echo "<img class='clase_imagen' src=\"" .$hijo["foto"]. "\"  width=\"150\" height=\"150\"><br>";
                    echo "<a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">".$hijo["nombre"]."</a><br><br>";
                  }
                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        ?>
      </div>
   </div>
  </body>
</html>
