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
            $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : $nombreUsuario;
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

        $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;
            
        if (empty($nombreUsuario) ) {
            $result[] = "El nombre de usuario no puede estar vacío";
        }

        $password = isset($datos['password']) ? $datos['password'] : null;
        if ( empty($password) ) {
            $result[] = "El password no puede estar vacío.";
        }

        if (count($result) === 0) {
            $pdao = new Padre();
            $usuario = $pdao->getPadre($nombreUsuario);
            $prdao = new Profesor();
            $pusuario = $prdao->getProfe($nombreUsuario);

            if(!is_null($usuario)){ //PADRE
                if ($password == $usuario->getContraseña()){
                    $_SESSION['login'] = TRUE;
                    $_SESSION['name'] = $nombreUsuario;
                    $_SESSION['rol'] = 'padre';
                    header("Location: ./ver_padre.php");
                }
                else{
                  echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
                }
            }
            else if(!is_null($pusuario)){ //PROFE
                if ($password == $pusuario->getContraseña()){
                    $_SESSION['login'] = TRUE;
                    $_SESSION['name'] = $nombreUsuario;
                    $_SESSION['rol'] = 'profesor';
                    header("Location: ./ver_profesor.php");
                }
                else{
                  echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
                }
            }
            else{
                echo "Error: Usuario o contraseña invalidos. <a href=\"../login.php\">Login</a>";
            }
        }
        return $result;
    }
}