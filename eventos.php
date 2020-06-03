<?php
require_once __DIR__ . '/include/config.php';
header('Content-Type: application/json');
$pdo = new PDO("mysql:host=localhost;dbname=centros_educativos;charset=UTF8","administrador","administrador");

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch($accion) {
	case 'agregar':
		$sentenciaSQL = $pdo->prepare("INSERT INTO
		eventos(title,descripcion,color,start,end)
		VALUES(:title,:descripcion,:color,:start,:end)");
		
		$respuesta = $sentenciaSQL->execute(array(
			"title" => $_POST['title'],
			"descripcion" => $_POST['descripcion'],
			"color" => $_POST['color'],
			"start" => $_POST['start'],
			"end" => $_POST['end']
		));
		echo json_encode($respuesta);
		break;
	case 'eliminar':
		$respuesta = false;
		if(isset($_POST['id'])) {
			$sentenciaSQL = $pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
			$respuesta = $sentenciaSQL->execute(array("ID"=>$_POST['id']));
		}
		echo json_encode($respuesta);
		break;	
	case 'modificar':
		$sentenciaSQL = $pdo->prepare("UPDATE eventos SET
		title=:title,
		descripcion=:descripcion,
		color=:color,
		start=:start,
		end=:end
		WHERE ID=:ID
		");
		
		$respuesta = $sentenciaSQL->execute(array(
			"ID" => $_POST['id'],
			"title" => $_POST['title'],
			"descripcion" => $_POST['descripcion'],
			"color" => $_POST['color'],
			"start" => $_POST['start'],
			"end" => $_POST['end']
		));
		
		echo json_encode($respuesta);
		break;	
	default: 
		//Seleccionar los eventos del calendario
		$sentenciaSQL = $pdo->prepare("SELECT * FROM eventos");
		$sentenciaSQL->execute();

		$results = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($results);
		break;
	
}

?>