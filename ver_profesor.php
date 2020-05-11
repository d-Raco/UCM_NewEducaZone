<?php
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profesor</title>
    <link rel="stylesheet" type="text/css" href="css/VerPadreyProfe.css">
  </head>
  <body>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div id="contenido">
       <div class="cuadradoInfo">
      <?php
        $profesor = new Profesor();

        if ($_SESSION['rol'] == "profesor"){
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $profesor->getProfe();
        }
        else{
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_GET["profesor"]))));
          $id_padre = htmlspecialchars(trim(strip_tags($_GET["tutor"])));
          $profesor->getProfe();
          echo "<img src=\"" .$profesor->getFoto(). "\"  width=\"150\" height=\"150\">";
        }

        echo "<h1>".$profesor->getNombre(). " " .$profesor->getAp1(). " " .$profesor->getAp2()."</h1>";
        echo "<p>Colegio: " .$profesor->getCentro(). ".</p>";
        echo "<p>Despacho: " .$profesor->getDespacho(). ".</p>";
        echo "<p>Correo: " .$profesor->getCorreo(). ".</p>";
        echo "<p>Asignaturas: </p>";
        $result = $profesor->getAsignaturas();

        while($asig = $result->fetch_assoc()){
          echo "<ol>".$asig["nombre_asignatura"]."</ol>";
        }

        if ($_SESSION['rol'] == "padre"){
          $msg = NULL;
          echo "<p><a href=\"mensajeria.php?tutor=".$id_padre."&profesor=".$profesor->getId()."&contenido_msg=".$msg."\">Enviar mensaje</a></p>";
        }
         ?>
    </div>
            <div class="cuadrados">
        <div class="cuadrado">
        <h1><a href = "Editar_padre.php">Editar Perfil</a></h1>
        <p>Modifica tu perfil para conocer todos tus datos.</p>
        </div>

       <div class="cuadrado">
        <h1><a href = "foro_seleccion.php">Foro</a></h1>
        <p>Comparte historias, fotos y buenos recuerdos de las actividades con el colegio.</p>
       </div>

      <div class="cuadrado">
        <h1><a href = "mensajeriaClases.php">Mensajeria</a></h1>
        <p>Intercambia mensajes y archivos con los profesores para mantenerte informado de todo lo necesario sobre las clases de tu hijo.</p>
      </div>

    </div>

      <div class="cuadrados2">
        <div class="cuadrado">
        <h1><a href = "horario_profesor.php">Horario</a></h1>
        <p>Consulta el horario de tus clases de cada semana.</p>
        </div>

       <div class="cuadrado">
        <h1><a href = "cursos.php">Cursos</a></h1>
        <p>Accede a la información de los cursos, clases y alumnos del colegio.</p>
       </div>

      <div class="cuadrado">
        <h1>Calendario</a></h1>
        <p>Revisa tus eventos en el calendario mensual.</p>
      </div>
      
    </div>
  </div>
</div>
    <?php


      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarDerProfesor.php");
      }
      else{
        include("include/comun/sidebarDerPadre.php");
      }
      include("include/comun/pie.php");


    ?>
   </div>
  </body>
</html>
