<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/DAO_Alumno.php';
    require_once __DIR__ . '/Form.php';


class FormularioborrarA extends Form
{
    public function __construct() {
        parent::__construct('formRegistroAlumno');
    }

    protected function generaCamposFormulario($datos)
    {
        $DNI = '';
      
  
        if ($datos) {
            $DNI = isset($datos['DNI']) ? $datos['DNI'] : $DNI;
           
       
        }

        $html = <<<EOF
            <div class="flex-container">
                 
                    <img src="./img/borrarA.jpg" alt="Avatar" class="sig" height="80" width="80">
            
                <div class="registro">
                    <b>DNI: </b><br>
                    <input class="control" type="text" placeholder="DNI" name="DNI" value="$DNI"/><br>
                </div>
          
            </div>
            <div class="boton_registro">
                <button type="submit" name="Crear">Borrar</button>
            </div>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {

        $result = array();

        $DNI = isset($datos['DNI']) ? htmlspecialchars(trim(strip_tags($datos['DNI']))) : null;


     




        if (count($result) === 0) {
            $alumno = new Alumno();
            $alumno->setDNI($DNI);
            $dao_alumno = new DAO_Alumno();
            $dao_alumno->getAlumno($alumno);

          if($alumno->getDNI() != 0){
             $dao_alumno->deleteA($alumno->getDni());
              echo "Alumno borrado. ";
          //  $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_admin.php";
           // echo "<script>window.open('".$url."','_self');</script>";
          } else {
                $result[] = "El usuario no existe. ";

        
           
            header("Location: ./ver_admin.php");
            exit;
            }
        }


        return $result;
    }
}

?>
