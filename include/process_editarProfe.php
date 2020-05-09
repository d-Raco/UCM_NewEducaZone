<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Profesor.php';

$profesor = new Profesor();
$profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
$profesor->getProfe();
//nombre, apellido1, apellido2, despacho, correo
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["nombre"])));
$apellido1 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido1"])));
$apellido2 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido2"])));
$despacho = htmlspecialchars(trim(strip_tags($_REQUEST["despacho"])));
$correo = htmlspecialchars(trim(strip_tags($_REQUEST["correo"])));
$profesor->updateDatosProfesor($nombre, $apellido1, $apellido2,$despacho, $correo);
   header("Location: ../ver_profesor.php");

//session_start();
//$name = $_SESSION["name"];
//$profesor = $_SESSION["profesor"];
//echo $name;
//echo $profesor->getNombre();



//echo "<a href=\"../ver_profesor.php\">perfil</a>";
//echo "<a href=\"../ver_profesor.php\">Login</a>";
//$profesor = new ProfeDao();
//$profesor = $profesor->getProfe(htmlspecialchars(trim(strip_tags($name))));
//$profesorrofe = $_GET["p"];
//echo $profesorrofe->getNombre();
//echo $profesorrofe->getNombre();
?>
