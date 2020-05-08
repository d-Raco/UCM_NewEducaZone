<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<body style="background-color:#CEFFCE;">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/index.css"> -->
    <link rel="stylesheet" type="text/css" href="css/est.css">
    <link rel="stylesheet" type="text/css" href="css/ind.css">
  </head>

  <body>

  <?php
     include("include/comun/cabecera.php");
  ?>





    <br><br>

<font size="+4"><center> Educazone permite la comunicación entre cualquier institución dedicada a la educación y
    los padres de los alumnos que se encuentran en la misma mediante distintas
    funcionalidades como la agenda personal del alumno, mensajería instantánea, la ficha
    personal de cada alumno y el aula virtual donde se compartirán distintos contenidos de las
    asignaturas. </center></font>

<!--
    <div class="container">
      <img class="mainImage" src="img/prueba.jpg" alt="main Image">
      <div class="center">Conecta con tu hijo</div>
    </div>
-->

          <!--  <img src="img/Chavala_haciendo_quimica.jpg" class="slider-image" />
            <img src="img/cuaderno_y_lapiz.jpg" class="slider-image" />
            <img src="img/Niños_haciendo_deberes.jpg" class="slider-image" />  -->

            <div class="galeria" style="--w: 260px; --h: 300px;">
    <input type="radio" name="navegacion" id="_1" checked>
    <input type="radio" name="navegacion" id="_2">
    <input type="radio" name="navegacion" id="_3">
    <img src="img/Niños_haciendo_deberes.jpg" width="1846" height="970" alt="Galeria CSS 1" />
    <div class="center" style="text-align:center" >Proporcionale a tu hijo la educación que se merece</div>
    <img src="img/Chavala_haciendo_quimica.jpg" width="1846" height="970" alt="Galeria CSS 2"  />
    <img src="img/niño_cooreando.jpg" width="1846" height="970" alt="Galeria CSS 3" />
  </div>


<font size="+4"><center>ACTIVIDADES: </center></font>

    <div class="cuadrados">
      <div class="cuadrado">
        <h1>Acercamiento al profesor</h1>
        <p>Ofrecemos un servicio de mensajería que te permitirá contactar con los profesores de forma sencilla y amigable para concertar citas o resolver dudas.</p>
      </div>

      <div class="cuadrado">
        <h1>Agenda electrónica</h1>
        <p>Revisa la agenda de tu hijo: deberes, exámenes, vacaciones, tutorías, etc.</p>
      </div>

      <div class="cuadrado">
        <h1>Revisa incidencias</h1>
        <p>Permitimos que los profesores pongan comentarios para que conozcas el rendimiento de tu hijo y su comportamiento en las clases.</p>
      </div>
    </div>

    <div class="cuadrados">
      <div class="cuadrado">
        <h1>Progreso a tiempo real</h1>
        <p>Puedes visualizar las calificaciones de tus hijos sin tener que pasar por el colegio.</p>
      </div>

      <div class="cuadrado">
        <h1>Sencillo, intuitivo y útil</h1>
        <p>Con una interfaz gráfica sencilla y clara mantenemos una máxima funcionalidad para que no te tengas que preocupar de nada.</p>
      </div>
    </div>
  <?php
     include("include/comun/pie.php");
  ?>

  </body>
</html>
