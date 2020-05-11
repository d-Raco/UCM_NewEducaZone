<?php
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<body style="background-color:#CEFFCE;">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" href="css/index.css">
  </head>

  <body>
  <?php
     include("include/comun/cabecera.php");
  ?>

<div class="containerr">
  <img src="img/niño_cooreando.jpg" alt="Avatar" class="image" style=width:100%>
  <div class="centered"> <font size="+8"> Educazone</font> </div>
</div>

  <section id="one" class="wrapper">
    <div class="inner">
      <div class="flex flex-3">
        <article>
          <header>
            <h3>Comunicación<br /> </h3>
          </header>
          <p>Educazone permite la comunicación entre cualquier institución dedicada a la educación y
los padres de los alumnos que se encuentran en la misma mediante distintas
funcionalidades como la agenda personal del alumno, mensajería instantánea, la ficha
personal de cada alumno y el aula virtual donde se compartirán distintos contenidos de las
asignaturas.</p>
          <footer>
            <a href="signin.php" class="button special">More</a>
          </footer>
        </article>
        <article>
          <header>
            <h3> Donde quieras y cuando quieras</h3>
          </header>
          <p>Los usuarios registrados podrán recibir notificaciones de notas, menú del comedor ,
circulares, tutorías, actividades extraescolares, excursiones de sus hijos
matriculados en un centro educativo. Además existe la posibilidad de comunicación
instantánea, sencilla y efectiva entre las familias y los profesores del centro
educativo.</p>
          <footer>
            <a href="signin.php" class="button special">More</a>
          </footer>
        </article>
        <article>
          <header>
            <h3>Profesionalidad</h3>
          </header>
          <p>Profesionales del sector tendrán acceso a mensajería con los familiares del
alumno matriculado en su clase y podrán informar de toda actividad diaria e informar
sobre el progreso y desarrollo del alumno.</p>
          <footer>
            <a href="signin.php" class="button special">More</a>
          </footer>
        </article>
      </div>
    </div>
  </section>

  <section id="two" class="wrapper style1 special">
    <div class="inner">
      <header>
        <h2>Equipo</h2>
        <p>¿Quiénes somos? Ponte en contacto con nosotros</p>
      </header>
      <div class="flex flex-4">
        <div class="box person">
          <div class="image round">
            <img src="img/users/empleados/empleado1.jpg" alt="Person 1" />
          </div>
          <h3>Carlos Pérez</h3>
          <p>CEO</p>
          <p>CarCer@gmail.com</p>
        </div>
        <div class="box person">
          <div class="image round">
            <img src="img/users/empleados/empleado2.jpg" alt="Person 2" />
          </div>
          <h3>Laura García</h3>
          <p>Programador</p>
          <p>LauGar@gmail.com</p>
        </div>
        <div class="box person">
          <div class="image round">
            <img src="img/users/empleados/empleado4.jpg" alt="Person 3" />
          </div>
          <h3>Pablo Oliveras</h3>
          <p>Director de ventas</p>
          <p>PablOl@gmail.com</p>
        </div>
        <div class="box person">
          <div class="image round">
            <img src="img/users/empleados/empleado3.jpg" alt="Person 4" />
          </div>
          <h3>Dolores Pérez</h3>
          <p>Programador</p>
          <p>DoloresP@gmail.com</p>
        </div>
      </div>
    </div>
  </section>

    <?php
       include("include/comun/pie.php");
    ?>
  </body>
</html>
