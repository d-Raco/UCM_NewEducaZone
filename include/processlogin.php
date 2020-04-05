<?php
  require_once('config.php');
  require_once('DAOPadre.php');
  require_once('DAOProfe.php');

  $username = $_REQUEST["usuario"];
  $contraseña = $_REQUEST["contraseña"];

  $pdao = new PadreDao();

  $usuario = $pdao->getPadre($username);

  if(!is_null($usuario)){ //PADRE
    if($contraseña == $usuario->getContraseña()){
        $_SESSION['login'] = TRUE;
        $_SESSION['name'] = $username;
        $_SESSION['rol'] = 'padre';
        header("Location: ../ver_padre.php");
    }
  }
  else{ //PROFE
    $pdao = new ProfeDAO();
    $usuario = $pdao->getProfe($username);
    if(!is_null($usuario)){
      echo $usuario->getContraseña();
      if($contraseña == $usuario->getContraseña()){
        $_SESSION['login'] = TRUE;
        $_SESSION['name'] = $username;
        $_SESSION['rol'] = 'profesor';
        header("Location: ../ver_profesor.php");
      }
    }
    else{
      echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
    }
  }

?>