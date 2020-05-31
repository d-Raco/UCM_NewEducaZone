<?php
require_once __DIR__ . '/../transfer/Centro.php';

class DAO_Centro{

	public function getNombrePorID($nombre){
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $sql = sprintf("SELECT nombre FROM centros WHERE id = ". $nombre);
        $result = $conn->query($sql)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        return $result;
    }
}

?>
