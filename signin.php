<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Signin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <div id="signin">       
        <form method="get" action="include/process_signin.php">
            Nombre del tutor/a legal:   
          <input type="text" name="nombre" />
          <br>  
            Primer apellido del tutor/a legal: 
          <input type="text" name="apellido1" />
          <br>
            Segundo apellido del tutor/a legal: 
          <input type="text" name="apellido2" />
          <br>
            Teléfono móvil: 
          <input type="text" name="movil" />
          <br>
            Teléfono fijo: 
          <input type="text" name="telefono" />
          <br>
            Correo electrónico: 
          <input type="text" name="correo" />
          <br>
            Usuario: 
          <input type="text" name="usuario" />
          <br>
            Contraseña: 
          <input type="password" name="contraseña1" />
          <br>
            Repita la contraseña: 
          <input type="password" name="contraseña2" />
          <br>
            Código de acceso:
          <input type="password" name="codigo" />
          <br>
          <input type="submit" value="Enviar">
        </form>
      </div>
  </body>
</html>