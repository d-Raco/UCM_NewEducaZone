<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Padre.php';
require_once __DIR__ . '/dao/Profesor.php';
require_once __DIR__ . '/Form.php';

class FormularioLogin extends Form
{
    public function __construct() {
        parent::__construct('formLogin');
    }

    protected function generaCamposFormulario($datos)
    {
        $nombreUsuario = '';
        if ($datos) {
            $nombreUsuario = isset($datos['nombreUsuario']) ? htmlspecialchars(trim(strip_tags($datos['nombreUsuario']))) : $nombreUsuario;
        }
        $html = <<<EOF
        <fieldset>
            <legend>Login</legend>
            <p><label>Nombre de usuario:</label> <input type="text" name="nombreUsuario" value="$nombreUsuario"/></p>
            <p><label>Password:</label> <input type="password" name="password" /></p>
            <button type="submit" name="login">Entrar</button>
        </fieldset>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $nombreUsuario = isset($datos['nombreUsuario']) ? htmlspecialchars(trim(strip_tags($datos['nombreUsuario']))) : null;

        if (empty($nombreUsuario) ) {
            $result[] = "El nombre de usuario no puede estar vacío. ";
        }

        $password = isset($datos['password']) ? htmlspecialchars(trim(strip_tags($datos['password']))) : null;
        if ( empty($password) ) {
            $result[] = "El password no puede estar vacío. ";
        }

        if (count($result) === 0) {
          $padre = new Padre();
          $padre->setId(0);
          $padre->setUsuario($nombreUsuario);
          $padre->getPadre();
          $profesor = new Profesor();
          $profesor->setId(0);
          $profesor->setUsuario($nombreUsuario);
          $profesor->getProfe();

          if($padre->getId() != 0){ //PADRE
            if(password_verify($password, $padre->getContraseña())){
                $_SESSION['login'] = TRUE;
                $_SESSION['name'] = $nombreUsuario;
                $_SESSION['rol'] = 'padre';
                header("Location: ./ver_padre.php");
            }
            else{
              $result[] =  "Error: Usuario o contraseña invalidos. ";
            }
          }
          else if($profesor->getId() != 0){ //PROFE
            if(password_verify($password, $profesor->getContraseña())){
              $_SESSION['login'] = TRUE;
              $_SESSION['name'] = $nombreUsuario;
              $_SESSION['rol'] = 'profesor';
              header("Location: ./ver_profesor.php");
            }
            else{
              $result[] =  "Error: Usuario o contraseña invalidos. ";
            }
          }
          else{
            $result[] =  "Error: Usuario o contraseña invalidos. ";
          }
        }
        return $result;
    }
}
