<?php
require_once __DIR__ . '/include/dao/DAO_Admin.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
   <div class ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'admin'){
        include("include/comun/sidebarIzqAdmin.php");
      }
    ?>
    <div class="contenido">
     <?php

        $admin = new Admin();
        $dao_admin = new DAO_Admin();

        if ($_SESSION['rol'] == "admin"){
          $admin->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        }


           //Nuevo Profesor

          echo "<div class='flex-container'>

          <div class='nuevoprofe'><a href=\"admin_profesor.php\"><img class='clase_imagen' src='./img/profenuevo.jpg' alt='logo' height='150' width='150'><a><br>
          <a href = admin_profesor.php?><p>Nuevo Profesor</p></a></div>";

        //nuevo alumno

          echo "<div class='nuevoAlumno'><a href=\"admin_alumno.php\"><img class='clase_imagen' src='./img/alumnosnuevo.png' alt='logo' height='150' width='150'></a><br>
            <a href= admin_alumnos.php?><p>Nuevo Alumno</p></a></div>";


          echo "<div class='nuevoAlumno'><a href=\"admin_borrarP.php\"><img class='clase_imagen' src='./img/borrado.jpg' alt='logo' height='150' width='150'></a><br>
          <a href= admin_borrarP.php?><p>Borrar alumno/profesor</p></a></div>";






	?>
    </div>
    
   </div>
   <?php
     include("include/comun/pie.php");
    ?>
  </body>
</html>
