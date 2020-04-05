<?php 
//Clase encargada de actualizar la información del objeto Usuario en la BBDD 
  require_once('padre.php');

class PadreDAO {

	public function getTotalPadres(){
		global $app;
		$conn = $app->conexionBD();

		$query="SELECT * FROM tutor_legal";
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1)); 
        $rows = $result->num_rows;
        $result->free();   

        return $rows;
	}

    public function inserta($p) {   
    	global $app;
    	$conn = $app->conexionBD();

    	$id = $this->getTotalPadres() + 1;
    	$nombre = $p->getNombre();
    	$ap1 = $p->getAp1();
    	$ap2 = $p->getAp2();
    	$movil = $p->getMovil();
    	$fijo = $p->getFijo();
    	$correo = $p->getCorreo();
    	$usuario = $p->getUsuario();
    	$contraseña = $p->getContraseña();

    	$p->setId($id);

     	$query = "INSERT INTO tutor_legal VALUES  ( '$id' , '$nombre' , '$ap1' , '$ap2' , '$movil' , '$fijo' , '$correo' , '$usuario' , '$contraseña')"; 
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
     	
    }
 
	public function delete($p) {     
		$query("DELETE Usuarios where id = '" . $p->id . "'");      
	} 
	 
	public function getPadre($usuario) { 
		$p = NULL; 
		global $app;
		$conn = $app->conexionBD();      
		
		$query = "SELECT * from tutor_legal where usuario = '$usuario'"; 
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

	    	$p = new Padre($fila['id'], $fila['nombre'], $fila['apellido1'], $fila['apellido2'], $fila['telefono_movil'], $fila['telefono_fijo'], $fila['correo'], $fila['usuario'], $fila['contraseña']);         
        }

	    return $p;     
	} 

    public function getHijos($id) {  
        global $app;
        $conn = $app->conexionBD();      
        
        $query = "SELECT * from alumnos where id_tutor_legal = '$id'"; 
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));         
        if($result->num_rows > 0){
            return $result;  
        }
        else{
            return NULL;
        }
    } 
}

?>