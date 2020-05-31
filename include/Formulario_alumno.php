<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/dao/DAO_Alumno.php';
    require_once __DIR__ . '/Form.php';


class FormularioAlumno extends Form
{
    public function __construct() {
        parent::__construct('formRegistroAlumno');
    }

    protected function generaCamposFormulario($datos)
    {
        $DNI = '';
        $nombreAlumno = '';
        $apellido1 = '';
        $apellido2 = '';
        $id_centro = '';
        $id_clase = '';
        $observaciones = '';
        $id_tutor_legal = '';
        $fecha = '';
        $id_calificaciones = '';

        if ($datos) {
            $DNI = isset($datos['DNI']) ? $datos['DNI'] : $DNI;
            $nombreAlumno = isset($datos['nombreAlumno']) ? $datos['nombreAlumno'] : $nombreAlumno;
            $apellido1 = isset($datos['apellido1']) ? $datos['apellido1'] : $apellido1;
            $apellido2 = isset($datos['apellido2']) ? $datos['apellido2'] : $apellido2;
            $id_centro = isset($datos['id_centro']) ? $datos['id_centro'] : $id_centro;
            $id_clase = isset($datos['id_clase']) ? $datos['id_clase'] : $id_clase;
            $observaciones = isset($datos['observaciones']) ? $datos['observaciones'] : $observaciones;
            $id_tutor_legal = isset($datos['id_tutor_legal']) ? $datos['id_tutor_legal'] : $id_tutor_legal;
            $fecha = isset($datos['fecha']) ? $datos['fecha'] : $fecha;
            $id_calificaciones = isset($datos['id_calidicaciones']) ? $datos['id_calidicaciones'] : $id_calificaciones;
        }

        $html = <<<EOF
            <div class="flex-container">
                <div class="registro">
                    <b>DNI: </b><br>
                    <input class="control" type="text" placeholder="DNI" name="DNI" value="$DNI"/><br>
                    <b>Nombre del alumno: </b><br>
                    <input class="control" type="text" placeholder="Nombre" name="nombreAlumno" value="$nombreAlumno"/><br>
                    <b>Primer apellido: </b><br>
                    <input class="control" type="text" placeholder="Primer apellido" name="apellido1" value="$apellido1" required/><br>
                    <b>Segundo apellido: </b><br>
                    <input class="control" type="text" placeholder="Segundo apellido" name="apellido2" value="$apellido2"/><br>
                    <b>Id del centro: </b><br>
                    <input class="control" type="text" placeholder="id del centro" name="id_centro" value="$id_centro" required/><br>
                    <b>Id de la clase:</b><br>
                    <input class="control" type="text" placeholder="id de la clase" name="id_clase" value="$id_clase" required/><br>
                    <b>Observaciones: </b><br>
                    <input class="control" type="text" placeholder="Observaciones" name="observaciones" value="$observaciones"/><br>
                    <b>Id del tutor legal: </b><br>
                    <input class="control" type="text" placeholder="Id del tutor legal" name="id_tutor_legal" value="$id_tutor_legal"/><br>
                    <b>Fecha: </b><br>
                    <input class="control" type="text" placeholder="Fecha de nacimiento" name="fecha" value="$fecha" required/><br>
                    <b>Id de calificaciones: </b><br>
                    <input class="control" type="text" placeholder="Id de la calificacones" name="id_calidicaciones" value="$id_calificaciones"/><br>
                    <input type='file' name = 'fileUpload'>
                </div>
                <div class="imagen_registro">
                    <img src="./img/Ninos_haciendo_deberes.jpg" alt="Avatar" class="sig" height="520" width="780">
                </div>
            </div>
            <div class="boton_registro">
                <button type="submit" name="Crear">Añadir</button>
            </div>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {

        $result = array();

        $DNI = isset($datos['DNI']) ? htmlspecialchars(trim(strip_tags($datos['DNI']))) : null;

        $id_clase = isset($datos['id_clase']) ? htmlspecialchars(trim(strip_tags($datos['id_clase']))) : null;

        $id_centro = isset($datos['id_centro']) ? htmlspecialchars(trim(strip_tags($datos['id_centro']))) : null;

        $nombreAlumno = isset($datos['nombreAlumno']) ? htmlspecialchars(trim(strip_tags($datos['nombreAlumno']))) : null;

        $apellido1 = isset($datos['apellido1']) ? htmlspecialchars(trim(strip_tags($datos['apellido1']))) : null;

        $apellido2 = isset($datos['apellido2']) ? htmlspecialchars(trim(strip_tags($datos['apellido2']))) : null;

        $id_calificaciones = isset($datos['id_calificaciones']) ? htmlspecialchars(trim(strip_tags($datos['id_calificaciones']))) : null;

        $fecha = isset($datos['fecha']) ? htmlspecialchars(trim(strip_tags($datos['fecha']))) : null;

        $id_tutor_legal = isset($datos['id_tutor_legal']) ? htmlspecialchars(trim(strip_tags($datos['id_tutor_legal']))) : null;

        $observaciones = isset($datos['observaciones']) ? htmlspecialchars(trim(strip_tags($datos['observaciones']))) : null;

        $file = isset($_FILES['fileupload']) ? $_FILES['fileupload'] : null;



        if (count($result) === 0) {
            $alumno = new Alumno();
            $alumno->setDNI($DNI);
            $dao_alumno = new DAO_Alumno();
            $dao_alumno->getAlumno($alumno);

            $alumno->setDNI($DNI);
            $alumno->setNombre($nombreAlumno);
            $alumno->setAp1($apellido1);
            $alumno->setAp2($apellido2);
            $alumno->setIdClase($id_clase);
            $alumno->setIdCentro($id_centro);
            $alumno->setOM($observaciones);
            $alumno->setTutor($id_tutor_legal);
            $alumno->setFecha($fecha);
            $alumno->setCal($id_calificaciones);

            if(!empty($file['name'])){

                $alumno->setFoto("./img/users/alumnos/" . $alumno->getNombre());
                move_uploaded_file($file['tmp_name'], $alumno->getFoto());
            }

            $dao_alumno->inserta($alumno);
            echo "Nuevo registro creado. ";
            $url = "https://vm11.aw.e-ucm.es/EducaZone4.0/ver_admin.php";
            echo "<script>window.open('".$url."','_self');</script>";
            //header("Location: ./ver_admin.php");
            //exit;
        }


        return $result;
    }
}

?>
