<?php
require_once('DAOIncidencias.php');

$idao = new IncidenciasDAO();
$id = $idao->getNumIncidencias() + 1;

$i = new Incidencia($id, $_REQUEST["idAsignatura"], $_REQUEST["idAlumno"], $_REQUEST["incidencia"]);
$id = $idao->insertIncidencia($i);

header("Location: ../incidencias_profesor.php?id=".$_REQUEST["idAlumno"]."&idAsignatura=".$_REQUEST["idAsignatura"]);
?>
