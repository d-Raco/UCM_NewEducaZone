<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Padre.php';
require_once __DIR__ . '/dao/Profesor.php';

  $username = htmlspecialchars(trim(strip_tags($_REQUEST["usuario"])));
  $contraseña = htmlspecialchars(trim(strip_tags($_REQUEST["contraseña"])));

  $pdao = new Padre();
  $usuario = $pdao->getPadre($username);
  $prdao = new Profesor();
  $pusuario = $prdao->getProfe($username);

  if(!is_null($usuario)){ //PADRE
    if($contraseña == $usuario->getContraseña()){
        $_SESSION['login'] = TRUE;
        $_SESSION['name'] = $username;
        $_SESSION['rol'] = 'padre';
        header("Location: ../ver_padre.php");
    }
    else{
      echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
    }
  }
  else if(!is_null($pusuario)){ //PROFE
   // echo $pusuario->getContraseña();
    if($contraseña == $pusuario->getContraseña()){
      $_SESSION['login'] = TRUE;
      $_SESSION['name'] = $username;
      $_SESSION['rol'] = 'profesor';
      header("Location: ../ver_profesor.php");
    }
    else{
      echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
    }
  }
  else{
    echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
  }


?>
