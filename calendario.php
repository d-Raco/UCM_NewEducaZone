<?php
require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<link rel="stylesheet" href="css/fullcalendar.min.css">
<script src="js/fullcalendar.min.js"></script>
<script src="js/es.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
.fc th {
	padding: 10px 0px;
	vertical-align: middle;
	background: #F2F2F2;
}
</style>
<body>
<div class ="contenido">
    <?php
      include("include/comun/cabecera.php");
      if($_SESSION['rol'] == 'profesor'){
        include("include/comun/sidebarIzqProfesor.php");
      }
      else{
        include("include/comun/sidebarIzqPadre.php");
      }
    ?>
	<div class="container">
		<div class="col"></div>
		<div class="col-7"><br/><br/><div id="Calendario"></div></div>
		<div class="col"></div>
	</div>
	
<script>
$(document).ready(function() {
	$('#Calendario').fullCalendar({
		header:{
			left:'today,prev,next',
			center:'title',
			right:'month,basicWeek,agendaWeek,agendaDay'
		},
		dayClick:function(date,jsEvent,view){
			$('#btnAgregar').prop("disabled",false);
			$('#btnEliminar').prop("disabled",true);
			$('#btnModificar').prop("disabled",true);
			
			limpiarFormulario();
			$('#txtFecha').val(date.format());
			$("#ModalEventos").modal();
		},
		events:'http://localhost/EducaZone4.0/eventos.php',
		eventClick:function(calEvent, jsEvent, view) {
			$('#btnAgregar').prop("disabled",true);
			$('#btnEliminar').prop("disabled",false);
			$('#btnModificar').prop("disabled",false);
		
			$('#tituloEvento').html(calEvent.title);
			$('#txtDescripcion').val(calEvent.descripcion);
			$('#txtId').val(calEvent.id);
			$('#txtTitulo').val(calEvent.title);
			$('#txtColor').val(calEvent.color);
			FechaHora = calEvent.start._i.split(" ");
			$('#txtFecha').val(FechaHora[0]);
			$('#txtHora').val(FechaHora[1]);
			$("#ModalEventos").modal();
		}
	});
});


</script>
<!--Modal para agregar, modificar y eliminar!-->
	<div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="tituloEvento"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<input type="hidden" id="txtId" name="txtId" />
			Fecha: <input type="text" id="txtFecha" name="txtFecha" />
			
			<div class="form-row">
				<div class="form-group col-md-8">
					<label>Título:</label>
					<input type="text" id="txtTitulo" class="form-control" placeholder="Título del evento..."/>
				</div>
				<div class="form-group col-md-4">
					<label>Hora del evento:</label>
					<input type="text" id="txtHora" class="form-control" value="9:30"/>
				</div>
			</div>
			<div class="form-group">
				<label>Descripcion:</label>
				<input type="text" id="txtDescripcion" class="form-control"><br/>
			</div>
			<div class="form-group">
				<label>Color:</label>
				<input type="color" value="#ff0000" id="txtColor" class="form-control"/>
			</div>
		  </div>
		  <div class="modal-footer">
		  <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
		  <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
		  <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		  </div>
		</div>
	  </div>
	</div>
</div>
<script>
var NuevoEvento;
$('#btnAgregar').click(function() {
	RecolectarDatosGUI();
	EnviarInformacion('agregar',NuevoEvento);
});
$('#btnEliminar').click(function() {
	RecolectarDatosGUI();
	EnviarInformacion('eliminar',NuevoEvento);
});
$('#btnModificar').click(function() {
	RecolectarDatosGUI();
	EnviarInformacion('modificar',NuevoEvento);
});

function RecolectarDatosGUI() {
	NuevoEvento = {
		id:$('#txtId').val(),
		title:$('#txtTitulo').val(),
		start:$('#txtFecha').val()+" "+$('#txtHora').val(),
		color:$('#txtColor').val(),
		descripcion:$('#txtDescripcion').val(),
		end:$('#txtFecha').val()+" "+$('#txtHora').val()
	};
}

function EnviarInformacion(accion,objEvento) {
	$.ajax({
		type:'POST',
		url:'eventos.php?accion='+accion,
		data:objEvento,
		success:function(msg){
			if(msg) {
				$('#Calendario').fullCalendar('refetchEvents');
				$("#ModalEventos").modal('toggle');
			}
		},
		error:function() {
			alert("Hay un error...");
		}
	});
}

function limpiarFormulario() {
$('#tituloEvento').html('');
	$('#txtId').val('');
	$('#txtTitulo').val('');
	$('#txtColor').val('');
	$('#txtDescripcion').val('');
}
</script>
</body>
</html>