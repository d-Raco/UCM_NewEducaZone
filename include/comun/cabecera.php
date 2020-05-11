<?php
  require_once __DIR__ . '/../dao/Padre.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/cabecera.css">
  </head>
  <body>
      <nav class="menu">
        <div class="header">
          <a href="./index.php" class="logo"><img class="logo" src="./img/logo2.png" alt="logo" height="50" width="50"></a>
          <a href="./index.php" class ="titulo">EDUCAZONE</a>

          <div class="header-right">
            <a class="op" href="./index.php">Home</a>
              <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {

                  if($_SESSION['rol'] == "padre"){
                    $padre = new Padre();
                    $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
                    $padre->getPadre();
                    $result = $padre->getHijos();

                    echo  "<div class='dropdown' style='float:right;'><button class='dropbtn'>".$_SESSION['name']."</button><div class='dropdown-content'>";
                    while($hijo = $result->fetch_assoc()){
                      echo "<a href=\"ver_alumno.php?id=".$hijo["DNI"]."\">".$hijo["nombre"]." ".$hijo["apellido1"]." ".$hijo["apellido2"]."</a><br>";
                    }
                    echo "<a href=\"logout.php\">Logout</a><br></div></div>";
                  }
                  else{
                    echo  "<div class='dropdown' style='float:right;'><button class='dropbtn'>".$_SESSION['name']."</button><div class='dropdown-content'>";
                    echo  "<a href='logout.php'>Logout</a><br></div></div>";
                  }
                } 
                else {
                  echo "<a href='login.php' class =\"op\">Login</a> <a href='signin.php' class =\"op\">Registro</a>";
                }
              ?>
          </div>
        </div>
      </nav>
  </body>
</html>
