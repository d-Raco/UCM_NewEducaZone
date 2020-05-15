<?php
	require_once __DIR__ . '/include/config.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Google Maps</title>
<link href="css/faqs.css" rel="stylesheet">
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/jquery.gomap-1.3.3.min.js"></script>
<script>
	$(document).ready(function() {
		$("#mapa").goMap({
			latitude:39.3152286,
			longitude:-4.4280326,
			zoom:5,
			maptype:"ROAD",
			scaleControl:true
		});

		$.goMap.createMarker({
			latitude:40.4540569,
			longitude:-3.719767,
			html:{
				content:"<h3>CEIP Agua dulce</h3><p>Calle De Leñeros 25, 28039</p>",
				popup:true
			}
		});
		$.goMap.createMarker({
			latitude:40.3944852,
			longitude:-3.6493599,
			html:{
				content:"<h3>Colegio Amanecer</h3><p>Calle Del Titanio 7, 28032</p>",
				popup:true
			}
		});
		$.goMap.createMarker({
			latitude:37.4307832,
			longitude:-6.1292143,
			html:{
				content:"<h3>IES Miguel de Cervantes</h3><p>Virgen del Consuelo 26, 41449</p>",
				popup:true
			}
		});
		$.goMap.createMarker({
			latitude:41.8471812,
			longitude:-1.7096252,
			html:{
				content:"<h3>Nuestra Señora del Castillo</h3><p>Avenida de la Portalada 39, 50630</p>",
				popup:true
			}
		});
		$.goMap.createMarker({
			latitude:41.5323547,
			longitude:2.4091656,
			html:{
				content:"<h3>Escola Sant Miquel del Cros</h3><p>Av. del Mediterrani, 08310</p>",
				popup:true
			}
		});
	});
</script>
<script>
$(document).ready(function(){
	$(".respuesta").hide();
		$("button").click(function(){
		$(this).next(".respuesta").fadeToggle();
		$(this).toggleClass("cerrar");
	});
});
</script>

</head>
<body>
	<?php
      include("include/comun/cabecera.php");
    ?>
    <div class="content_faqs">
    	<h2>Preguntas frecuentes (FAQS)</h2>
    	<div class="flex_btn">
			<button class="faqs" style="vertical-align:middle"><span>¿Para que sirve esta aplicación web?</span></button>
			<div class="respuesta">
				<p>EducaZone es una aplicación para colegios y escuelas infantiles que mantiene informadas a las familias de la vida escolar de sus hijos. Una plataforma que comunica y comparte información entre profesores y padres de manera intuitiva y accesible.</p>
		  	</div>
		</div>
		<div class="flex_btn">
			<button class="faqs" style="vertical-align:middle"><span>¿Cómo puedo registrarme si me pide un código de acceso?</span></button>
		  	<div class="respuesta">
				<p>EducaZone realizó un acuerdo de códigos de acceso de nuestros centros registrados en la aplicación web para así garantizar la seguridad del centro. Dicho código se puede conseguir a través de la secretaría del centro educativo.</p>
		  	</div>
		</div>
		<div class="flex_btn">
			<button class="faqs" style="vertical-align:middle"><span>¿Qué sucede si tengo más de un hijo matriculado en un centro?</span></button>
		  	<div class="respuesta">
				<p>EducaZone gracias a sus desarrolladores ha podido implementar la opción de tener sus hijos en su perfil, en el cual podrá gestionar el curso académico de ambos.</p>
		  	</div>
		</div>
		<div class="flex_btn">
			<button class="faqs" style="vertical-align:middle"><span>¿Dónde puedo cambiar mi contraseña de usuario?</span></button>
		  	<div class="respuesta">
				<p>En el perfil de usuario se facilita la opción de "Editar" con la que podrá modificar la información que usted desee. En caso de que usted ha olvidado la contraseña por favor le rogamos que contacte con nosotros en:<a href="www.EducaZone.com/support">Help</a></p>
		  	</div>
		</div>
	</div>
	<h1 class="centros">Centros educativos que usan nuestra aplicación web</h1>
	<div class="principal">
	    <div id="mapa"></div>
	</div>

</body>
</html>
