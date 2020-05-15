<?php
  require_once __DIR__ . '/../dao/Padre.php';
    require_once __DIR__ . '/../dao/Profesor.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/cabecera.css">
  </head>
  <body>
        <div class="header">

          <img class='logo' src='./img/logo/e2.png' alt='logo' height='80' width='480'>

          <div class="header-right">
            <a href="./index.php" class ="op">Inicio</a>
            <a href="./contact_us.php" class ="op">Contact us</a>
            <a href="./faqs.php" class ="op">FAQ's</a>
              <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {

                  if($_SESSION['rol'] == "padre"){
                    $padre = new Padre();
                    $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
                    $padre->getPadre();
                    $result = $padre->getHijos();
                    echo "<div class='user_flex'>";
                    echo "<div class='dropdown' style='float:right;'><button onclick=\"window.location.href='ver_padre.php'\" class='dropbtn'>".$_SESSION['name']." <img  class='imag' src='".$padre->getFoto()."' height=40px width=40px></button><div class='dropdown-content'>";


                    while($hijo = $result->fetch_assoc()){
                      echo "<a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">".$hijo["nombre"]." ".$hijo["apellido1"]." ".$hijo["apellido2"]."</a><br>";
                    }
                    echo "<a href=\"logout.php\">Logout</a><br></div></div>";
                    echo "</div>";
                  }
                  else{
                    $profesor = new Profesor();
                    $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION['name']))));
                    $profesor->getProfe();
                    echo "<div class='user_flex'>";
                    echo  "<div class='dropdown' style='float:right;'>
                    <button onclick=\"window.location.href='ver_profesor.php'\" class='dropbtn' style='align-text=center;'>".$_SESSION['name']." <img  class='imag' src='".$profesor->getFoto()."' height=40px width=40px></button><div class='dropdown-content'>";
                      echo  "<a href='logout.php'>Logout</a><br></div></div>";

                    echo "</div>";
                  }
                }
                else {
                  echo "<a href='login.php' class =\"op\">Login</a> <a href='signin.php' class =\"op\">Registro</a>";
                }
              ?>
          </div>
        </div>
  </body>
</html>
