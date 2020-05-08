<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Profesor.php';

$pdao = new Profesor();
$p = $pdao->getProfe(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
//nombre, apellido1, apellido2, despacho, correo
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["nombre"])));
$apellido1 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido1"])));
$apellido2 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido2"])));
$despacho = htmlspecialchars(trim(strip_tags($_REQUEST["despacho"])));
$correo = htmlspecialchars(trim(strip_tags($_REQUEST["correo"])));
$id = $p->getIdProfesor(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
$p->updateDatosProfesor($nombre, $apellido1, $apellido2,$despacho, $correo,$id);
   header("Location: ../ver_profesor.php");

//session_start();
//$name = $_SESSION["name"];
//$p = $_SESSION["profesor"];
//echo $name;
//echo $p->getNombre();



//echo "<a href=\"../ver_profesor.php\">perfil</a>";
//echo "<a href=\"../ver_profesor.php\">Login</a>";
//$pdao = new ProfeDao();
//$p = $pdao->getProfe(htmlspecialchars(trim(strip_tags($name))));
//$profe = $_GET["p"];
//echo $profe->getNombre();
//echo $profe->getNombre();
?>
