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
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <div class="contenido" style = "margin-left: 230px;">
      <?php
      $username = htmlspecialchars(trim(strip_tags($_SESSION['name'])));
      $idClase = htmlspecialchars(trim(strip_tags($_REQUEST["idClase"])));
      $bien = FALSE;
      if($_SESSION['rol'] == "padre"){
        $usuario = new Padre();
        $usuario->setUsuario($username);
        $usuario->getPadre();
        $result = $usuario->getHijos();
        while($row = $result->fetch_assoc()){
          if($row["id_clase"] === $idClase){
            $bien = TRUE;
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
            $bien = TRUE;
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

        echo "<div class='w3-container'><ul class=\"w3-ul\">";
        $foro = new Entradas_foro();
        $foro->setIdClase($idClase);
        $result = $foro->getEntradasForoByClase();
        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            if($row["rol_creador"] === "padre"){
              $padre = new Padre();
              $padre->setId($row["id_creador"]);
              $padre->getPadreById();
              echo '<li>
                    <a href="foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$padre->getNombre(). ' ' .$padre->getAp1(). ' ' .$padre->getAp2(). ' (Padre) ' .$row["titulo_foro"]. ' </a><br>
              </li>';
            }
            else if($row["rol_creador"] === "profesor"){
              $profesor = new Profesor();
              $profesor->setId($row["id_creador"]);
              $profesor->getProfesorById();
              echo '<li>
                    <a href="foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$profesor->getNombre(). ' ' .$profesor->getAp1(). ' ' .$profesor->getAp2(). ' (Profesor) ' .$row["titulo_foro"]. ' </a><br>
              </li>';
            }
          }
        }
        else{
          echo("No hay entradas en el foro.");
        }
        echo "</div>";
      }
      else{
        header("Location: ./login.php");
      }
      ?>
    </div>

    <?php
    if($_SESSION['rol'] == "padre"){
      //include("include/comun/sidebarDerPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      //include("include/comun/sidebarDerProfesor.php");
    }
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
