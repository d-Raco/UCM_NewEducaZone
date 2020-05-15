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
        $padre = new Padre();
        $alumno = new Alumno();
        $clase = new Clases();

        $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $padre->getPadre();
        $rsHijos = $padre->getHijos();
        ?>
        <div class="bloque">
          <div class="container">
            <?php
        echo "<h1>Mensaje Nuevo</h1>";
                ?>
              </div>
            </div>
        <?php
        if($rsHijos->num_rows > 0){
          while($filaAlumno = $rsHijos->fetch_assoc()){
            ?>
            <div class="bloque">
              <div class="container">
                <?php
            echo "<h2>Profesores de ".$filaAlumno['nombre']. " " .$filaAlumno['apellido1']. " " .$filaAlumno['apellido2']. ":</h2>";
                    ?>
                  </div>
                </div>
            <?php
            $alumno->setIdClase($filaAlumno["id_clase"]);
            $filaClase = $alumno->getClase();
            $clase->setId($filaClase["id"]);
            $clase->setAs1($filaClase["id_asignatura1"]);
            $clase->setAs2($filaClase["id_asignatura2"]);
            $clase->setAs3($filaClase["id_asignatura3"]);
            $clase->setAs4($filaClase["id_asignatura4"]);
            $clase->setAs5($filaClase["id_asignatura5"]);
            $clase->setAs6($filaClase["id_asignatura6"]);
            $asignaturas = $clase->getAsignaturaProfesor();
            foreach($asignaturas as &$values){
              ?>
              <div class="bloque">
                <div class="container">
                  <?php
              echo '<form name="myform" action="mensajeria.php" method="POST">
                <input type="hidden" name="tutor" value="' .$padre->getId(). '">
                <input type="hidden" name="profesor" value="' .$values['id']. '">
                <button type="submit">'.$values['nombre'].' '.$values['apellido1'].' '.$values['apellido2'].' ('.$values['nombre_asignatura'].')</button>
              </form>';
                    ?>
                  </div>
                </div>
            <?php
            }
          }
        }
      ?>
    </div>

    <?php
      //include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
