<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/DAO_Padre.php';
require_once __DIR__ . '/dao/DAO_Profesor.php';
require_once __DIR__ . '/dao/DAO_Admin.php';
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
          <div class="boton_login">
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
          $dao_padre = new DAO_Padre();
          $dao_padre->getPadre($padre);

          $profesor = new Profesor();
          $profesor->setId(0);
          $profesor->setUsuario($nombreUsuario);
          $dao_profesor = new DAO_Profesor();
          $dao_profesor->getProfe($profesor);

          $admin = new Admin();
          $admin->setUsuario($nombreUsuario);
          $dao_admin = new DAO_Admin();
          $dao_admin->getAdmin($admin);

          if($padre->getId() != 0){ //PADRE
            if(password_verify($password, $padre->getContrasena())){
                $_SESSION['login'] = TRUE;
                $_SESSION['name'] = $nombreUsuario;
                $_SESSION['rol'] = 'padre';
                $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_padre.php";
                echo "<script>window.open('".$url."','_self');</script>";
                //header("Location: ./ver_padre.php");
                //exit;
            }
            else{
              $result[] = "Error: Usuario o contraseña invalidos. ";
            }
          }
          else if($profesor->getId() != 0){ //PROFE
           // echo $profesor->getContrasena();
            if(password_verify($password, $profesor->getContrasena())){
              $_SESSION['login'] = TRUE;
              $_SESSION['name'] = $nombreUsuario;
              $_SESSION['rol'] = 'profesor';
              $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_profesor.php";
              echo "<script>window.open('".$url."','_self');</script>";
              //header("Location: ./ver_profesor.php");
              //exit;
            }

            else{
              $result[] = "Error: Usuario o contraseña invalidos. ";
            }
          }
           else if($admin->getId() != 0){ //Admin
           // echo $admin->getContrasena();
          if(password_verify($password, $admin->getContrasena())){

              $_SESSION['login'] = TRUE;
              $_SESSION['name'] = $nombreUsuario;
              $_SESSION['rol'] = 'admin';
              $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_admin.php";
              echo "<script>window.open('".$url."','_self');</script>";
              //header("Location: ./ver_admin.php");
              //exit;
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
