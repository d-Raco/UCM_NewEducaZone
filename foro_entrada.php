<?php
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/dao/DAO_Profesor.php';
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/dao/DAO_Entradas_Foro.php';
require_once __DIR__ . '/include/dao/DAO_Archivos_foro.php';
require_once __DIR__ . '/include/FormularioComentariosForo.php';
require_once __DIR__ . '/include/dao/DAO_Comentarios_foro.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Foro</title>
    <link rel="stylesheet" type="text/css" href="css/foro.css">
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

      //Comprueba que puede acceder al foro
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

        $dao_clases = new DAO_Clases();
        $result = $dao_clases->getClaseByTutor($usuario->getId());
        while($row = $result->fetch_assoc()){
          if($row["id"] === $idClase){
            $bien = TRUE;
          }
        }
      }

      if($bien){
        $idEntrada = htmlspecialchars(trim(strip_tags($_REQUEST["idEntrada"])));
        $entrada = new Entradas_foro();
        $dao_entrada = new DAO_Entradas_foro();
        $entrada->setId($idEntrada);
        $entrada->setIdClase($idClase);
        $dao_entrada->getEntradaForoByClaseAndId($entrada);

        if($entrada->getId() != 0){
          //Imprime la entrada
          echo '<br><div class="divForo">';

          echo '<h1 style="color:#4CAF50;">' .$entrada->getTituloForo(). '</h1>
                <p>' .$entrada->getContenido(). '</p>';

          //Imprime archivos
          $archivos = new Archivos_foro();
          $archivos->setIdForo($idEntrada);
          $dao_archivos = new DAO_Archivos_foro();
          $result = $dao_archivos->getArchivos($archivos);
          if($result->num_rows > 0){
            echo '<div id="divArchivos">';
            while($fila = $result->fetch_assoc()){
              $archivo = new DAO_Archivos_foro();
              $arch = new Archivos_foro();
              $arch->setId($fila["id"]);
              $archivo->getArchivoById($arch);
              if($arch->getTipoArchivo() == 'image/png' || $arch->getTipoArchivo() == 'image/jpeg'){
                echo '<span class="archivo"><a href="include/descargarArchivoForo.php?id=' .$fila["id"]. '"> <img class="imgArchivo" src="' .$arch->getArchivo(). '" width="100" height="100"><br>';
              }
              else{
                echo '<span class="archivo"><a class="enlace" href="include/descargarArchivoForo.php?id=' .$fila["id"]. '"> <img class="imgArchivo" src="img/file.png" width="100" height="100"><br>';
              }
              echo ' ' .$fila["nombre_archivo"]. '</a></span>';
            }
            echo '</div>';
          }

          //Imprime fecha y creador
          if($entrada->getRolCreador() === "padre"){
            $padre = new Padre();
            $padre->setId($entrada->getIdCreador());
            $dao_padre = new DAO_Padre();
            $dao_padre->getPadreById($padre);
            echo '<span class="fecha">' .$entrada->getFecha(). ' ' .$padre->getNombre(). ' ' .$padre->getAp1(). ' ' .$padre->getAp2(). ' (Padre)</span>';
          }
          else if($entrada->getRolCreador() === "profesor"){
            $profesor = new Profesor();
            $profesor->setId($entrada->getIdCreador());
            $dao_profesor = new DAO_Profesor();
            $dao_profesor->getProfesorById($profesor);
            echo '<span class="fecha">' .$entrada->getFecha(). ' ' .$profesor->getNombre(). ' ' .$profesor->getAp1(). ' ' .$profesor->getAp2(). ' (Profesor)</span>';
          }

          echo '</div>';

          //Generar comentario
          if($entrada->getPermisos()){
            echo '<div class="divForo">';
            if(($entrada->getRolCreador() != $_SESSION['rol']) || ($entrada->getIdCreador() != $usuario->getId())){
              $form = new FormularioComentariosForo($idClase, $idEntrada, 0, $usuario->getId(), $_SESSION['rol'], 0);
              $form->gestiona();
            }

            //Imprime comentarios
            $dao_comentarios = new DAO_Comentarios_foro();
            $result = $dao_comentarios->getComentarios($idEntrada);
            if($result->num_rows > 0){
              $pad = new Padre();
              $prof = new Profesor();
              while($row = $result->fetch_assoc()){

                echo '<div class="comentario">';
                echo '<h3>'.$row["titulo"]. '</h3>';
                echo '<p>' .$row["contenido_comentario"]. '</p>';
                if($row["rol_redactor"] == "padre"){
                  $pad->setId($row["id_redactor"]);
                  $dao_padre = new DAO_Padre();
                  $dao_padre->getPadreById($pad);
                  echo '<span class="fecha">'.$row["fecha"]. ' ' .$pad->getNombre(). ' ' .$pad->getAp1(). ' ' .$pad->getAp2(). ' (Padre)</span>';
                }
                else if($row["rol_redactor"] == "profesor"){
                  $prof->setId($row["id_redactor"]);
                  $dao_profe = new DAO_Profesor();
                  $dao_profe->getProfesorById($prof);
                  echo '<span class="fecha">' .$row["fecha"]. ' ' .$prof->getNombre(). ' ' .$prof->getAp1(). ' ' .$prof->getAp2(). ' (Profesor)</span>';
                }

                echo '<section id="A' .$row["id"]. '">';
                //Imprime botón de respuesta o formulario
                if(isset($_REQUEST["respuesta"]) && $_REQUEST["respuesta"] == $row["id"]){
                  echo '</div>';
                  $form = new FormularioComentariosForo($idClase, $row["id"], 1, $usuario->getId(), $_SESSION['rol'], $idEntrada);
                  $form->gestiona();
                }
                else{
                  if(($row["rol_redactor"] != $_SESSION['rol']) || ($row["id_redactor"] != $usuario->getId())){
                    echo'<a class="responder" href="./foro_entrada.php?idClase=' .$idClase. '&idEntrada=' .$idEntrada. '&respuesta=' .$row["id"]. '#A' .$row["id"]. '">Responder</a>';
                  }
                  echo '</div>';
                }
                echo '</section>';

                //Imprime respuestas
                $coment = new DAO_Comentarios_foro();
                $r = $coment->getReplies($row["id"]);
                if($r->num_rows > 0){
                  while($fila = $r->fetch_assoc()){
                    echo '<div class="replies">';
                    echo '<h3>'.$fila["titulo"]. '</h3>';
                    echo '<p>' .$fila["contenido_comentario"]. '</p>';
                    if($fila["rol_redactor"] == "padre"){
                      $dao_padre = new DAO_Padre();
                      $pad->setId($fila["id_redactor"]);
                      $dao_padre->getPadreById($pad);
                      echo '<span class="fecha">'.$fila["fecha"]. ' ' .$pad->getNombre(). ' ' .$pad->getAp1(). ' ' .$pad->getAp2(). ' (Padre)</span>';
                    }
                    else if($fila["rol_redactor"] == "profesor"){
                      $dao_profe = new DAO_Profesor();
                      $prof->setId($fila["id_redactor"]);
                      $dao_profe->getProfesorById($prof);
                      echo '<span class="fecha">' .$fila["fecha"]. ' ' .$prof->getNombre(). ' ' .$prof->getAp1(). ' ' .$prof->getAp2(). ' (Profesor)</span>';
                    }
                    echo '</div>';
                  }
                }
              }
            }
            else{
              echo "No hay ningún comentario en esta entrada.";
            }
            echo '</div>';
          }
        }
        else{
          echo "No hay ninguna entrada con id " .$idEntrada. " en la clase de id " .$idClase;
        }
      }
      else{
        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./login.php");
        //exit;
      }
      ?>
    </div>
   </div>
  </body>
</html>
