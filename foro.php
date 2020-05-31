<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/dao/DAO_Entradas_Foro.php';
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
         $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
         echo "<script>window.open('".$url."','_self');</script>";
         //header("Location: ./login.php");
         //exit;
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
        $dao_usuario = new DAO_Padre();
        $dao_usuario->getPadre($usuario);

        $result = $dao_usuario->getHijos($usuario);
        while($row = $result->fetch_assoc()){
          if($row["id_clase"] === $idClase){
            $bien = TRUE;
          }
        }
      }
      elseif($_SESSION['rol'] == "profesor"){
        $usuario = new Profesor();
        $usuario->setUsuario($username);
        $dao_usuario = new DAO_Profesor();
        $dao_usuario->getProfe($usuario);

        $clases = new Clases();
        $dao_clases = new DAO_Clases();
        $clases->setIdTutor($usuario->getId());
        $result = $dao_clases->getClaseByTutor($usuario->getId());
        while($row = $result->fetch_assoc()){
          if($row["id"] === $idClase){
            $bien = TRUE;
          }
        }
      }

      if($bien){
        $clase = new Clases();
        $clase->setId($idClase);
        $dao_clase = new DAO_Clases();
        $dao_clase->getClaseById($clase);
        echo '<h1>Foro de la clase ' .$clase->getCurso(). 'º ' .$clase->getLetra(). ' ' .$clase->getTitul(). '</h1>';
        echo '<form action="foro_crea.php" method="post">
              <input type="hidden" name="idClase" value="'.$idClase.'">
              <input type="submit" name="submit" value="Crear entrada en el foro">
        </form>';

        echo "<div class='w3-container'><ul class=\"w3-ul\">";
        $foro = new Entradas_foro();
        $foro->setIdClase($idClase);
        $dao_foro = new DAO_Entradas_foro();
        $result = $dao_foro->getEntradasForoByClase($clase);

        if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            if($row["rol_creador"] === "padre"){
              $padre = new Padre();
              $padre->setId($row["id_creador"]);
              $dao_padre = new DAO_Padre();
              $dao_padre->getPadreById($padre);
              echo '<li>
                    <a href="foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$padre->getNombre(). ' ' .$padre->getAp1(). ' ' .$padre->getAp2(). ' (Padre) ' .$row["titulo_foro"]. ' </a><br>
              </li>';
            }
            else if($row["rol_creador"] === "profesor"){
              $profesor = new Profesor();
              $profesor->setId($row["id_creador"]);
              $dao_profesor = new DAO_Profesor();
              $dao_profesor->getProfesorById($profesor);
              echo '<li>
                    <a href="foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$row["id"]. '">' .$row["fecha"]. ' ' .$profesor->getNombre(). ' ' .$profesor->getAp1(). ' ' .$profesor->getAp2(). ' (Profesor) ' .$row["titulo_foro"]. ' </a><br>
              </li>';
            }
          }
        }
        else{
          echo("No hay entradas en el foro.");
        }
        echo "</ul></div>";
      }
      else{
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }
      ?>
    </div>

    <?php
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
