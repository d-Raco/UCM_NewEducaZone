<?php
require_once __DIR__ . '/include/dao/DAO_Clases.php';
require_once __DIR__ . '/include/dao/DAO_Padre.php';
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mensajería alumnos</title>
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="css/mensajeriaAlumnos.css">
  </head>
  <body>
    <?php
       if (!isset($_SESSION['login']) || $_SESSION['rol'] != 'profesor'){
         $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
         echo "<script>window.open('".$url."','_self');</script>";
         //header("Location: ./login.php");
         //exit;
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div class="contenido" style = "margin-left: 230px;">
      <h1>Destinatario</h1>
      <?php
        $clase = new Clases();
        $clase->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
        $dao_p = new DAO_Padre();
        $dao_clase = new DAO_Clases();
        $rs = $dao_clase->getAlumnos($clase->getId());

        if($rs->num_rows > 0){
          $i = 1;
          echo '<div class="w3-container"><ul class="w3-ul">';
          while($fila = $rs->fetch_assoc()){
            $padre = new Padre();
            $padre->setId($fila["id_tutor_legal"]);
            $dao_p->getPadreById($padre);
            echo '<li>';
            if($padre->getId() !== null) {
              echo '<form name="myform" action="mensajeria.php" method="POST">
                <input type="hidden" name="tutor" value="' .$padre->getId(). '">
                <input type="hidden" name="profesor" value="' .htmlspecialchars(trim(strip_tags($_GET["profesor"]))). '">
                <img src="' .$padre->getFoto(). '" class="w3-circle" style="width:50px">
                <button class="botonTutor" type="submit">' .$i. '. ' .$padre->getNombre(). ' ' .$padre->getAp1(). ' ' .$padre->getAp2(). '</button>
                <p>&emsp;&emsp;&emsp;&emsp;<img src="' .$fila["foto"]. '" class="w3-circle" style="width:50px">
                Tutor legal de ' .$fila["nombre"]. ' ' .$fila["apellido1"]. ' ' .$fila["apellido2"]. '</p>
                </form>';
            }
            else{
              echo '<img src="' .$padre->getFoto(). '" class="w3-circle" style="width:50px">
                <span style="color:grey;">' .$i. '. No hay un tutor legal registrado para el alumno ' .$fila["nombre"]. ' ' .$fila["apellido1"]. ' ' .$fila["apellido2"]. '</span>
                <p>&emsp;&emsp;&emsp;&emsp;<img src="' .$fila["foto"]. '" class="w3-circle" style="width:50px">
                Tutor legal de ' .$fila["nombre"]. ' ' .$fila["apellido1"]. ' ' .$fila["apellido2"]. '</p>';
            }
            echo '</li>';
            $i = $i + 1;
          }
          echo '</div>';
        }
        else{
          echo "No hay clases con id " .htmlspecialchars(trim(strip_tags($_GET["id"])));
        }
      ?>
    </div>
   </div>
  </body>
</html>
