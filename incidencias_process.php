<! Artur Amon Educazone v2 2020>

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
    <div id="procesarSignin">
        <?php

        include("include/comun/cabecera.php");
        include("include/comun/sidebarIzqProfesor.php");

            $dniAlumno = $_REQUEST["DNI"];
            $incidencia = $_REQUEST["incidencia"];
            $asignatura = $_REQUEST["asignatura"];

            $dummyProf = 2;

            $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);

            if ($conn->connect_error) {
                die("Fallo de conexion con la base de datos: " . $conn->connect_error);
            }
            else{

                $sql = "SELECT * FROM alumnos WHERE alumnos.DNI = '$dniAlumno'";
                $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));

                if($result->num_rows !== 1){
                    echo "Error en el DNI del alumno";
                   echo '<form action="incidencias_crear.php">
                        <input type="submit" value="Crear incidencia" />
                     </form>';
                }else{

                    $sql = "SELECT id FROM incidencias";
                    $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));
                    $id = $result->num_rows + 1;

                    $sql = "INSERT INTO incidencias (id, id_asignatura, id_alumno, msg_incidencia)
                            VALUES ('$id', '$asignatura', '$dniAlumno', '$incidencia')";

                    if ($conn->query($sql) === TRUE) {
                        echo("
                        <meta http-equiv=\"Refresh\" content=\"0; url=profesor.php\" />
                        ");
                    }
                    else { echo "Error: " . $sql . "<br>" . $conn->error;}
                }
            }

        ?>
        <?php
        include("include/comun/sidebarDerPadre.php");
        include("include/comun/pie.php");
        ?>
    </div>
    </body>
</html>

