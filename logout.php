<?php
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<meta charset="utf-8">
</head>
<body>
	<div id="logout">
		<?php
			session_destroy();
			header("Location: index.php");
		?>
	</div>
</body>
</html>
