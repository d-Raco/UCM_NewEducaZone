<? php
require_once __DIR__ . '/include/config.php';
?>
<div id="signin">
    <form method="get" action="include/process_editarPadre.php">
        Nombre:
      <input type="text" name="nombre" />
      <br>
        Primer apellido:
      <input type="text" name="apellido1" />
      <br>
        Segundo apellido:
      <input type="text" name="apellido2" />
      <br>
        Correo electrónico:
      <input type="text" name="correo" />
      <br>
        Teléfono movil:
      <input type="text" name="telefono_movil" />
      <br>
         Teléfono fijo:
      <input type="text" name="telefono_fijo" />
      <br>


      <input type="submit" value="Enviar">
    </form>
  </div>
