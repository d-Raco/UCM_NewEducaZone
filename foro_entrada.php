<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/Padre.php';
require_once __DIR__ . '/include/dao/Profesor.php';
require_once __DIR__ . '/include/dao/Clases.php';
require_once __DIR__ . '/include/dao/Entradas_foro.php';
require_once __DIR__ . '/include/dao/Archivos_foro.php';
require_once __DIR__ . '/include/FormularioComentariosForo.php';
require_once __DIR__ . '/include/dao/Comentarios_foro.php';
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
        $idEntrada = htmlspecialchars(trim(strip_tags($_REQUEST["idEntrada"])));
        $entrada = new Entradas_foro();
        $entrada->setId($idEntrada);
        $entrada->setIdClase($idClase);
        $entrada->getEntradaForoByClaseAndId();
        if($entrada->getId() != 0){
          if($entrada->getRolCreador() === "padre"){
            $padre = new Padre();
            $padre->setId($entrada->getIdCreador());
            $padre->getPadreById();
            echo '<h1>' .$entrada->getTituloForo(). '</h1>
                  <p>' .$entrada->getFecha(). ' ' .$padre->getNombre(). ' ' .$padre->getAp1(). ' ' .$padre->getAp2(). ' (Padre)</p>';
          }
          else if($entrada->getRolCreador() === "profesor"){
            $profesor = new Profesor();
            $profesor->setId($entrada->getIdCreador());
            $profesor->getProfesorById();
            echo '<h1>' .$entrada->getTituloForo(). '</h1>
                  <p>' .$entrada->getFecha(). ' ' .$profesor->getNombre(). ' ' .$profesor->getAp1(). ' ' .$profesor->getAp2(). ' (Profesor)</p>';
          }
          echo '<p>' .$entrada->getContenido(). '</p><br>';

          $archivos = new Archivos_foro();
          $archivos->setIdForo($idEntrada);
          $result = $archivos->getArchivos();
          if($result->num_rows > 0){
            while($fila = $result->fetch_assoc()){
              echo '<a href="include/descargarArchivoForo.php?id=' .$fila["id"]. '"> <img src="img/file.png" width="100" height="100">';
              echo ' ' .$fila["nombre_archivo"]. '</a><br>';
            }
          }

          if($entrada->getPermisos()){
            if(($entrada->getRolCreador() != $_SESSION['rol']) || ($entrada->getIdCreador() != $usuario->getId())){
              $form = new FormularioComentariosForo($idClase, $idEntrada, $usuario->getId(), $_SESSION['rol']);
              $form->gestiona();
            }
            $comentarios = new Comentarios_foro();
            $comentarios->setIdForo($idEntrada);
            $result = $comentarios->getComentarios();
            if($result->num_rows > 0){
              $pad = new Padre();
              $prof = new Profesor();
              while($row = $result->fetch_assoc()){
                echo '<div class="comentario">';
                echo '<h3>'.$row["titulo"]. '</h3>';
                if($row["rol_redactor"] == "padre"){
                  $pad->setId($row["id_redactor"]);
                  $pad->getPadreById();
                  echo '<p>'.$row["fecha"]. ' ' .$pad->getNombre(). ' ' .$pad->getAp1(). ' ' .$pad->getAp2(). '</p>';
                }
                else if($row["rol_redactor"] == "profesor"){
                  $prof->setId($row["id_redactor"]);
                  $prof->getProfesorById();
                  echo '<p>' .$row["fecha"]. ' ' .$prof->getNombre(). ' ' .$prof->getAp1(). ' ' .$prof->getAp2(). '</p>';
                }
                echo '<p>' .$row["contenido_comentario"]. '</p>';
                echo '</div>';
              }
            }
            else{
              echo "No hay ningún comentario en esta entrada.";
            }
          }
        }
        else{
          echo "No hay ninguna entrada con id " .$idEntrada. " en la clase de id " .$idClase;
        }
      }
      else{
        header("Location: ./login.php");
      }
      ?>
    </div>

    <?php
    if($_SESSION['rol'] == "padre"){
      include("include/comun/sidebarDerPadre.php");
    }
    elseif($_SESSION['rol'] == "profesor"){
      include("include/comun/sidebarDerProfesor.php");
    }
    include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
