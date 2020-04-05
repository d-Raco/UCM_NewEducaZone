<?php
  require_once('config.php');
  require_once('DAOPadre.php');

  $codigo = $_REQUEST["codigo"];
  $contraseña1 = $_REQUEST["contraseña1"];
  $contraseña2 = $_REQUEST["contraseña2"];

  if($contraseña1 == $contraseña2){

    $p = new Padre(NULL, $_REQUEST["nombre"], $_REQUEST["apellido1"], $_REQUEST["apellido2"], $_REQUEST["movil"], $_REQUEST["telefono"], $_REQUEST["correo"], $_REQUEST["usuario"], $_REQUEST["contraseña1"]);

    $pdao = new PadreDao();

    $pdao->inserta($p);

    echo "Nuevo registro creado.";
    echo "<a href=\"../login.php\">Login</a>";
  }
  else{
    echo "Las contraseñas no coinciden";
  }

?>
