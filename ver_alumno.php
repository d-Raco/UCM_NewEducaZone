<?php
require_once __DIR__ . '/include/dao/Alumno.php';
  require_once __DIR__ . '/include/dao/Profesor.php';
  require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alumno</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
  <div id ="alumno">
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
      <?php
        $id = htmlspecialchars(trim(strip_tags($_GET["id"])));
        $alumno = new Alumno();
        $a = $alumno->getAlumno($id);

        echo "<h1>".$a->getNombre(). " " .$a->getAp1(). " " .$a->getAp2()."</h1>";
        echo "<img src=\"" .$a->getFoto(). "\"  width=\"150\" height=\"150\">";
        echo "<p>Fecha de nacimiento: " .$a->getFecha(). ".</p>";
        echo "<p>DNI: " .$a->getDNI(). ".</p>";
        echo "<p>Clase: </p>";

        $filaClase = $a->getClase($a->getIdClase());
        echo "<p><a href=\"ver_clase.php?id=" .$filaClase["id"]. "\">" .$filaClase["curso"]. " " .$filaClase["titulación"]. " " .$filaClase["letra"]. "</a></p>";

        echo "<p><a href=\"horario_alumno.php?id=" .$a->getNombre(). "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "\">Horario de la clase</a></p>";

        $filaCentro = $a->getCentro($a->getIdCentro());
        echo "<p>Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", " .$filaCentro["provincia"]. ").</p>";

        $filaTutor = $a->getTutor($a->getTutor());
        echo "<p>Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. ". Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").</p>";

        echo "<p>Observaciones médicas: " .$a->getOM(). ".</p>";

        if($_SESSION['rol'] == "padre"){
          echo "<p><a href=\"ver_calificaciones_padre.php?id=" .$a->getCal(). "\">Calificaciones</a></p>";
          echo "<p><a href=\"incidencias_padre.php?id=".$a->getDNI()."\">Incidencias</a></p>";

          echo "<p>Profesores: </p>";
          $result = $a->getProfesores($a->getIdClase());
          while($filaAsignatura = $result->fetch_assoc()){
            $filaProfesor = $a->getProfe($filaAsignatura['id_profesor']);
            echo "<ol><a href=\"ver_profesor.php?profesor=" .$filaProfesor['usuario']. "&tutor=" .$a->getTutor(). "\">     " .$filaProfesor["nombre"]. " " .$filaProfesor["apellido1"]. " " .$filaProfesor["apellido2"]. " (" .$filaAsignatura["nombre_asignatura"]. ")</a></ol>";
          }
        }
        elseif($_SESSION['rol'] == "profesor"){
          $pdao = new ProfeDAO();
          $p = $pdao->getProfe(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $msg = NULL;

          echo "<ol><a href=\"ver_calificaciones_profesor.php?idAl=" .$a->getDNI(). "&idAsignatura=&notaNueva=\">Calificaciones</a></ol>";
          echo "<ol><a href=\"mensajeria.php?tutor=".$a->getTutor()."&profesor=".$p->getId()."&contenido_msg=".$msg."\">Enviar un mensaje</a></ol>";
          echo "<ol><a href=\"incidencias_asignaturas.php?alumno=".$a->getDNI()."&profesor=".$p->getId()."\">Incidencias</a></ol>";
        }
      ?>
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
