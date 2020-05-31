<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/DAO_Archivos_foro.php';

$archivo = new DAO_Archivos_foro();
$arch = new Archivos_foro();
$arch->setId(htmlspecialchars(trim(strip_tags($_REQUEST["id"]))));
$archivo->getArchivoById($arch);

if($arch->getId() !== 0){
  header('Content-Description: File Transfer');
  header('Content-Length: '.$arch->getTamanoArchivo());
  header('Content-Type: '.$arch->getTipoArchivo());
  header('Content-Disposition: attachment; filename="'.$arch->getNombreArchivo().'"');
  header('Content-Transfer-Encoding: binary');
  header('Pragma: public');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  readfile("..//" .$arch->getArchivo());
}
exit;
