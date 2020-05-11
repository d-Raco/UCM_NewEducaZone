<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/dao/Entradas_foro.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foro</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
    include("include/comun/cabecera.php");
    if($_SESSION['rol'] == "padre"){
      include("include/comun/sidebarIzqPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      include("include/comun/sidebarIzqProfesor.php");
    }
    ?>
    <div id="contenido">
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      $idClase = $_REQUEST["idClase"];
      $bien = 0;
      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);
        $usuario->getPadre();
        $result = $usuario->getHijos();
        while($row = $result->fetch_assoc()){
          if($row["id_clase"] === $idClase){
            $bien = 1;
          }
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $usuario = new Profesor();
        $usuario->setUsuario($username);
        $usuario->getProfe();
        $clases = new Clases();
        $clases->setIdTutor($usuario->getId());
        $result = $clases->getClaseByTutor();
        while($row = $result->fetch_assoc()){
          if($row["id"] === $idClase){
            $bien = 1;
          }
        }
      }

      if($bien){
        $clase = new Clases();
        $clase->setId($idClase);
        $clase->getClaseById();
        echo '<h1>Foro de la clase ' .$clase->getCurso(). 'º ' .$clase->getLetra(). ' ' .$clase->getTitul(). '</h1>';
        echo '<form action="foro_crea.php" method="post">
              <input type="hidden" name="idClase" value="'.$idClase.'">
              <input type="submit" name="submit" value="Crear entrada en el foro">
        </form>';

        $foro = new Entradas_foro();
        $foro->setIdClase($idClase);
        $result = $foro->getEntradasForoByClase();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            if($row["rol_creador"] === "padre"){
              $padre = new Padre();
              $padre->setId($row["id_creador"]);
              $padre->getPadreById();
              echo '<a href="foro_entrada.php?idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$row["nombre"]. ' ' .$row["apellido1"]. ' ' .$row["apellido2"]. ' (Padre) ' .$row["titulo_foro"]. ' </a>';
            }
            else if($row["rol_creador"] === "profesor"){
              $profesor = new Profesor();
              $profesor->setId($row["id_creador"]);
              $profesor->getProfesorById();
              echo '<a href="foro_entrada.php?idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$row["nombre"]. ' ' .$row["apellido1"]. ' ' .$row["apellido2"]. ' (Profesor) ' .$row["titulo_foro"]. ' </a>';
            }
          }
        }
        else{
          echo("No hay entradas en el foro.");
        }
      }
      else{
        header("Location: ./login.php");
      }
      ?>
    </div>

    <?php
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
