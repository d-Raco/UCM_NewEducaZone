<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	  <link rel="stylesheet" type="text/css" href="css/contact.css">
  </head>
  <body>
  <?php
    include("include/comun/cabecera.php");
  ?>

	<div class="blackboard">
		<div class="form">
			<p>
					<label>Name: </label>
					<input type="text" />
			</p>
			<p>
					<label>Email: </label>
					<input type="text" />
			</p>
			<p>
					<label>Phone: </label>
					<input type="tel" />
			</p>
			<p>
					<label>Message: </label>
					<textarea></textarea>
			</p>
			<p class="wipeout">
					<input type="submit" value="Send" />
			</p>
		</div>
	</div>
  </body>
</html>
