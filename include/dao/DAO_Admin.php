<?php
require_once __DIR__ . '/../transfer/Admin.php';


class DAO_Admin{



	public function getAdmin($admin) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from administrador where usuario = '%s'", $conn->real_escape_string($admin->getUsuario()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
	      $fila = $result->fetch_assoc();
	      $admin->setUsuario($fila['usuario']);
	      $admin->setContrasena($fila['password']);
	      $admin->setFoto($fila['foto']);
	      $admin->setId($fila['id']);
	    }
	}



}

?>
