<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/Profesor.php';
    require_once __DIR__ . '/Form.php';


class FormularioEditProfesor extends Form
{
    public function __construct() {
        parent::__construct('formEdirProfesor');
    }

    protected function generaCamposFormulario($datos)
    {

        $profesor = new Profesor();
        $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
        $profesor->getProfe();


        $nombre = $profesor->getNombre();
        $apellido1 = $profesor->getAp1();
        $apellido2 = $profesor->getAp2();
        $despacho = $profesor->getDespacho();
        $correo = $profesor->getCorreo();
        $contrasenaNueva = " ";
        $nuevaContrasenaFinal  = " ";
   

        $html = <<<EOF
                    <div class="editar">
                     <h1>RELLENA LOS DATOS A EDITAR.</h1>
                        <b>Nombre: </b><br>
                        <input class="edit" type="text" placeholder="$nombre" name="nombre"/><br>
                        <b>Primer apellido: </b><br>
                        <input class="edit" type="text" placeholder="$apellido1" name="apellido1"/><br>
                        <b>Segundo apellido: </b><br>
                        <input class="edit" type="text" placeholder="$apellido2" name="apellido2"/><br>
                        <b>Despacho: </b><br>
                        <input class="edit" type="text" placeholder="$despacho" name="despacho" /><br>
                        <b>Correo: </b><br>
                        <input class="edit" type="text" placeholder="$correo" name="correo"/><br>
                        <b>Contraseña: </b><br>
                        <input class="edit" type="password" placeholder="Contraseña" name="contraseña" /><br>
                        <b>Repita la contraseña: </b><br>
                        <input class="edit" type="password" placeholder="Contraseña" name="contraseña2" /><br>
                    </div>
                    <div class="boton">
                        <button type="submit" name="registro">Guardar</button>
                    </div>
                EOF;

                return $html;
            }


    protected function procesaFormulario($datos)
    {
        $profesor = new profesor();

        $result = array();

        $nombre = isset($datos['nombre']) ? htmlspecialchars(trim(strip_tags($datos['nombre']))) : null;

        $apellido1 = isset($datos['apellido1']) ? htmlspecialchars(trim(strip_tags($datos['apellido1']))) : null;

        $apellido2 = isset($datos['apellido2']) ? htmlspecialchars(trim(strip_tags($datos['apellido2']))) : null;

        $despacho = isset($datos['despacho']) ? htmlspecialchars(trim(strip_tags($datos['despacho']))) : null;

        $correo = isset($datos['correo']) ? htmlspecialchars(trim(strip_tags($datos['correo']))) : null;

        $contrasenaNueva = isset($datos['contraseña']) ? htmlspecialchars(trim(strip_tags($datos['contraseña']))) : null;

        if ($contrasenaNueva != null && mb_strlen($contrasenaNueva) < 5 ) {
        $result[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres. ";
        }

        $nuevaContrasenaFinal = isset($datos['contraseña2']) ? htmlspecialchars(trim(strip_tags($datos['contraseña2']))) : null;

        if (strcmp($contrasenaNueva, $nuevaContrasenaFinal) !== 0 ) {
        $result[] = "Las contraseñas deben coincidir. ";
        }


        if (count($result) === 0) {
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $profesor->getProfe();
        }
        if( $nombre != null){
               $profesor->setNombre($nombre);
           }
        if( $apellido1 != null){
                $profesor->setAp1($apellido1);
           }
        if( $apellido2 != null){
               $profesor->setAp2($apellido2);
           }
        if( $despacho != null){
               $profesor->setDespacho($despacho);
           }
        if( $correo != null){
               $profesor->setCorreo($correo);
           }
        if( $contrasenaNueva != null && $nuevaContrasenaFinal != null && strcmp($contrasenaNueva, $nuevaContrasenaFinal) == 0){

               $profesor->setContraseña($hash= password_hash($nuevaContrasenaFinal, PASSWORD_BCRYPT, [rand()]));
               $nuevaContrasenaFinal = $hash= password_hash($nuevaContrasenaFinal, PASSWORD_BCRYPT, [rand()]);
           }

       $profesor->updateDatosProfesor($nombre, $apellido1,$apellido2,$despacho,$correo,$nuevaContrasenaFinal);
          return $result;
   }
}

?>