<?php
require_once __DIR__ . '/include/dao/Padre.php';
  require_once __DIR__ . '/include/dao/Alumno.php';
  require_once __DIR__ . '/include/dao/Clases.php';
  require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajeria_Padres</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");

    ?>
    <div id="contenido">
      <?php
        $pdao = new Padre();
        $adao = new Alumno();
        $cdao = new Clases();

        $p = $pdao->getPadre(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $rsHijos = $p->getHijos($p->getId());
        echo "<h1>Mensaje Nuevo</h1>";
        if($rsHijos->num_rows > 0){
          while($filaAlumno = $rsHijos->fetch_assoc()){
            echo "<h2>Profesores de ".$filaAlumno['nombre']. " " .$filaAlumno['apellido1']. " " .$filaAlumno['apellido2']. ":</h2>";
            $filaClase = $adao->getClase($filaAlumno["id_clase"]);
            $c = new Clases($filaClase["id"], $filaClase["curso"], $filaClase["letra"], $filaClase["titulación"], $filaClase["id_tutor_clase"], $filaClase["numero_alumnos"], $filaClase["id_asignatura1"], $filaClase["id_asignatura2"], $filaClase["id_asignatura3"], $filaClase["id_asignatura4"], $filaClase["id_asignatura5"], $filaClase["id_asignatura6"]);
            $asignaturas = $cdao->getAsignaturaProfesor($c);
            foreach($asignaturas as &$values){
              echo "<ol><a href=\"mensajeria.php?tutor=".$p->getId()."&profesor=".$values['id']."&contenido_msg=\">".$values['nombre']." ".$values['apellido1']." ".$values['apellido2']." (".$values['nombre_asignatura'].")</a></ol>";
            }
          }
        }
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
