<?php
//Artur Amon 2020
require_once('google-calendar-api.php');//para poder acceder a los google calendar del usuario
require_once('calendarioAjustes.php');  //Los codigos de permiso de google

/*Accede al calendario de google para lectura*/
if(isset($_GET['code'])) {
    try {
        $capi = new GoogleCalendarApi();
        $data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
        $_SESSION['access_token'] = $data['access_token'];

    }
    catch(Exception $e) {
        echo $e->getMessage();
        exit();
    }
}
else{
    header('Location: ../Educazone3.0/calendarioAcceso.php'); //redirige a la pagina de acceso de google
}


require_once __DIR__ . '/include/dao/Incidencias.php';
require_once __DIR__ . '/include/config.php';
include("include/comun/cabecera.php");
include("include/comun/sidebarIzqProfesor.php");
include("include/comun/sidebarDerProfesor.php");
include("include/comun/pie.php");
include("include/dao/Padre.php");
include("include/dao/Alumno.php");
include("include/dao/Centro.php");

if($_SESSION['rol'] == "profesor")/*Si es profesor, recibe su centro y lo guarda en $colegio*/{
    $profesor = new Profesor();
    $profesor->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
    $profesor->getProfe();
    $colegio = substr(preg_replace("/\([^)]+\)/", "", $profesor->getCentro()), 0, -1);

    $calendar = $capi->GetCalendarsList($data['access_token']);
    $contadorCalendarioUnico = 0;

    while($contadorCalendarioUnico < count($calendar) && strcmp($calendar[$contadorCalendarioUnico]["summary"], $colegio) != 0){
        $contadorCalendarioUnico++;
    }
    if($contadorCalendarioUnico < count($calendar)){
        $IDcolegio = $calendar[$contadorCalendarioUnico]["id"];
        echo '<iframe src="https://calendar.google.com/calendar/embed?height=650&amp;wkst=2&amp;bgcolor=%2331a36e&amp;ctz=Europe%2FMadrid&amp;src='. $IDcolegio .'&amp;color=%23039BE5&amp;showTitle=1&amp;showNav=1&amp;showDate=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0" style="border:solid 1px #777" width="900" height="650" frameborder="0" scrolling="no"></iframe>';
    }
    else {
        echo "no se ha encontrado un calendario con nombre: ". $colegio . ". Revise si el calendario registrado es el correcto y si existe el calendario de su colegio.";
    }

}
else/*Si es padre recorre todos los centros de sus hijos y muestra todos los calendarios disponibles*/{
    $padre = new Padre();
    $padre->setUsuario(htmlspecialchars(trim(strip_tags($_SESSION["name"]))));
    $padre->getPadre();
    $hijos = $padre->getHijos();
    $centros = array();
    while($filaAlumno = $hijos->fetch_assoc()){
        $hijoTemp = new Alumno();
        array_push($centros, $filaAlumno['id_centro']);
    }

    array_unique($centros);

    $calendar = $capi->GetCalendarsList($data['access_token']);
    foreach ($centros as $cole){

        $centro = new Centro();
        $colegio = $centro->getNombrePorID($cole);
        error_reporting(E_ERROR | E_PARSE);
        $contadorCalendarioUnico = 0;
        while($contadorCalendarioUnico < count($calendar) && strcmp($calendar[$contadorCalendarioUnico]["summary"], $colegio) != 0){
            $contadorCalendarioUnico++;
        }
        if($contadorCalendarioUnico < count($calendar)){
            $IDcolegio = $calendar[$contadorCalendarioUnico]["id"];
            echo '<iframe src="https://calendar.google.com/calendar/embed?height=650&amp;wkst=2&amp;bgcolor=%2331a36e&amp;ctz=Europe%2FMadrid&amp;src='. $IDcolegio .'&amp;color=%23039BE5&amp;showTitle=1&amp;showNav=1&amp;showDate=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0" style="border:solid 1px #777" width="900" height="650" frameborder="0" scrolling="no"></iframe>';
        }
        else
            echo "no se ha encontrado un calendario con nombre: ". $colegio . ". Revise si el calendario registrado es el correcto y si existe el calendario de su colegio.";
    }
}


