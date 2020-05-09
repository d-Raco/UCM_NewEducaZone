<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Mensajes.php';

$mensaje = new Mensajes();
$mensaje->setId($_GET["id"]);
$mensaje->getMensajeById();

header('Content-Length: '.$mensaje->getTamañoArchivo());
header('Content-Type: '.$mensaje->getTipoArchivo());
header('Content-Disposition: attachment; filename="'.$mensaje->getNombreArchivo().'"');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
ob_clean();
flush();
$content = stripslashes($mensaje->getArchivo());
echo $content;
