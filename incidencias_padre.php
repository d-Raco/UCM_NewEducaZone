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
   <div id ="alumno">
    <?php
      include("include/comun/cabecera.php");
      include("include/comun/sidebarIzqPadre.php");
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
			
				//SE BUSCA EL ID DEL PADRE
				$usuario = $conn->real_escape_string($_SESSION['name']);
				$sql = "SELECT id FROM tutor_legal WHERE usuario = '$usuario'";
				$result = $conn->query($sql)
					or die ($conn->error. " en la línea ".(__LINE__-1));

				if($result->num_rows !== 1) /*No se encontró el padre o se repite su id*/{echo "Error al acceder a padre";}
				else{
					$filaPadre = $result->fetch_assoc();
					$idPadre = $filaPadre["id"];
					
					//Guardar hijos

					
					$sql = "SELECT dni FROM alumnos WHERE id_tutor_legal = $idPadre";
					$result = $conn->query($sql)
						or die ($conn->error. " en la línea ".(__LINE__-1));
                    $hijos = mysqli_fetch_array($result);

                    //$hijos contiene un array de hijos

                    foreach($hijos as $hijo){

                        echo("'$hijo'<br>");

                        $sql = "SELECT * FROM incidencias WHERE id_alumno = '$hijo'";
                        $result = $conn->query($sql)
                            or die ($conn->error. " en la línea ".(__LINE__-1));

                        //tabla que muestra las incidencias
                        echo "<ul style=\"list-style-type:none;\">";

                        while($row = mysqli_fetch_array($result)){
                            echo $row['id'] . "<br>"
                                . $row['id_asignatura'] . "<br>"
                                . $row['id_alumno'] . "<br>"
                                . $row['msg_incidencia'] . "<hr>";
                        }

                    }
					
				}
			
				//Buscar todos los hijos
				
				//Sacar las tablas de incidencias de cada uno
				
				//Mostrar todas las incidencias
			
				
			
			}
	
		?>
	<! fin del contenido>
	</div>

    <?php
      include("include/comun/sidebarDerPadre.php");
      include("include/comun/pie.php");
    ?>
   </div>
  </body>
</html>