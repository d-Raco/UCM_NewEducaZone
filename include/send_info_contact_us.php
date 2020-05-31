<?php
require_once __DIR__ . '/config.php';

echo 'Gracias '.$_POST['name'].' '.$_POST['apellido1'].' '.$_POST['apellido2'].', hemos recibido su mensaje correctamente.';

$msg = $_POST['message'];

$msg = wordwrap($msg,70);

//mail("calendarioscolegioeducazone@gmail.com",$_POST['email'],$msg);
echo ' En una aplicación web real dispondríamos de un servidor SMTP propio para enviar este mensaje a nuestro correo personal';
?>
