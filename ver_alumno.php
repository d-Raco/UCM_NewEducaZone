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
    <link rel="stylesheet" type="text/css" href="css/alumno.css">
  </head>

  <body>
  <div class ="alumno">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
    <div class="contenido">
      <?php
        $alumno = new Alumno();
        $alumno->setDNI(htmlspecialchars(trim(strip_tags($_GET["id"]))));
        $alumno->getAlumno();

        $filaCentro = $alumno->getCentro();
        $filaTutor = $alumno->getTutor();
        $filaClase = $alumno->getClase();



        echo "<br><h1>".$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2()."</h1>";
        echo "<div class='info'><img src=\"" .$alumno->getFoto(). "\"  width=\"150\" height=\"150\">
        <p>Fecha de nacimiento: " .$alumno->getFecha(). ".</p>
        <p>DNI: " .$alumno->getDNI(). ".</p>
        <p>Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", " .$filaCentro["provincia"]. ").</p>";
        if(!is_null($filaTutor)){
          echo "<p>Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. ". Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").</p>";
        }
        

        if(!is_null($alumno->getOM())){
          echo "<p>Observaciones médicas: ".$alumno->getOM().".</p>";
        }
        echo "</div>";

        //CLASE 

        echo "<div class='flex-container'><div class='clase'><a href='ver_clase.php?id=" .$filaClase["id"]. "&nombre=".$alumno->getNombre()."&ap1=".$alumno->getAp1()."&ap2=".$alumno->getAp2()."'><img class='clase_imagen' src='./img/clase.png' alt='logo' height='150' width='150'><a><br>
        <a href='ver_clase.php?id=" .$filaClase["id"]. "&nombre=".$alumno->getNombre()."&ap1=".$alumno->getAp1()."&ap2=".$alumno->getAp2()."'>" .$filaClase["curso"]. " " .$filaClase["titulación"]. " " .$filaClase["letra"]. "</a></div>";

        // HORARIO 

        echo "<div class='horario'><a href='horario_alumno.php?id=" .$alumno->getNombre(). "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "'><img class='clase_imagen' src='./img/horario.png' alt='logo' height='150' width='150'></a><br>
        <a href='horario_alumno.php?id=" .$alumno->getNombre(). "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "'>Horario</a></div>";


        if($_SESSION['rol'] == "padre"){

          //CALIFICACIONES
          
          echo "<div class='cal'><a href='ver_calificaciones_padre.php?id=" .$alumno->getCal(). "'><img class='clase_imagen' src='./img/cali.png' alt='logo' height='150' width='150'></a><br>
          <a href='ver_calificaciones_padre.php?id=" .$alumno->getCal(). "'>Calificaciones</a></div>";

          //INCIDENCIAS

          echo "
          <div class='incidencias'>
            <a href=\"incidencias.php?idAlumno=".$alumno->getDNI()."\">
              <img class='clase_imagen' src='./img/incidencias.png' alt='logo' height='150' width='150'>
            </a><br>
            <a href=\"incidencias.php?idAlumno=".$alumno->getDNI()."\">Incidencias</a>
          </div>";
          
          $DNI = $alumno->getDNI();

          echo "<div class='profes'><a href=\"lista_profesores.php?idAlumno=".$DNI."\"><img class='clase_imagen' src='./img/profes.png' alt='logo' height='150' width='150'></a><br>
          <a>Profesores</a></div></div>";

        }
        elseif($_SESSION['rol'] == "profesor"){
          $profesor = new Profesor();
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $profesor->getProfe();
          $msg = NULL;

          //CALIFICACIONES
          echo "<div class='cal'><a href=\"ver_calificaciones_profesor.php?idAl=" .$alumno->getDNI(). "&idAsignatura=" .$msg. "&notaNueva=" .$msg. "\"><img class='clase_imagen' src='./img/cali.png' alt='logo' height='150' width='150'></a><br>
          <a href=\"ver_calificaciones_profesor.php?idAl=" .$alumno->getDNI(). "&idAsignatura=" .$msg. "&notaNueva=" .$msg. "\">Calificaciones</a></div>";
          

          echo "
          <div class='incidencias'>
            <a href=\"incidencias_asignaturas.php?alumno=".$alumno->getDNI()."&profesor=".$profesor->getId()."\">
              <img class='clase_imagen' src='./img/incidencias.png' alt='logo' height='150' width='150'>
            </a><br>
            <a href=\"incidencias_asignaturas.php?alumno=".$alumno->getDNI()."&profesor=".$profesor->getId()."\">
              Incidencias
            </a>
          </div>";

          echo "<div class='msg'><a href=\"mensajeria.php?tutor=".$alumno->getIdTutor()."&profesor=".$profesor->getId()."&contenido_msg=".$msg."\"><img class='clase_imagen' src='./img/mensajeria.png' alt='logo' height='150' width='150'></a><br>
          <a href=\"mensajeria.php?tutor=".$alumno->getIdTutor()."&profesor=".$profesor->getId()."&contenido_msg=".$msg."\">Mensajeria</a></div></div>";

        }
      ?>

    </div>
    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
