<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/DAO_Profesor.php';
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
        $dao_profesor = new DAO_Profesor();
        $dao_profesor->getProfe($profesor);


        $nombre = $profesor->getNombre();
        $apellido1 = $profesor->getAp1();
        $apellido2 = $profesor->getAp2();
        $despacho = $profesor->getDespacho();
        $correo = $profesor->getCorreo();
        $contrasenaNueva = " ";
        $nuevaContrasenaFinal  = " ";


        $html = <<<EOF
                    <div class="contenido">
                     <br><h1>RELLENA LOS DATOS A EDITAR.</h1>
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
                        <input class="edit" type="password" placeholder="Contraseña" name="contrasena" /><br>
                        <b>Repita la contraseña: </b><br>
                        <input class="edit" type="password" placeholder="Contraseña" name="contrasena2" /><br>
                      </div>
                      <div class="boton">
                          <button class='submit' type="submit" name="registro">Guardar</button>
                      </div>

                EOF;

                return $html;
            }


    protected function procesaFormulario($datos)
    {
        $profesor = new Profesor();

        $result = array();

        $nombre = isset($datos['nombre']) ? htmlspecialchars(trim(strip_tags($datos['nombre']))) : null;

        $apellido1 = isset($datos['apellido1']) ? htmlspecialchars(trim(strip_tags($datos['apellido1']))) : null;

        $apellido2 = isset($datos['apellido2']) ? htmlspecialchars(trim(strip_tags($datos['apellido2']))) : null;

        $despacho = isset($datos['despacho']) ? htmlspecialchars(trim(strip_tags($datos['despacho']))) : null;

        $correo = isset($datos['correo']) ? htmlspecialchars(trim(strip_tags($datos['correo']))) : null;

        $contrasenaNueva = isset($datos['contrasena']) ? htmlspecialchars(trim(strip_tags($datos['contrasena']))) : null;

        if ($contrasenaNueva != null && mb_strlen($contrasenaNueva) < 5 ) {
        $result[] = "La contraseña tiene que tener una longitud de al menos 5 caracteres. ";
        }

        $nuevaContrasenaFinal = isset($datos['contrasena2']) ? htmlspecialchars(trim(strip_tags($datos['contrasena2']))) : null;

        if (strcmp($contrasenaNueva, $nuevaContrasenaFinal) !== 0 ) {
        $result[] = "Las contraseñas deben coincidir. ";
        }


        if (count($result) === 0) {
          $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
          $dao_profesor = new DAO_Profesor();
          $dao_profesor->getProfe($profesor);
        }
        else{
          return $result;
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

               $profesor->setContrasena($hash= password_hash($nuevaContrasenaFinal, PASSWORD_BCRYPT, [rand()]));
               $nuevaContrasenaFinal = $hash= password_hash($nuevaContrasenaFinal, PASSWORD_BCRYPT, [rand()]);
           }

        $dao_profesor->updateDatosProfesor($profesor->getId(), $nombre, $apellido1,$apellido2,$despacho,$correo,$nuevaContrasenaFinal);

        $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_profesor.php";
        echo "<script>window.open('".$url."','_self');</script>";
        //header("Location: ./ver_profesor.php");
        //exit;
   }
}

?>
