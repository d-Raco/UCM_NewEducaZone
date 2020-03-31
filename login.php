<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <div id="login">

        <form method="get" action="include/processlogin.php">
            Usuario:   
          <input type="text" name="usuario" />
          <br>
            Contraseña:
          <input type="password" name="contraseña" />
          <br>
          <input type="submit" value="Enviar">
        </form>
      </div>
  </body>
</html>