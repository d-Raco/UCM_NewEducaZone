<?php
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<div id="logout">
		<?php
			session_destroy();
			$url = "https://vm11.aw.e-ucm.es/EducaZone4.0/index.php";
			echo "<script>window.open('".$url."','_self');</script>";
			//header("Location: ./index.php");
			//exit;
		?>
	</div>
</body>
</html>
