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
        <fieldset>
            <legend>Registro</legend>
            <div class="grupo-control">
                <label>Nombre del tutor/a legal: </label> <input class="control" type="text" name="nombreTutor" value="$nombreTutor" />
            </div>
            <div class="grupo-control">
                <label>Primer apellido del tutor/a legal: </label> <input class="control" type="text" name="apellido1" value="$apellido1" />
            </div>
            <div class="grupo-control">
                <label>Segundo apellido del tutor/a legal: </label> <input class="control" type="text" name="apellido2" value="$apellido2"/>
            </div>
            <div class="grupo-control">
                <label>Teléfono móvil: </label> <input class="control" type="text" name="movil" value="$movil"/>
            </div>
            <div class="grupo-control">
                <label>Teléfono fijo: </label> <input class="control" type="text" name="fijo" value="$fijo"/>
            </div>
            <div class="grupo-control">
                <label>Correo electrónico: </label> <input class="control" type="text" name="correo" value="$correo"/>
            </div>
            <div class="grupo-control">
                <label>Usuario: </label> <input class="control" type="text" name="usuario" value="$usuario"/>
            </div>
            <div class="grupo-control">
                <label>Contraseña: </label> <input class="control" type="password" name="contraseña"/>
            </div>
            <div class="grupo-control">
                <label>Repita la contraseña: </label> <input class="control" type="password" name="contraseña2"/>
            </div>
            <div class="grupo-control">
                <label>Código de acceso: </label> <input class="control" type="password" name="codigo"/>
            </div>
            <div class="grupo-control"><button type="submit" name="registro">Registrar</button></div>
            </fieldset>
        EOF;
        
        return $html;
    }
    

    protected function procesaFormulario($datos)
    {
        $p = new Padre();

        $result = array();
        
        $usuario = isset($datos['usuario']) ? $datos['usuario'] : null;
        if ( empty($usuario) || mb_strlen($usuario) < 5 ) {
            $result[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $contraseña = isset($datos['contraseña']) ? $datos['contraseña'] : null;
        if ( empty($contraseña) || mb_strlen($contraseña) < 5 ) {
            $result[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres.";
        }

        $contraseña2 = isset($datos['contraseña2']) ? $datos['contraseña2'] : null;
        if ( empty($contraseña2) || strcmp($contraseña, $contraseña2) !== 0 ) {
            $result[] = "Las contraseñas deben coincidir";
        }

        $nombreTutor = isset($datos['nombreTutor']) ? $datos['nombreTutor'] : null;

        $apellido1 = isset($datos['apellido1']) ? $datos['apellido1'] : null;

        $apellido2 = isset($datos['apellido2']) ? $datos['apellido2'] : null;

        $movil = isset($datos['movil']) ? $datos['movil'] : null;

        $fijo = isset($datos['fijo']) ? $datos['fijo'] : null;

        $correo = isset($datos['correo']) ? $datos['correo'] : null;

        $codigo = isset($datos['codigo']) ? $datos['codigo'] : null;
        if ( empty($codigo) ) {
            $result[] = "Debes rellenar el campo Código de acceso";
        }
        elseif( ! $p->codigo_acceso($codigo)){
            $result[] = "El código de acceso es incorrecto";
        }

        
        if (count($result) === 0) {
            if ( !is_null($p->getPadre( htmlspecialchars(trim(strip_tags($usuario)))) )) {
                $result[] = "El usuario ya existe";
            } 
            else {
                $p->registro(
                    htmlspecialchars(trim(strip_tags($nombreTutor))),
                    htmlspecialchars(trim(strip_tags($apellido1))),
                    htmlspecialchars(trim(strip_tags($apellido2))),
                    htmlspecialchars(trim(strip_tags($movil))),
                    htmlspecialchars(trim(strip_tags($fijo))),
                    htmlspecialchars(trim(strip_tags($correo))),
                    htmlspecialchars(trim(strip_tags($usuario))),
                    htmlspecialchars(trim(strip_tags($contraseña)))
                );
                echo "Nuevo registro creado.";
                echo "<a href=\"../login.php\">Login</a>";
            }
        }
        return $result;
    }
}

?>