<?php
require_once __DIR__ . '/include/dao/DAO_Alumno.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Incidencias.php';
require_once __DIR__ . '/include/dao/DAO_Calificaciones.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alumno</title>
    <link rel="stylesheet" type="text/css" href="css/vista_usuario.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <div class="flex_contenido">
      <?php
        $alumno = new Alumno();
        $alumno->setDNI(htmlspecialchars(trim(strip_tags($_GET["id"]))));
        $dao_alumno = new DAO_Alumno();
        $dao_alumno->getAlumno($alumno);

        $filaCentro = $dao_alumno->getCentro($alumno->getIdCentro());
        $filaTutor = $dao_alumno->getTutor($alumno->getIdTutor());
        $filaClase = $dao_alumno->getClase($alumno->getIdClase());

        echo "<div class='flex_info'>";
          echo "<div><img src=\"" .$alumno->getFoto(). "\"  width=\"150\" height=\"150\"></div>
          <div><h1>".$alumno->getNombre(). " " .$alumno->getAp1(). " " .$alumno->getAp2()."</h1></div>";
        echo "</div>";

        echo "<div class='flex_funciones'>
        <div class = 'column1'>
          <div class = 'informacion'>
            <h4>Información del alumno</h4>
            Fecha de nacimiento: " .$alumno->getFecha(). ".<br>
            DNI: " .$alumno->getDNI(). ".<br>
            Colegio: " .$filaCentro["nombre"]. " (" .$filaCentro["direccion"]. ", " .$filaCentro["provincia"]. ").<br>";
            if(!is_null($filaTutor)){
              echo "Tutor legal: " .$filaTutor["nombre"]. " " .$filaTutor["apellido1"]. " " .$filaTutor["apellido2"]. ".<br>Datos de contacto: móvil (" .$filaTutor["telefono_movil"]. "), fijo (" .$filaTutor["telefono_fijo"]. "), mail (" .$filaTutor["correo"]. ").<br>";
            }
            if(!is_null($alumno->getOM())){
              echo "Observaciones médicas: ".$alumno->getOM().".";
            }
          echo "</div>";
          echo "<div class = funciones>
            <div class='clase'><a href='ver_clase.php?id=" .$filaClase["id"]. "&nombre=".$alumno->getNombre()."&ap1=".$alumno->getAp1()."&ap2=".$alumno->getAp2()."'><img class='clase_imagen' src='./img/clase.png' alt='logo' height='150' width='150'><a><br>
            <a href='ver_clase.php?id=" .$filaClase["id"]. "&nombre=".$alumno->getNombre()."&ap1=".$alumno->getAp1()."&ap2=".$alumno->getAp2()."'>" .$filaClase["curso"]. " " .$filaClase["titulacion"]. " " .$filaClase["letra"]. "</a></div>

            <div class='horario'><a href='horario_alumno.php?id=" .$alumno->getNombre(). "&id1=" .$filaClase["id_asignatura1"]. "&id2=". $filaClase["id_asignatura2"]. "&id3=" .$filaClase["id_asignatura3"]. "&id4=" .$filaClase["id_asignatura4"]. "&id5=" .$filaClase["id_asignatura5"]. "&id6=" .$filaClase["id_asignatura6"]. "'><img class='clase_imagen' src='./img/horario.png' alt='logo' height='150' width='150'></a><br>
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
              //PROFESORES
              $DNI = $alumno->getDNI();
              echo "<div class='profes'><a href=\"lista_profesores.php?idAlumno=".$DNI."\"><img class='clase_imagen' src='./img/profes.png' alt='logo' height='150' width='150'></a><br>
              <a>Profesores</a></div></div>";
            }
            elseif($_SESSION['rol'] == "profesor"){
              $profesor = new Profesor();
              $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
              $dao_profesor = new DAO_Profesor();
              $dao_profesor->getProfe($profesor);
              $msg = NULL;

              //CALIFICACIONES
              echo "<div class='cal'><a href=\"ver_calificaciones_profesor.php?idAl=" .$alumno->getDNI(). "&idAsignatura=" .$msg. "&notaNueva=" .$msg. "\"><img class='clase_imagen' src='./img/cali.png' alt='logo' height='150' width='150'></a><br>
              <a href=\"ver_calificaciones_profesor.php?idAl=" .$alumno->getDNI(). "&idAsignatura=" .$msg. "&notaNueva=" .$msg. "\">Calificaciones</a></div>";
              //INCIDENCIAS
              echo "
              <div class='incidencias'>
                <a href=\"incidencias_asignaturas.php?alumno=".$alumno->getDNI()."&profesor=".$profesor->getId()."\">
                  <img class='clase_imagen' src='./img/incidencias.png' alt='logo' height='150' width='150'>
                </a><br>
                <a href=\"incidencias_asignaturas.php?alumno=".$alumno->getDNI()."&profesor=".$profesor->getId()."\">
                  Incidencias
                </a>
              </div>";
              //MENSAJERIA
              $_POST["tutor"] = $alumno->getIdTutor();
              $_POST["profesor"] = $profesor->getId();
              echo "<div class='msg'><a href=\"mensajeria.php\"><img class='clase_imagen' src='./img/mensajeria.png' alt='logo' height='150' width='150'></a><br>
              <a href=\"mensajeria.php?tutor=".$alumno->getIdTutor()."&profesor=".$profesor->getId()."&contenido_msg=".$msg."\">Mensajeria</a></div></div>";
            }
          echo "</div>";

          echo "<div class = column2>";

            $profe = new Profesor();
            $profe->setId($filaClase["id_tutor_clase"]);
            $dao_profe = new DAO_Profesor();
            $dao_profe->getProfesorById($profe);
            echo "<div class='tutor'>
              <h4>Tutor de ".$filaClase["curso"]." ".$filaClase["letra"]." ".$filaClase["titulacion"].":</h4>
              <a href='ver_profesor.php?profesor=" .$profe->getUsuario(). "&tutor=" .$alumno->getIdTutor(). "''>
                <img  class='imag' src='".$profe->getFoto()."' height=40px width=40px> ".$profe->getNombre()." ".$profe->getAp1()." ".$profe->getAp2()."
              </a></div>";

            echo "<div class = 'incidencia_info'>";
              echo "<h4>Últimas incidencias:</h4>";
              $inc = new DAO_Incidencias();
              echo $inc->getUltimaIncidencia($alumno->getDNI()).
            "</div>";

            echo "<div class = 'media'>";
              $cal = new DAO_Calificaciones();
              echo "<h4>Media del curso:</h4>";
              echo $cal->notaMedia($alumno->getDNI()).
            "</div>";

            echo "<div class = 'clase_actual'>";
              echo "<h4>Clase actual:</h4>";
              $asignatura = $dao_alumno->claseActual($alumno);
              if($asignatura == null){
                echo 'No hay ninguna clase a esta hora.';
              }
              else{
                echo $asignatura["nombre"]. ' (' .$asignatura["hora_ini"]. '-' .$asignatura["hora_fin"]. ')';
              }
            "</div>";

            echo "<div class = 'prox_clase'>";
              echo "<h4>Próxima clase:</h4>";
              $asignatura = $dao_alumno->proxClase($alumno);
              echo $asignatura["nombre"]. ' (' .$asignatura["dia"]. ' ' .$asignatura["hora_ini"]. '-' .$asignatura["hora_fin"]. ')';
            "</div>";
          echo "</div>";
        echo "</div>";
      ?>

    </div>

   </div>
  </body>
</html>
