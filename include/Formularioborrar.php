<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/DAO_Profesor.php';
    require_once __DIR__ . '/Form.php';


class Formularioborrar extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }

    protected function generaCamposFormulario($datos)
    {

        $usuario = '';

        if ($datos) {
    
            $usuario = isset($datos['usuario']) ? $datos['usuario'] : $usuario;
          
        }

        $html = <<<EOF
            <div class="flex-container">
               <img src="./img/borrarP.png" alt="Avatar" class="sig" height="80" width="80">
                <div class="registro">  
                      <b>Usuario: </b><br>
                    <input class="control" type="text" placeholder="Usuario" name="usuario" value="$usuario" required/><br>  
                </div>
            </div>
            <div class="boton_registro">
                <button type="submit" name="registro">Borrar</button>
            </div>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {

        $result = array();

         $usuario = isset($datos['usuario']) ? htmlspecialchars(trim(strip_tags($datos['usuario']))) : null;
        if ( empty($usuario) || mb_strlen($usuario) < 5 ) {
            $result[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres. ";
        }
       
     


         $profesor = new Profesor();
        if (count($result) === 0) {
            $profesor->setUsuario($usuario);
            $dao_profesor = new DAO_Profesor();
            $dao_profesor->getProfe($profesor);
            if ( $profesor->getId() != 0 ) {
                $dao_profesor->deleteP($profesor->getUsuario());
              //    $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_admin.php";
                //  echo "<script>window.open('".$url."','_self');</script>";
                echo " Profesor borrado. ";
            }

            else {
                $result[] = "El usuario no existe. ";
            }
    
        }
        return $result;
    }
}

?>
