<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Padre.php';

$pdao = new Padre();
$p = $pdao->getPadre(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
//nombre, apellido1, apellido2, despacho, correo
$nombre = htmlspecialchars(trim(strip_tags($_REQUEST["nombre"])));
$apellido1 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido1"])));
$apellido2 = htmlspecialchars(trim(strip_tags($_REQUEST["apellido2"])));
$telefono_movil = htmlspecialchars(trim(strip_tags($_REQUEST["telefono_movil"])));
$telefono_fijo = htmlspecialchars(trim(strip_tags($_REQUEST["telefono_fijo"])));
$correo = htmlspecialchars(trim(strip_tags($_REQUEST["correo"])));
$id = $p->getIdPadre(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
$p->updateDatosPadre($nombre, $apellido1, $apellido2,$telefono_movil, $telefono_fijo,$correo,$id);
   header("Location: ../ver_padre.php");

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
