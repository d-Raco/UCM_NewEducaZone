<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/Padre.php';
    require_once __DIR__ . '/Form.php';


class FormularioRegistro extends Form
{
    public function __construct() {
        parent::__construct('formRegistro');
    }

    protected function generaCamposFormulario($datos)
    {
        $nombreTutor = '';
        $apellido1 = '';
        $apellido2 = '';
        $movil = '';
        $fijo = '';
        $correo = '';
        $usuario = '';

        if ($datos) {
            $nombreTutor = isset($datos['nombreTutor']) ? $datos['nombreTutor'] : $nombreTutor;
            $apellido1 = isset($datos['apellido1']) ? $datos['apellido1'] : $apellido1;
            $apellido2 = isset($datos['apellido2']) ? $datos['apellido2'] : $apellido2;
            $movil = isset($datos['movil']) ? $datos['movil'] : $movil;
            $fijo = isset($datos['fijo']) ? $datos['fijo'] : $fijo;
            $correo = isset($datos['correo']) ? $datos['correo'] : $correo;
            $usuario = isset($datos['usuario']) ? $datos['usuario'] : $usuario;
        }

        $html = <<<EOF
            <div class="flex-container">
                <div class="registro"> 
                    <b>Nombre del tutor/a legal: </b><br>
                    <input class="control" type="text" placeholder="Nombre" name="nombreTutor" value="$nombreTutor"/><br>
                    <b>Primer apellido del tutor/a legal: </b><br>
                    <input class="control" type="text" placeholder="Primer apellido" name="apellido1" value="$apellido1" required/><br>
                    <b>Segundo apellido del tutor/a legal: </b><br>
                    <input class="control" type="text" placeholder="Segundo apellido" name="apellido2" value="$apellido2"/><br>
                    <b>Teléfono móvil: </b><br>
                    <input class="control" type="text" placeholder="Teléfono móvil" name="movil" value="$movil" required/><br>
                    <b>Teléfono fijo: </b><br>
                    <input class="control" type="text" placeholder="Teléfono fijo" name="fijo" value="$fijo"/><br>
                    <b>Correo electrónico:</b><br>
                    <input class="control" type="text" placeholder="Correo" name="correo" value="$correo" required/><br>
                    <b>Usuario: </b><br>
                    <input class="control" type="text" placeholder="Usuario" name="usuario" value="$usuario" required/><br>
                    <b>Contraseña: </b><br>
                    <input class="control" type="password" placeholder="Contraseña" name="contraseña" required/><br>
                    <b>Repita la contraseña: </b><br>
                    <input class="control" type="password" placeholder="Contraseña" name="contraseña2" required/><br>
                    <b>Código de acceso: </b><br>
                    <input class="control" type="password" placeholder="Código" name="codigo" required/><br>
                </div>
                <div class="imagen_registro">
                    <img src="./img/signin.png" alt="Avatar" class="sig" height="320" width="480">
                </div>
            </div>
            <div class="boton_registro">    
                <button type="submit" name="registro">Registrar</button>
            </div>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $padre = new Padre();

        $result = array();

        $usuario = isset($datos['usuario']) ? htmlspecialchars(trim(strip_tags($datos['usuario']))) : null;
        if ( empty($usuario) || mb_strlen($usuario) < 5 ) {
            $result[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres. ";
        }

        $contraseña = isset($datos['contraseña']) ? htmlspecialchars(trim(strip_tags($datos['contraseña']))) : null;
        if ( empty($contraseña) || mb_strlen($contraseña) < 5 ) {
            $result[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres. ";
        }

        $contraseña2 = isset($datos['contraseña2']) ? htmlspecialchars(trim(strip_tags($datos['contraseña2']))) : null;
        if ( empty($contraseña2) || strcmp($contraseña, $contraseña2) !== 0 ) {
            $result[] = "Las contraseñas deben coincidir. ";
        }

        $nombreTutor = isset($datos['nombreTutor']) ? htmlspecialchars(trim(strip_tags($datos['nombreTutor']))) : null;

        $apellido1 = isset($datos['apellido1']) ? htmlspecialchars(trim(strip_tags($datos['apellido1']))) : null;

        $apellido2 = isset($datos['apellido2']) ? htmlspecialchars(trim(strip_tags($datos['apellido2']))) : null;

        $movil = isset($datos['movil']) ? htmlspecialchars(trim(strip_tags($datos['movil']))) : null;

        $fijo = isset($datos['fijo']) ? htmlspecialchars(trim(strip_tags($datos['fijo']))) : null;

        $correo = isset($datos['correo']) ? htmlspecialchars(trim(strip_tags($datos['correo']))) : null;

        $codigo = isset($datos['codigo']) ? $datos['codigo'] : null;
        if ( empty($codigo) ) {
            $result[] = "Debes rellenar el campo Código de acceso. ";
        }
        elseif( ! $padre->codigo_acceso($codigo)){
            $result[] = "El código de acceso es incorrecto. ";
        }


        if (count($result) === 0) {
            $padre->setUsuario($usuario);
            $padre->setId(0);
            $padre->getPadre();
            if ( $padre->getId() != 0 ) {
                $result[] = "El usuario ya existe. ";
            }
            else {
                $padre->setId($padre->getTotalPadres()+1);
                $padre->setNombre($nombreTutor);
                $padre->setAp1($apellido1);
                $padre->setAp2($apellido2);
                $padre->setMovil($movil);
                $padre->setFijo($fijo);
                $padre->setCorreo($correo);
                $padre->setUsuario($usuario);
                $padre->setContraseña($hash= password_hash($contraseña, PASSWORD_BCRYPT, [rand()]));

                $padre->registro();
                $padre->actualiza_alumno($codigo);
                echo "Nuevo registro creado. ";
                echo "<a href=\"./login.php\">Login</a>";
            }
        }
        return $result;
    }
}

?>
