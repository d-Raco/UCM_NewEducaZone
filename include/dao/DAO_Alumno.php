<?php

require_once __DIR__ . '/../transfer/Alumno.php';


class DAO_Alumno{

	 public function inserta($p) {
    	$app = Aplicacion::getSingleton();
    	$conn = $app->conexionBD();

    	$DNI = $conn->real_escape_string($p->getDNI());
    	$nombre = $conn->real_escape_string($p->getNombre());
    	$ap1 = $conn->real_escape_string($p->getAp1());
    	$ap2 = $conn->real_escape_string($p->getAp2());
			$id_centro = $conn->real_escape_string($p->getIdCentro());
    	$id_clase = $conn->real_escape_string($p->getIdClase());
    	$OM = $conn->real_escape_string($p->getOM());
    	$id_tutor_legal = $conn->real_escape_string($p->getIdTutor());
    	$fecha_nacimiento = $conn->real_escape_string($p->getFecha());
    	$id_calificaciones = $conn->real_escape_string($p->getCal());
    	$foto = $conn->real_escape_string($p->getFoto());

     	$query = "INSERT INTO alumnos VALUES  ( '$DNI' , '$nombre' , '$ap1' , '$ap2' , '$id_centro' , '$id_clase' , '$OM' , '$id_tutor_legal' , '$fecha_nacimiento' , '$id_calificaciones' , '$foto')";
    	$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));

    }
    public function getTotalAlumnos(){
			$app = Aplicacion::getSingleton();
			$conn = $app->conexionBD();

			$query="SELECT * FROM alumnos";
			$result = $conn->query($query)
							or die ($conn->error. " en la línea ".(__LINE__-1));
					$rows = $result->num_rows;
					$result->free();

					return $rows;
		}


	public function delete($p) {
		$query("DELETE Usuarios where id = '" . $p->id . "'");
	}

	public function getAlumno($alumno) {
		$app = Aplicacion::getSingleton();
		$conn = $app->conexionBD();

		$query = sprintf("SELECT * from alumnos where DNI = '%s'", $conn->real_escape_string($alumno->getDNI()));
		$result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
		if($result->num_rows > 0){
            $fila = $result->fetch_assoc();

            $alumno->setDNI($fila['DNI']);
            $alumno->setNombre($fila['nombre']);
            $alumno->setAp1($fila['apellido1']);
            $alumno->setAp2($fila['apellido2']);
            $alumno->setIdCentro($fila['id_centro']);
            $alumno->setIdClase($fila['id_clase']);
            $alumno->setOM($fila['observaciones_medicas']);
            $alumno->setTutor($fila['id_tutor_legal']);
            $alumno->setFecha($fila['fecha_nacimiento']);
            $alumno->setCal($fila['id_calificaciones']);
            $alumno->setFoto($fila['foto']);
        }
	}

    public function getClase($id) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from clases where id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        else{
            return NULL;
        }
    }

    public function getCentro($id) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from centros where id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return $p;
    }

    public function getTutor($id) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from tutor_legal where id = '%s'", $conn->real_escape_string($id));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }
        return $p;
    }

    public function getProfesores($idClase) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $filaClase = self::getClase($idClase);
        $conn = $app->conexionBD();

        $a1 = $conn->real_escape_string($filaClase["id_asignatura1"]);
        $a2 = $conn->real_escape_string($filaClase["id_asignatura2"]);
        $a3 = $conn->real_escape_string($filaClase["id_asignatura3"]);
        $a4 = $conn->real_escape_string($filaClase["id_asignatura4"]);
        $a5 = $conn->real_escape_string($filaClase["id_asignatura5"]);
        $a6 = $conn->real_escape_string($filaClase["id_asignatura6"]);
        $sql = "SELECT id_profesor, nombre_asignatura FROM asignaturas WHERE id = '$a1' || id = '$a2' || id = '$a3' || id = '$a4' || id = '$a5' || id = '$a6'";
        $result = $conn->query($sql)
                    or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result;
        }

        return $p;
    }

    public function getProfe($id_profe) {
        $p = NULL;
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $query = sprintf("SELECT * from profesores where id = '%s'", $conn->real_escape_string($id_profe));
        $result = $conn->query($query)
            or die ($conn->error. " en la línea ".(__LINE__-1));
        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }

        return $p;
    }

		public function claseActual($alumno) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $idClase = $conn->real_escape_string($alumno->getIdClase());
				$filaClase = self::getClase($idClase);
				$asignaturas = array();
				$asignaturas[1] = $filaClase['id_asignatura1'];
				$asignaturas[2] = $filaClase['id_asignatura2'];
				$asignaturas[3] = $filaClase['id_asignatura3'];
				$asignaturas[4] = $filaClase['id_asignatura4'];
				$asignaturas[5] = $filaClase['id_asignatura5'];
				$asignaturas[6] = $filaClase['id_asignatura6'];

				foreach ($asignaturas as &$value) {
					$query = sprintf("SELECT * from asignaturas where id = '%s'", $value);
					$result = $conn->query($query)
							or die ($conn->error. " en la línea ".(__LINE__-1));

					$filaAsignatura = $result->fetch_assoc();

					if(date('l') === "Monday" && date('H:i:s') >= $filaAsignatura['lunes_inicio'] && date('H:i:s') <= $filaAsignatura['lunes_fin']){
						$rs = array();
						$rs["nombre"] = $filaAsignatura['nombre_asignatura'];
						$rs["hora_ini"] = $filaAsignatura['lunes_inicio'];
						$rs["hora_fin"] = $filaAsignatura['lunes_fin'];
						return $rs;
					}
					elseif(date('l') === "Tuesday" && date('H:i:s') >= $filaAsignatura['martes_inicio'] && date('H:i:s') <= $filaAsignatura['martes_fin']){
						$rs = array();
						$rs["nombre"] = $filaAsignatura['nombre_asignatura'];
						$rs["hora_ini"] = $filaAsignatura['martes_inicio'];
						$rs["hora_fin"] = $filaAsignatura['martes_fin'];
						return $rs;
					}
					elseif(date('l') === "Wednesday" && date('H:i:s') >= $filaAsignatura['miercoles_inicio'] && date('H:i:s') <= $filaAsignatura['miercoles_fin']){
						$rs = array();
						$rs["nombre"] = $filaAsignatura['nombre_asignatura'];
						$rs["hora_ini"] = $filaAsignatura['miercoles_inicio'];
						$rs["hora_fin"] = $filaAsignatura['miercoles_fin'];
						return $rs;
					}
					elseif(date('l') === "Thursday" && date('H:i:s') >= $filaAsignatura['jueves_inicio'] && date('H:i:s') <= $filaAsignatura['jueves_fin']){
						$rs = array();
						$rs["nombre"] = $filaAsignatura['nombre_asignatura'];
						$rs["hora_ini"] = $filaAsignatura['jueves_inicio'];
						$rs["hora_fin"] = $filaAsignatura['jueves_fin'];
						return $rs;
					}
					elseif(date('l') === "Friday" && date('H:i:s') >= $filaAsignatura['viernes_inicio'] && date('H:i:s') <= $filaAsignatura['viernes_fin']){
						$rs = array();
						$rs["nombre"] = $filaAsignatura['nombre_asignatura'];
						$rs["hora_ini"] = $filaAsignatura['viernes_inicio'];
						$rs["hora_fin"] = $filaAsignatura['viernes_fin'];
						return $rs;
					}
				}
				return null;
    }

		public function proxClase($alumno) {
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBD();

        $idClase = $conn->real_escape_string($alumno->getIdClase());
				$filaClase = self::getClase($idClase);
				$asignaturas = array();
				$asignaturas[1] = $filaClase['id_asignatura1'];
				$asignaturas[2] = $filaClase['id_asignatura2'];
				$asignaturas[3] = $filaClase['id_asignatura3'];
				$asignaturas[4] = $filaClase['id_asignatura4'];
				$asignaturas[5] = $filaClase['id_asignatura5'];
				$asignaturas[6] = $filaClase['id_asignatura6'];

				$rs = array();
				$rs[0] = null;
				$rs[1] = null;
				$rs[2] = null;
				$rs[3] = null;
				$rs[4] = null;

				foreach ($asignaturas as &$value) {
					$query = sprintf("SELECT * from asignaturas where id = '%s'", $value);
					$result = $conn->query($query)
							or die ($conn->error. " en la línea ".(__LINE__-1));

					$filaAsignatura = $result->fetch_assoc();

					if($filaAsignatura['lunes_inicio'] != null){
						if(date('l') === "Monday" && date('H:i:s') < $filaAsignatura['lunes_inicio']){
							if($rs[0] == null || $rs[0]['hora_ini'] > $filaAsignatura['lunes_inicio']){
								$rs[0]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[0]["dia"] = "Lunes";
								$rs[0]["hora_ini"] = $filaAsignatura['lunes_inicio'];
								$rs[0]["hora_fin"] = $filaAsignatura['lunes_fin'];
							}
						}
						elseif(date('l') !== "Monday"){
							if($rs[0] == null || $rs[0]['hora_ini'] > $filaAsignatura['lunes_inicio']){
								$rs[0]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[0]["dia"] = "Lunes";
								$rs[0]["hora_ini"] = $filaAsignatura['lunes_inicio'];
								$rs[0]["hora_fin"] = $filaAsignatura['lunes_fin'];
							}
						}
					}


					if($filaAsignatura['martes_inicio'] != null){
						if(date('l') === "Tuesday" && date('H:i:s') < $filaAsignatura['martes_inicio']){
							if($rs[1] == null || $rs[1]['hora_ini'] > $filaAsignatura['martes_inicio']){
								$rs[1]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[1]["dia"] = "Martes";
								$rs[1]["hora_ini"] = $filaAsignatura['martes_inicio'];
								$rs[1]["hora_fin"] = $filaAsignatura['martes_fin'];
							}
						}
						elseif(date('l') !== "Tuesday"){
							if($rs[1] == null || $rs[1]['hora_ini'] > $filaAsignatura['martes_inicio']){
								$rs[1]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[1]["dia"] = "Martes";
								$rs[1]["hora_ini"] = $filaAsignatura['martes_inicio'];
								$rs[1]["hora_fin"] = $filaAsignatura['martes_fin'];
							}
						}
					}


					if($filaAsignatura['miercoles_inicio'] != null){
						if(date('l') === "Wednesday" && date('H:i:s') < $filaAsignatura['miercoles_inicio']){
							if($rs[2] == null || $rs[2]['hora_ini'] > $filaAsignatura['miercoles_inicio']){
								$rs[2]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[2]["dia"] = "Miércoles";
								$rs[2]["hora_ini"] = $filaAsignatura['miercoles_inicio'];
								$rs[2]["hora_fin"] = $filaAsignatura['miercoles_fin'];
							}
						}
						elseif(date('l') !== "Wednesday"){
							if($rs[2] == null || $rs[2]['hora_ini'] > $filaAsignatura['miercoles_inicio']){
								$rs[2]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[2]["dia"] = "Miércoles";
								$rs[2]["hora_ini"] = $filaAsignatura['miercoles_inicio'];
								$rs[2]["hora_fin"] = $filaAsignatura['miercoles_fin'];
							}
						}
					}


					if($filaAsignatura['jueves_inicio'] != null){
						if(date('l') === "Thursday" && date('H:i:s') < $filaAsignatura['jueves_inicio']){
							if($rs[3] == null || $rs[3]['hora_ini'] > $filaAsignatura['jueves_inicio']){
								$rs[3]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[3]["dia"] = "Jueves";
								$rs[3]["hora_ini"] = $filaAsignatura['jueves_inicio'];
								$rs[3]["hora_fin"] = $filaAsignatura['jueves_fin'];
							}
						}
						elseif(date('l') !== "Thursday"){
							if($rs[3] == null || $rs[3]['hora_ini'] > $filaAsignatura['jueves_inicio']){
								$rs[3]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[3]["dia"] = "Jueves";
								$rs[3]["hora_ini"] = $filaAsignatura['jueves_inicio'];
								$rs[3]["hora_fin"] = $filaAsignatura['jueves_fin'];
							}
						}
					}


					if($filaAsignatura['viernes_inicio'] != null){
						if(date('l') === "Friday" && date('H:i:s') < $filaAsignatura['viernes_inicio']){
							if($rs[4] == null || $rs[4]['hora_ini'] > $filaAsignatura['viernes_inicio']){
								$rs[4]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[4]["dia"] = "Viernes";
								$rs[4]["hora_ini"] = $filaAsignatura['viernes_inicio'];
								$rs[4]["hora_fin"] = $filaAsignatura['viernes_fin'];
							}
						}
						elseif(date('l') !== "Friday"){
							if($rs[4] == null || $rs[4]['hora_ini'] > $filaAsignatura['viernes_inicio']){
								$rs[4]["nombre"] = $filaAsignatura['nombre_asignatura'];
								$rs[4]["dia"] = "Viernes";
								$rs[4]["hora_ini"] = $filaAsignatura['viernes_inicio'];
								$rs[4]["hora_fin"] = $filaAsignatura['viernes_fin'];
							}
						}
					}
				}

				$i = 0;
				if(date('l') === "Monday"){
					$i = 0;
				}
				elseif(date('l') === "Tuesday"){
					$i = 1;
				}
				elseif(date('l') === "Wednesay"){
					$i = 2;
				}
				elseif(date('l') === "Thursday"){
					$i = 3;
				}
				elseif(date('l') === "Friday"){
					$i = 4;
				}
				elseif(date('l') === "Saturday"){
					$i = 0;
				}
				elseif(date('l') === "Sunday"){
					$i = 0;
				}

				$end = $i;
				if($rs[$i] != null){
					return $rs[$i];
				}
				$i = $i+1;
				while($end != $i){
					if($i == 5){
						$i = 0;
					}
					if($rs[$i] != null){
						return $rs[$i];
					}
					$i = $i+1;
				}
				return null;
    }
}

?>
