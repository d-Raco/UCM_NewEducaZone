<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/DAO_Mensajes.php';

$msg = new Mensajes();
$mensajeDao = new DAO_Mensajes();
$msg->setId(htmlspecialchars(trim(strip_tags($_GET["id"]))));
$mensajeDao->getMensajeById($msg);

if($msg->getId() !== 0){
  header('Content-Description: File Transfer');
  header('Content-Length: '.$msg->getTamanoArchivo());
  header('Content-Type: '.$msg->getTipoArchivo());
  header('Content-Disposition: attachment; filename="'.$msg->getNombreArchivo().'"');
  header('Content-Transfer-Encoding: binary');
  header('Pragma: public');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  readfile("..//" .$msg->getArchivo());
}
exit;
