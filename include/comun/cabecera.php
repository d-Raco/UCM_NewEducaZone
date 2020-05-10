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
            <a class="active" href="./index.php">Home</a>
              <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {

                  if($_SESSION['rol'] == "padre"){
                    echo  "<a href='ver_padre.php' class =\"op\">".$_SESSION['name']."</a>";
                  }
                  else{
                    echo  "<a href='ver_profesor.php' class =\"op\">".$_SESSION['name']."</a>";
                  }

                  echo  "<a href='logout.php' class =\"op\">Logout</a>";

                } else {
                  echo "<a href='login.php' class =\"op\">Login</a> <a href='signin.php' class =\"op\">Registro</a>";
                }
              ?>
          </div>
        </div>
      </nav>
  </body>
</html>
