<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/dao/Archivos_foro.php';

$archivo = new Archivos_foro();
$archivo->setId(htmlspecialchars(trim(strip_tags($_REQUEST["id"]))));
$archivo->getArchivoById();

if($archivo->getId() != 0){
  header('Content-Length: '.$archivo->getTamañoArchivo());
  header('Content-Type: '.$archivo->getTipoArchivo());
  header('Content-Disposition: attachment; filename="'.$archivo->getNombreArchivo().'"');
  header('Content-Transfer-Encoding: binary');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  ob_clean();
  flush();
  $content = stripslashes($archivo->getArchivo());
  echo $content;

}
