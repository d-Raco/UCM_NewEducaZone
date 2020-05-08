<?php
  require_once __DIR__ . '/config.php';
  require_once __DIR__ . '/dao/Padre.php';

  $codigo = htmlspecialchars(trim(strip_tags($_REQUEST["codigo"])));
  $contraseña1 = htmlspecialchars(trim(strip_tags($_REQUEST["contraseña1"])));
  $contraseña2 = htmlspecialchars(trim(strip_tags($_REQUEST["contraseña2"])));

  if($contraseña1 == $contraseña2){

    $p = new Padre(NULL, htmlspecialchars(trim(strip_tags($_REQUEST["nombre"]))), htmlspecialchars(trim(strip_tags($_REQUEST["apellido1"]))), htmlspecialchars(trim(strip_tags($_REQUEST["apellido2"]))), htmlspecialchars(trim(strip_tags($_REQUEST["movil"]))), htmlspecialchars(trim(strip_tags($_REQUEST["telefono"]))), htmlspecialchars(trim(strip_tags($_REQUEST["correo"]))), htmlspecialchars(trim(strip_tags($_REQUEST["usuario"]))), $contraseña1);

    $p->inserta($p);

    echo "Nuevo registro creado.";
    echo "<a href=\"../login.php\">Login</a>";
  }
  else{
    echo "Las contraseñas no coinciden";
  }

?>
