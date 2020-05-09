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
          <div class="imgcontainer">
            <img src="./img/avatar.png" alt="Avatar" class="avatar">
          </div>
          <div class="container">
            <b>Nombre de usuario: </b><br>
            <input class="login" type="text" placeholder="Usuario" name="nombreUsuario" value="$nombreUsuario" required>
            <br><b>Contraseña: </b><br>
            <input class="login" type="password" placeholder="Contraseña" name="password" required>
          </div>
          <div class="boton">
              <button type="submit">Entrar</button>
          </div>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $nombreUsuario = isset($datos['nombreUsuario']) ? $datos['nombreUsuario'] : null;

        if (empty($nombreUsuario) ) {
            $result[] = "El nombre de usuario no puede estar vacío. ";
        }

        $password = isset($datos['password']) ? $datos['password'] : null;
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
              $result[] = "Error: Usuario o contraseña invalidos. ";
            }
          }
          else if($profesor->getId() != 0){ //PROFE
           // echo $profesor->getContraseña();
            if(password_verify($password, $profesor->getContraseña())){
              $_SESSION['login'] = TRUE;
              $_SESSION['name'] = $nombreUsuario;
              $_SESSION['rol'] = 'profesor';
              header("Location: ./ver_profesor.php");
            }
            else{
              $result[] = "Error: Usuario o contraseña invalidos. ";
            }
          }
          else{
            $result[] = "Error: Usuario o contraseña invalidos. ";
          }
        }
        return $result;
    }
}

?>