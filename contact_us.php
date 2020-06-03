<?php
	require_once __DIR__ . '/include/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/contactus.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#contact-form").validate({
        event: "blur",rules: {'name': "required", 'apellido1': "required",'email': "required email",'message': "required"},
        messages: {'name': "Por favor indica tu nombre",'apellido1': "Por favor indica tu apellido",'email': "Por favor, indica una direcci&oacute;n de e-mail v&aacute;lida",'message': "Por favor, dime algo!"},
        debug: true,errorElement: "label",
        submitHandler: function(form){
            $("#alert").show();
            $("#alert").html("<img src='img/ajax-loader.gif' style='vertical-align:middle;margin:0 10px 0 0;' /><strong>Enviando mensaje...</strong>");
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 10000);
            $.ajax({
                type: "POST",
                url:"include/send_info_contact_us.php",
                data: "name="+escape($('#name').val())+"&apellido1="+escape($('#apellido1').val())+"&apellido2="+escape($('#apellido2').val())+"&email="+escape($('#email').val())+"&message="+escape($('#message').val()),
                success: function(msg){
                    $("#alert").html(msg);
                    document.getElementById("name").value="";
					document.getElementById("apellido1").value="";
					document.getElementById("apellido2").value="";
                    document.getElementById("email").value="";
                    document.getElementById("message").value="";
                    setTimeout(function() {
                        $('#alert').fadeOut('slow');
                    }, 5000);

                }
            });
        }
    });
});
</script>
</head>
<body>
<?php
      include("include/comun/cabecera.php");
?>
<div class="container">
    <h1>Contact us</h1></br>
    <div class="row">
        <div id="content" class="col-lg-12">
            <div class="alert alert-success" id="alert" style="display: none;">&nbsp;</div>
            <form id="contact-form" method="post">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Introduce tu nombre">
                </div>
				
				<div class="form-group">
                    <label for="apellido1">Primer Apellido</label>
                    <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Introduce tu primer apellido">
                </div>
				
				<div class="form-group">
                    <label for="apellido2">Segundo Apellido</label>
                    <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Introduce tu segundo apellido">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Introduce tu email">
                </div>
				
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <input class="btn btn-primary submit" type="submit" value="Enviar" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
