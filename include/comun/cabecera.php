<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
  </head>
  <body>
    <div id="cabecera">
      <nav class="menu">

      <div id="logo">
        <a href="./index.php"><img class="logo" src="./img/logo2.png" alt="logo" ></a>
      </div>
        <div class="saludo">
        <?php
          if (isset($_SESSION['login'])){
            if($_SESSION['rol'] == 'padre'){
              print "<a href=\"./ver_padre.php\">" .$_SESSION['name']. "</a>";
            }
            elseif($_SESSION['rol'] == 'profesor'){
              print "<a href=\"./ver_profesor.php\">" .$_SESSION['name']. "</a>";
            }
            ?>
            <div class="logout">
              <a href='./logout.php'>Logout</a>
            </div>

            <?php
          }
          else{
            print "Usuario desconocido";
            ?>
              <div class="logout">
                <a href='./signin.php'>Sign in</a>
                <ol><a href='./login.php'>Login</a></ol>
              </div>
            <?php
          }
        ?>
        </div>

      </nav>
    </div>
  </body>
</html>
