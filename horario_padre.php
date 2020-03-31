<?php
  require_once('include/config.php');
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
      if (!isset($_SESSION['login'])){
        header("Location: ./login.php");
      }
    ?>
   <div id ="profesor">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
    ?>
    <div id="contenido">
      <?php
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

        if ($conn->connect_error) {
          die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else{
          $conn->set_charset("utf8");
          $usuario = $conn->real_escape_string($_SESSION['name']);
          $sql = "SELECT id FROM tutor_legal WHERE usuario = '$usuario'";
          $result = $conn->query($sql)
              or die ($conn->error. " en la línea ".(__LINE__-1));

          if($result->num_rows > 0){
            $filaPadre = $result->fetch_assoc();
            $idPadre = $filaPadre["id"];

            $sql = "SELECT id_clase FROM alumnos WHERE id_tutor_legal = '$idPadre'";
            $result = $conn->query($sql)
                or die ($conn->error. " en la línea ".(__LINE__-1));

            if($result->num_rows > 0){
              $filaAlumno = $result->fetch_assoc();
              $idClase = $filaAlumno["id_clase"];

              $sql = "SELECT id_asignatura1, id_asignatura2, id_asignatura3, id_asignatura4, id_asignatura5, id_asignatura6 FROM clases WHERE id = '$idClase'";
              $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));

              if($result->num_rows > 0){
                $filaClase = $result->fetch_assoc();
                $id1 = $filaClase["id_asignatura1"];
                $id2 = $filaClase["id_asignatura2"];
                $id3 = $filaClase["id_asignatura3"];
                $id4 = $filaClase["id_asignatura4"];
                $id5 = $filaClase["id_asignatura5"];
                $id6 = $filaClase["id_asignatura6"];

                $sql = "SELECT * FROM asignaturas WHERE id = '$id1'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows > 0){
                  $a1 = $result->fetch_assoc();

                  $sql = "SELECT * FROM asignaturas WHERE id = '$id2'";
                  $result = $conn->query($sql)
                      or die ($conn->error. " en la línea ".(__LINE__-1));

                  if($result->num_rows > 0){
                    $a2 = $result->fetch_assoc();

                    $sql = "SELECT * FROM asignaturas WHERE id = '$id3'";
                    $result = $conn->query($sql)
                        or die ($conn->error. " en la línea ".(__LINE__-1));

                    if($result->num_rows > 0){
                      $a3 = $result->fetch_assoc();

                      $sql = "SELECT * FROM asignaturas WHERE id = '$id4'";
                      $result = $conn->query($sql)
                          or die ($conn->error. " en la línea ".(__LINE__-1));

                      if($result->num_rows > 0){
                        $a4 = $result->fetch_assoc();

                        $sql = "SELECT * FROM asignaturas WHERE id = '$id5'";
                        $result = $conn->query($sql)
                            or die ($conn->error. " en la línea ".(__LINE__-1));

                        if($result->num_rows > 0){
                          $a5 = $result->fetch_assoc();

                          $sql = "SELECT * FROM asignaturas WHERE id = '$id6'";
                          $result = $conn->query($sql)
                              or die ($conn->error. " en la línea ".(__LINE__-1));

                          if($result->num_rows > 0){
                            $a6 = $result->fetch_assoc();
                          }
                          else{
                            echo "No se encuentra ninguna asignatura en la base de datos con id " .$id6;
                          }
                        }
                        else{
                          echo "No se encuentra ninguna asignatura en la base de datos con id " .$id5;
                        }
                      }
                      else{
                        echo "No se encuentra ninguna asignatura en la base de datos con id " .$id4;
                      }
                    }
                    else{
                      echo "No se encuentra ninguna asignatura en la base de datos con id " .$id3;
                    }
                  }
                  else{
                    echo "No se encuentra ninguna asignatura en la base de datos con id " .$id2;
                  }
                }
                else{
                  echo "No se encuentra ninguna asignatura en la base de datos con id " .$id1;
                }
              }
              else{
                echo "No se encuentra ninguna clase en la base de datos con id " .$idClase;
              }
            }
            else{
              echo "No se encuentra ningún tutor legal en la base de datos con id " .$idPadre;
            }
          }
          else{
            echo "No se encuentra ningún perfil en la base de datos con usuario " .$usuario;
          }

          echo "<table>";
          echo "<tr>";
          echo "<th>Horas</th>";
          echo "<th>Lunes</th>";
          echo "<th>Martes</th>";
          echo "<th>Miércoles</th>";
          echo "<th>Jueves</th>";
          echo "<th>Viernes</th>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>9:00-10:00</td>";

          if($a1["lunes_inicio"] == 9){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 9){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 9){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 9){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 9){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 9){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 9){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 9){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 9){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 9){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 9){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 9){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 9){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 9){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 9){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 9){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 9){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 9){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 9){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 9){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 9){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 9){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 9){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 9){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 9){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 9){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 9){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 9){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 9){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 9){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>10:00-11:00</td>";

          if($a1["lunes_inicio"] == 10 || $a1["lunes_fin"] == 11){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 10 || $a2["lunes_fin"] == 11){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 10 || $a3["lunes_fin"] == 11){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 10 || $a4["lunes_fin"] == 11){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 10 || $a5["lunes_fin"] == 11){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 10 || $a6["lunes_fin"] == 11){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 10 || $a1["martes_fin"] == 11){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 10 || $a2["martes_fin"] == 11){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 10 || $a3["martes_fin"] == 11){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 10 || $a4["martes_fin"] == 11){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 10 || $a5["martes_fin"] == 11){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 10 || $a6["martes_fin"] == 11){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 10 || $a1["miercoles_fin"] == 11){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 10 || $a2["miercoles_fin"] == 11){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 10 || $a3["miercoles_fin"] == 11){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 10 || $a4["miercoles_fin"] == 11){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 10 || $a5["miercoles_fin"] == 11){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 10 || $a6["miercoles_fin"] == 11){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 10 || $a1["jueves_fin"] == 11){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 10 || $a2["jueves_fin"] == 11){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 10 || $a3["jueves_fin"] == 11){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 10 || $a4["jueves_fin"] == 11){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 10 || $a5["jueves_fin"] == 11){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 10 || $a6["jueves_fin"] == 11){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 10 || $a1["viernes_fin"] == 11){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 10 || $a2["viernes_fin"] == 11){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 10 || $a3["viernes_fin"] == 11){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 10 || $a4["viernes_fin"] == 11){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 10 || $a5["viernes_fin"] == 11){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 10 || $a6["viernes_fin"] == 11){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>11:00-12:00</td>";

          if($a1["lunes_inicio"] == 11 || $a1["lunes_fin"] == 12){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 11 || $a2["lunes_fin"] == 12){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 11 || $a3["lunes_fin"] == 12){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 11 || $a4["lunes_fin"] == 12){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 11 || $a5["lunes_fin"] == 12){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 11 || $a6["lunes_fin"] == 12){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 11 || $a1["martes_fin"] == 12){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 11 || $a2["martes_fin"] == 12){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 11 || $a3["martes_fin"] == 12){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 11 || $a4["martes_fin"] == 12){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 11 || $a5["martes_fin"] == 12){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 11 || $a6["martes_fin"] == 12){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 11 || $a1["miercoles_fin"] == 12){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 11 || $a2["miercoles_fin"] == 12){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 11 || $a3["miercoles_fin"] == 12){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 11 || $a4["miercoles_fin"] == 12){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 11 || $a5["miercoles_fin"] == 12){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 11 || $a6["miercoles_fin"] == 12){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 11 || $a1["jueves_fin"] == 12){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 11 || $a2["jueves_fin"] == 12){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 11 || $a3["jueves_fin"] == 12){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 11 || $a4["jueves_fin"] == 12){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 11 || $a5["jueves_fin"] == 12){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 11 || $a6["jueves_fin"] == 12){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 11 || $a1["viernes_fin"] == 12){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 11 || $a2["viernes_fin"] == 12){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 11 || $a3["viernes_fin"] == 12){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 11 || $a4["viernes_fin"] == 12){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 11 || $a5["viernes_fin"] == 12){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 11 || $a6["viernes_fin"] == 12){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>12:00-1:00</td>";

          if($a1["lunes_inicio"] == 12 || $a1["lunes_fin"] == 13){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 12 || $a2["lunes_fin"] == 13){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 12 || $a3["lunes_fin"] == 13){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 12 || $a4["lunes_fin"] == 13){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 12 || $a5["lunes_fin"] == 13){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 12 || $a6["lunes_fin"] == 13){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 12 || $a1["martes_fin"] == 13){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 12 || $a2["martes_fin"] == 13){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 12 || $a3["martes_fin"] == 13){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 12 || $a4["martes_fin"] == 13){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 12 || $a5["martes_fin"] == 13){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 12 || $a6["martes_fin"] == 13){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 12 || $a1["miercoles_fin"] == 13){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 12 || $a2["miercoles_fin"] == 13){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 12 || $a3["miercoles_fin"] == 13){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 12 || $a4["miercoles_fin"] == 13){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 12 || $a5["miercoles_fin"] == 13){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 12 || $a6["miercoles_fin"] == 13){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 12 || $a1["jueves_fin"] == 13){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 12 || $a2["jueves_fin"] == 13){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 12 || $a3["jueves_fin"] == 13){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 12 || $a4["jueves_fin"] == 13){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 12 || $a5["jueves_fin"] == 13){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 12 || $a6["jueves_fin"] == 13){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 12 || $a1["viernes_fin"] == 13){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 12 || $a2["viernes_fin"] == 13){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 12 || $a3["viernes_fin"] == 13){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 12 || $a4["viernes_fin"] == 13){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 12 || $a5["viernes_fin"] == 13){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 12 || $a6["viernes_fin"] == 13){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>1:00-2:00</td>";

          if($a1["lunes_inicio"] == 13 || $a1["lunes_fin"] == 14){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 13 || $a2["lunes_fin"] == 14){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 13 || $a3["lunes_fin"] == 14){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 13 || $a4["lunes_fin"] == 14){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 13 || $a5["lunes_fin"] == 14){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 13 || $a6["lunes_fin"] == 14){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 13 || $a1["martes_fin"] == 14){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 13 || $a2["martes_fin"] == 14){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 13 || $a3["martes_fin"] == 14){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 13 || $a4["martes_fin"] == 14){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 13 || $a5["martes_fin"] == 14){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 13 || $a6["martes_fin"] == 14){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 13 || $a1["miercoles_fin"] == 14){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 13 || $a2["miercoles_fin"] == 14){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 13 || $a3["miercoles_fin"] == 14){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 13 || $a4["miercoles_fin"] == 14){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 13 || $a5["miercoles_fin"] == 14){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 13 || $a6["miercoles_fin"] == 14){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 13 || $a1["jueves_fin"] == 14){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 13 || $a2["jueves_fin"] == 14){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 13 || $a3["jueves_fin"] == 14){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 13 || $a4["jueves_fin"] == 14){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 13 || $a5["jueves_fin"] == 14){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 13 || $a6["jueves_fin"] == 14){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 13 || $a1["viernes_fin"] == 14){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 13 || $a2["viernes_fin"] == 14){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 13 || $a3["viernes_fin"] == 14){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 13 || $a4["viernes_fin"] == 14){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 13 || $a5["viernes_fin"] == 14){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 13 || $a6["viernes_fin"] == 14){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>2:00-3:00</td>";

          if($a1["lunes_inicio"] == 14 || $a1["lunes_fin"] == 15){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 14 || $a2["lunes_fin"] == 15){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 14 || $a3["lunes_fin"] == 15){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 14 || $a4["lunes_fin"] == 15){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 14 || $a5["lunes_fin"] == 15){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 14 || $a6["lunes_fin"] == 15){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 14 || $a1["martes_fin"] == 15){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 14 || $a2["martes_fin"] == 15){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 14 || $a3["martes_fin"] == 15){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 14 || $a4["martes_fin"] == 15){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 14 || $a5["martes_fin"] == 15){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 14 || $a6["martes_fin"] == 15){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 14 || $a1["miercoles_fin"] == 15){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 14 || $a2["miercoles_fin"] == 15){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 14 || $a3["miercoles_fin"] == 15){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 14 || $a4["miercoles_fin"] == 15){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 14 || $a5["miercoles_fin"] == 15){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 14 || $a6["miercoles_fin"] == 15){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 14 || $a1["jueves_fin"] == 15){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 14 || $a2["jueves_fin"] == 15){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 14 || $a3["jueves_fin"] == 15){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 14 || $a4["jueves_fin"] == 15){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 14 || $a5["jueves_fin"] == 15){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 14 || $a6["jueves_fin"] == 15){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 14 || $a1["viernes_fin"] == 15){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 14 || $a2["viernes_fin"] == 15){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 14 || $a3["viernes_fin"] == 15){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 14 || $a4["viernes_fin"] == 15){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 14 || $a5["viernes_fin"] == 15){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 14 || $a6["viernes_fin"] == 15){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>3:00-4:00</td>";

          if($a1["lunes_inicio"] == 15 || $a1["lunes_fin"] == 16){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_inicio"] == 15 || $a2["lunes_fin"] == 16){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_inicio"] == 15 || $a3["lunes_fin"] == 16){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_inicio"] == 15 || $a4["lunes_fin"] == 16){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_inicio"] == 15 || $a5["lunes_fin"] == 16){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_inicio"] == 15 || $a6["lunes_fin"] == 16){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_inicio"] == 15 || $a1["martes_fin"] == 16){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_inicio"] == 15 || $a2["martes_fin"] == 16){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_inicio"] == 15 || $a3["martes_fin"] == 16){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_inicio"] == 15 || $a4["martes_fin"] == 16){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_inicio"] == 15 || $a5["martes_fin"] == 16){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_inicio"] == 15 || $a6["martes_fin"] == 16){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_inicio"] == 15 || $a1["miercoles_fin"] == 16){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_inicio"] == 15 || $a2["miercoles_fin"] == 16){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_inicio"] == 15 || $a3["miercoles_fin"] == 16){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_inicio"] == 15 || $a4["miercoles_fin"] == 16){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_inicio"] == 15 || $a5["miercoles_fin"] == 16){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_inicio"] == 15 || $a6["miercoles_fin"] == 16){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_inicio"] == 15 || $a1["jueves_fin"] == 16){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_inicio"] == 15 || $a2["jueves_fin"] == 16){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_inicio"] == 15 || $a3["jueves_fin"] == 16){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_inicio"] == 15 || $a4["jueves_fin"] == 16){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_inicio"] == 15 || $a5["jueves_fin"] == 16){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_inicio"] == 15 || $a6["jueves_fin"] == 16){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_inicio"] == 15 || $a1["viernes_fin"] == 16){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_inicio"] == 15 || $a2["viernes_fin"] == 16){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_inicio"] == 15 || $a3["viernes_fin"] == 16){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_inicio"] == 15 || $a4["viernes_fin"] == 16){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_inicio"] == 15 || $a5["viernes_fin"] == 16){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_inicio"] == 15 || $a6["viernes_fin"] == 16){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "<tr>";
          echo "<td>4:00-5:00</td>";

          if($a1["lunes_fin"] == 17){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["lunes_fin"] == 17){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["lunes_fin"] == 17){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["lunes_fin"] == 17){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["lunes_fin"] == 17){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["lunes_fin"] == 17){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["martes_fin"] == 17){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["martes_fin"] == 17){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["martes_fin"] == 17){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["martes_fin"] == 17){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["martes_fin"] == 17){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["martes_fin"] == 17){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["miercoles_fin"] == 17){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["miercoles_fin"] == 17){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["miercoles_fin"] == 17){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["miercoles_fin"] == 17){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["miercoles_fin"] == 17){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["miercoles_fin"] == 17){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["jueves_fin"] == 17){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["jueves_fin"] == 17){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["jueves_fin"] == 17){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["jueves_fin"] == 17){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["jueves_fin"] == 17){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["jueves_fin"] == 17){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          if($a1["viernes_fin"] == 17){
            echo "<td>" .$a1["nombre_asignatura"]. "</td>";
          }
          elseif($a2["viernes_fin"] == 17){
            echo "<td>" .$a2["nombre_asignatura"]. "</td>";
          }
          elseif($a3["viernes_fin"] == 17){
            echo "<td>" .$a3["nombre_asignatura"]. "</td>";
          }
          elseif($a4["viernes_fin"] == 17){
            echo "<td>" .$a4["nombre_asignatura"]. "</td>";
          }
          elseif($a5["viernes_fin"] == 17){
            echo "<td>" .$a5["nombre_asignatura"]. "</td>";
          }
          elseif($a6["viernes_fin"] == 17){
            echo "<td>" .$a6["nombre_asignatura"]. "</td>";
          }
          else{
            echo "<td></td>";
          }

          echo "</tr>";
          echo "</table>";
        }
        $conn->close();
      ?>
    </div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>
