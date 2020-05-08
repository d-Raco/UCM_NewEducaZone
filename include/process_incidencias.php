<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Incidencias.php';


$idao = new Incidencias();
$id = $idao->getNumIncidencias() + 1;

$i = new Incidencias($id, htmlspecialchars(trim(strip_tags($_REQUEST["idAsignatura"]))), htmlspecialchars(trim(strip_tags($_REQUEST["idAlumno"]))), htmlspecialchars(trim(strip_tags($_REQUEST["incidencia"]))));
$id = $idao->insertIncidencia($i);

header("Location: ../incidencias_profesor.php?id=".htmlspecialchars(trim(strip_tags($_REQUEST["idAlumno"])))."&idAsignatura=".htmlspecialchars(trim(strip_tags($_REQUEST["idAsignatura"]))));
?>
