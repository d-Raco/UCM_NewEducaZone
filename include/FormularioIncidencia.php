<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Form.php';

class FormularioIncidencia extends Form
{
    private $incidencia;

    public function __construct($idAlumno, $idAsignatura) {
        parent::__construct('formIncidencias');
        $this->incidencia = new Incidencias();
        $this->incidencia->setIdAlumno($idAlumno);
        $this->incidencia->setIdAsignatura($idAsignatura);
    }

    protected function generaCamposFormulario($datos)
    {
        $alumno = $this->incidencia->getIdAlumno();
        $asignatura = $this->incidencia->getIdAsignatura();

        $row = $this->incidencia->getInfo();

        echo "<table id='tablaIncidencias'>
                <tr id='filaIncidencias'>
                    <th id='cabeceraIncidencias'>Incidencias de " .$row["nombre"]. " " .$row["apellido1"]. " " .$row["apellido2"]. " en la asignatura de " .$row["nombre_asignatura"].
            "</th>
                </tr>" ;

        $incidencias = $this->incidencia->getIncidencias();

        if(!empty($incidencias)){
            foreach($incidencias as &$value){
                echo "<tr id='filaIncidencias'><td id='columna2'>".$value['msg_incidencia'].
                    "<div id='tooltip'>
                                ". $value['msg_incidencia'] ."
                            </div>
                    </td></tr>";
            }
        }
        echo "</table>";

        $html = <<<EOF
        <fieldset>
          <input type="hidden" name="idAlumno" value="$alumno">
          <input type="hidden" name="idAsignatura" value="$asignatura">
          <p>Mensaje de la incidencia:
          <input type="text" name="incidencia" /><br></p>
          <input type="submit" value="Enviar" />
        </fieldset>
        EOF;

        return $html;
    }


    protected function procesaFormulario($datos)
    {
        $result = array();

        $msg = isset($datos['incidencia']) ? htmlspecialchars(trim(strip_tags($datos['incidencia']))) : null;

        if (empty($msg) ) {
            $result[] = "La incidencia está vacía. ";
        }
        else{
          $this->incidencia->setId($this->incidencia->getNumIncidencias() + 1);
          $this->incidencia->setMsgIncidencia($msg);
          $this->incidencia->insertIncidencia();
        }

        return $result;
    }
}
?>
