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
<?php
if (!isset($_SESSION['login'])){
    header("Location: ./login.php");
}
?>
<div id ="profesor">
    <?php
    include("include/comun/cabecera.php");
    include("include/comun/sidebarIzqProfesor.php");
    ?>
    <div id="contenido">
        <! CONTENIDO >

        <?php

        //Conexion a BBDD

        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error) /*error de conexion*/ {
            die("Fallo de conexion con la base de datos: " . $conn->connect_error);
        }
        else/*conexion exitosa*/{
            $conn->set_charset("utf8");

                //mostrar todas las Incidencia
                $nombre = $conn->real_escape_string($_SESSION['name']);
                //seleccionar incidencias
                $sql = "SELECT incidencias.id, incidencias.id_asignatura , incidencias.id_alumno , incidencias.msg_incidencia
                        FROM profesores
                        INNER JOIN asignaturas ON profesores.id = asignaturas.id_profesor
                        INNER JOIN incidencias ON asignaturas.id = incidencias.id_asignatura
                        WHERE profesores.usuario = '$nombre'";
                $result = $conn->query($sql)
                  or die ($conn->error. " en la línea ".(__LINE__-1));



                    while($row = mysqli_fetch_array($result)){
                        echo $row['id'] . "<br>"
                           . $row['id_asignatura'] . "<br>"
                           . $row['id_alumno'] . "<br>"
                           . $row['msg_incidencia'] . "<hr>";
                    }




        }

        ?>
        <form action="incidencias_crear.php">
            <input type="submit" value="Crear incidencia" />
        </form>

        <! fin del contenido>
    </div>

    <?php
    include("include/comun/sidebarDerPadre.php");
    include("include/comun/pie.php");
    ?>
</div>
</body>
</html>