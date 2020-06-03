<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./css/sidebarIzq.css">
  </head>
  <body>
    <?php
	  header("Cache-Control: no cache");
	  session_cache_limiter("private_no_expire");
      $admin = new Admin();
      $admin->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
      $dao_admin = new DAO_Admin();
      $dao_admin->getAdmin($admin);
    

    echo
    "<div class='sidebar'>
      <img src='".$admin->getFoto()."'  width=\"200\" height=\"200\">

      <div class='dropdown_sidebar'>
        <a class='dropbtn_sidebar'>".$_SESSION['name']."</a>
      </div>
      <a href='admin_profesor.php'>Añadir Profesor</a>
      <a href='admin_alumno.php'>Añadir Alumno</a>
         <a href='admin_borrarP.php'>Borrar Alumno/Profesor</a>
	  <div class='back'>
		<img src='img/back-button-64-64.png' onclick='goBack()'></img>
	  </div>
    </div>";
    ?>

  </body>
</html>
