<?php
  require_once('include/DAOProfe.php');
  require_once('include/DAOClases.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
      if (!isset($_SESSION['login']) || ($_SESSION['rol'] != 'profesor')){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
      <h1>Clases</h1>
      <?php
        $pdao = new ProfeDao();
        $p = $pdao->getProfe($_SESSION['name']);

        $cdao = new ClasesDAO();
        $result = $cdao->getAsignaturas($p->getId());
        while($fila = $result->fetch_assoc()){
          $id_asignatura = $fila["id"];
          $c = $cdao->getClase($id_asignatura);
          echo "<p><a href=\"ver_clase.php?id=" .$c->getId(). "\">" .$c->getCurso(). "º " .$c->getTitul(). " " .$c->getLetra(). "</a> (".$fila["nombre_asignatura"].", Número de alumnos: " .$c->getNAlum(). ")</p>";
        }




      ?>
    </div>

    <?php
      include("include/comun/sidebarDerProfesor.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
