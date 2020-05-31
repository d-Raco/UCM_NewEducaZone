<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/DAO_Profesor.php';
    require_once __DIR__ . '/Form.php';


class FormularioProfesor extends Form
{
    public function __construct() {
        parent::__construct('formRegistroProfesor');
    }

    protected function generaCamposFormulario($datos)
    {
        $id_centro = '';
        $nombreProfe = '';
        $apellido1 = '';
        $apellido2 = '';
        $despacho = '';
        $correo = '';
        $usuario = '';

        if ($datos) {
            $id_centro = isset($datos['id_centro']) ? $datos['id_centro'] : $id_centro;
            $nombreProfe = isset($datos['nombreProfe']) ? $datos['nombreProfe'] : $nombreProfe;
            $apellido1 = isset($datos['apellido1']) ? $datos['apellido1'] : $apellido1;
            $apellido2 = isset($datos['apellido2']) ? $datos['apellido2'] : $apellido2;
            $despacho = isset($datos['despacho']) ? $datos['despacho'] : $despacho;
            $correo = isset($datos['correo']) ? $datos['correo'] : $correo;
            $usuario = isset($datos['usuario']) ? $datos['usuario'] : $usuario;
        }

        $html = <<<EOF
            <div class="flex-container">
                <div class="registro">
                    <b>Id del centro: </b><br>
                    <input class="control" type="text" placeholder="Id del centro" name="id_centro" value="$id_centro"/><br>
                    <b>Nombre del profesor: </b><br>
                    <input class="control" type="text" placeholder="Nombre" name="nombreProfe" value="$nombreProfe"/><br>
                    <b>Primer apellido del tutor/a legal: </b><br>
                    <input class="control" type="text" placeholder="Primer apellido" name="apellido1" value="$apellido1" required/><br>
                    <b>Segundo apellido del tutor/a legal: </b><br>
                    <input class="control" type="text" placeholder="Segundo apellido" name="apellido2" value="$apellido2"/><br>
                    <b>Despacho: </b><br>
                    <input class="control" type="text" placeholder="Despacho" name="despacho" value="$despacho" required/><br>
                    <b>Correo electrónico:</b><br>
                    <input class="control" type="text" placeholder="Correo" name="correo" value="$correo" required/><br>
                    <b>Usuario: </b><br>
                    <input class="control" type="text" placeholder="Usuario" name="usuario" value="$usuario" required/><br>
                    <b>Contraseña: </b><br>
                    <input class="control" type="password" placeholder="Contraseña" name="contrasena" required/><br>
                    <b>Repita la contraseña: </b><br>
                    <input class="control" type="password" placeholder="Contraseña" name="contrasena2" required/><br>
                </div>
                <div class="imagen_registro">
                    <img src="./img/signin.png" alt="Avatar" class="sig" height="320" width="480">
                </div>
            </div>
            <div class="boton_registro">
                <button type="submit" name="registro">Añadir</button>
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

        $contrasena = isset($datos['contrasena']) ? htmlspecialchars(trim(strip_tags($datos['contrasena']))) : null;
        if ( empty($contrasena) || mb_strlen($contrasena) < 5 ) {
            $result[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres. ";
        }

        $contrasena2 = isset($datos['contrasena2']) ? htmlspecialchars(trim(strip_tags($datos['contrasena2']))) : null;
        if ( empty($contrasena2) || strcmp($contrasena, $contrasena2) !== 0 ) {
            $result[] = "Las contraseñas deben coincidir. ";
        }

        $id_centro = isset($datos['id_centro']) ? htmlspecialchars(trim(strip_tags($datos['id_centro']))) : null;

        $nombreProfe = isset($datos['nombreTutor']) ? htmlspecialchars(trim(strip_tags($datos['nombreTutor']))) : null;

        $apellido1 = isset($datos['apellido1']) ? htmlspecialchars(trim(strip_tags($datos['apellido1']))) : null;

        $apellido2 = isset($datos['apellido2']) ? htmlspecialchars(trim(strip_tags($datos['apellido2']))) : null;

        $despacho = isset($datos['despacho']) ? htmlspecialchars(trim(strip_tags($datos['despacho']))) : null;

        $correo = isset($datos['correo']) ? htmlspecialchars(trim(strip_tags($datos['correo']))) : null;

        $profesor = new Profesor();
        if (count($result) === 0) {
            $profesor->setUsuario($usuario);
            $dao_profesor = new DAO_Profesor();
            $dao_profesor->getProfe($profesor);
            if ( $profesor->getId() != 0 ) {
                $result[] = "El usuario ya existe. ";
            }
            else {
                $profesor->setId($dao_profesor->getTotalProfes()+1);
                $profesor->setNombre($nombreProfe);
                $profesor->setAp1($apellido1);
                $profesor->setAp2($apellido2);
                $profesor->setDespacho($despacho);
                $profesor->setIdCentro($id_centro);
                $profesor->setCorreo($correo);
                $profesor->setUsuario($usuario);
                $profesor->setContrasena($hash= password_hash($contrasena, PASSWORD_BCRYPT, [rand()]));


                $dao_profesor->inserta($profesor);
                echo "Nuevo registro creado. ";
                $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/login.php";
                echo "<script>window.open('".$url."','_self');</script>";
                //header("Location: ./login.php");
                //exit;
            }
        }
        return $result;
    }
}

?>
