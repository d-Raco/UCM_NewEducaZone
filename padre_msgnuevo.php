<?php
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/dao/DAO_Alumno.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajeria_Padres</title>
    <link rel="stylesheet" type="text/css" href="css/mensajeriaAlumnos.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
  </head>
  <body>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");

    ?>
    <div class="contenido" style = "margin-left: 230px; margin-top:100px;">
      <?php
        $padre = new Padre();
        $dao_padre = new DAO_Padre();

        $alumno = new Alumno();
        $dao_alumno = new DAO_Alumno();

        $clase = new Clases();
        $dao_clase = new DAO_Clases();

        $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $dao_padre->getPadre($padre);
        $rsHijos = $dao_padre->getHijos($padre);

        echo "<h1>Selecciona el profesor con el que quiere contactar</h1>";

        if($rsHijos->num_rows > 0){
          while($filaAlumno = $rsHijos->fetch_assoc()){
            echo "<div class='msgHijo'><h3>Profesores de ".$filaAlumno['nombre']. " " .$filaAlumno['apellido1']. " " .$filaAlumno['apellido2']. ":</h3>";

            $alumno->setIdClase($filaAlumno["id_clase"]);
            $filaClase = $dao_alumno->getClase($alumno->getIdClase());
            $clase->setId($filaClase["id"]);
            $clase->setAs1($filaClase["id_asignatura1"]);
            $clase->setAs2($filaClase["id_asignatura2"]);
            $clase->setAs3($filaClase["id_asignatura3"]);
            $clase->setAs4($filaClase["id_asignatura4"]);
            $clase->setAs5($filaClase["id_asignatura5"]);
            $clase->setAs6($filaClase["id_asignatura6"]);
            $asignaturas = $dao_clase->getAsignaturaProfesor($clase);
            echo "<div class='w3-container'><ul class=\"w3-ul\">";
            foreach($asignaturas as &$values){

              echo '<li><form name="myform" action="mensajeria.php" method="POST">
                <input type="hidden" name="tutor" value="' .$padre->getId(). '">
                <input type="hidden" name="profesor" value="' .$values['id']. '">
                <button class="botonTutor" type="submit">'.$values['nombre'].' '.$values['apellido1'].' '.$values['apellido2'].' ('.$values['nombre_asignatura'].')</button>
              </form></li>';
            }
            echo "</ul></div></div>";
          }
        }
      ?>
    </div>

    <?php
      //include("include/comun/sidebarDerPadre.php");
    ?>
   </div>
  </body>
</html>
