<?php
require_once __DIR__ . '/include/config.php';
//session_start();
//$profe = $_GET["p"];
//$usuarioProfe = htmlspecialchars(trim(strip_tags($_GET["profe"])));
//$_SESSION["name"] = $p->getNombre();
//$_SESSION["profesor"] = $p;
//echo $_SESSION["name"];
//echo $usuarioProfe->getNombre();
?>
<div id="signin">
    <form method="get" action="include/process_editarProfe.php">
        Nombre:
      <input type="text" name="nombre" />
      <br>
        Primer apellido:
      <input type="text" name="apellido1" />
      <br>
        Segundo apellido:
      <input type="text" name="apellido2" />
      <br>
        Despacho:
      <input type="text" name="despacho" />
      <br>
        Correo electrónico:
      <input type="text" name="correo" />
      <br>

      <input type="submit" value="Enviar">
    </form>
  </div>
