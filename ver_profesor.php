<?php
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/vista_usuario.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
   <div class ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div class="flex_contenido">
     <?php

        $profesor = new Profesor();
        $dao_profesor = new DAO_Profesor();

        if ($_SESSION['rol'] == "profesor"){
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        }
        else{
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_GET["profesor"]))));
          $id_padre = htmlspecialchars(trim(strip_tags($_GET["tutor"])));
        }

        $dao_profesor->getProfe($profesor);
        $filaCentro = $dao_profesor->getCentro2($profesor->getIdCentro());
        $filaDespacho = $profesor->getDespacho();
        $filaCorreo = $profesor->getCorreo();
        $filaAsignaturas = $dao_profesor->getAsignaturas($profesor->getId());

        echo "<div class='flex_info'>
          <br><h1>".$profesor->getNombre(). " " .$profesor->getAp1(). " " .$profesor->getAp2()."</h1>";
        echo "</div>";


        echo "<div class='flex_funciones'>
          <div class = 'column1'>
            <div class = 'flex_informacion'>
              <div class = 'detalles'>
                <h4>Detalles del usuario</h4>
                Correo: " .$filaCorreo. "<br>
                Despacho: " .$filaDespacho. "<br>
                Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", id:".$profesor->getUsuario()." " .$filaCentro["provincia"]. ")<br>";
              echo "</div>";
              echo "<div class = 'asignaturas'>";
                echo "<h4>Asignaturas </h4>";
                $filaAsignaturas = $dao_profesor->getAsignaturas($profesor->getId());
                while($asignatura = $filaAsignaturas->fetch_assoc()){
                  echo "<ul>".$asignatura["nombre_asignatura"]."</ul>";
                }
              echo "</div>";
            echo "</div>";
            echo "<div class='funciones'>";
              if ($_SESSION['rol'] == "profesor"){
                //Editar perfil
                echo "<div class='editarperfil'><a href=\"Editar_profesor.php?\"><img class='clase_imagen' src='./img/editarperfil.png' alt='logo' height='150' width='150'><a><br>
                <a href = Editar_profesor.php>Editar Perfil</a></div>";
                echo "<div class='msg'><a href=\"mensajeriaClases.php\"><img class='clase_imagen' src='./img/mensajeria.png' alt='logo' height='150' width='150'></a><br>
                <a href= mensajeriaClases.php>Mensajeria</a></div>";
                // Foro
                echo "<div class='foro'><a href=\"foro_seleccion.php\"><img class='clase_imagen' src='./img/foro.png' alt='logo' height='150' width='150'></a><br>
                <a href= foro_seleccion.php>Foro</a></div>";
                //clases
                echo "<div class='clase'><a href=\"cursos.php\"><img class='clase_imagen' src='./img/clase.png' alt='logo' height='150' width='150'></a><br>
                <a href= cursos.php>Clases</a></div>";
                //horario
                echo "<div class='horario'><a href=\"horario_profesor.php\"><img class='clase_imagen' src='./img/horario.png' alt='logo' height='150' width='150'></a><br>
                <a href= horario_profesor.php>Horario</a></div>";
                 //calendario
                echo "<div class='calendario'><a href=\"calendario.php\"><img class='clase_imagen' src='./img/calendario.png' alt='logo' height='150' width='150'></a><br>
                <a href= calendario.php>Calendario</a></div>";
              }
              else{
                //Mensajeria
                echo '<div class="msg">
                <form name="myform" action="mensajeria.php" method="POST">
                  <input type="hidden" name="tutor" value="' .$id_padre. '">
                  <input type="hidden" name="profesor" value="' .$profesor->getId(). '">
                  <button type="submit">
                    <img class="clase_imagen" src="./img/mensajeria.png" alt="logo" height="150" width="150"><br>
                    Nuevo Mensaje
                  </button>
                </form><br>
                </div>';
              }
            echo "</div>";//funciones
          echo "</div>";//columna1
        echo "</div>";
	   ?>
    </div>
   </div>
  </body>
</html>
