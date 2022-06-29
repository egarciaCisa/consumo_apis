<?php 
session_start();

//rutas de sistema

$ruta = ControladorRuta::ctrRuta();
$htacces = "index.php?pagina=";

//controladores Tyrecheck
$ultimoRegistro_Tyrecheck = ControladorTyrecheck::ctrMostrarConsulta(null,null);
$ultimoRegistro_Tyrecheck = (count($ultimoRegistro_Tyrecheck));
$ultimoRegistro_Tyrecheck = $ultimoRegistro_Tyrecheck+1;
$nombre_tyrecheck = "Tyrecheck";
$fechaCountdown_Tyrecheck = ControladorInicio::ctrMostrarConsultaControlador("nombreApi",$nombre_tyrecheck);

$ultimoRegistro_Cloudcore = ControladorCloudcore::ctrMostrarConsulta(null,null);
$ultimoRegistro_Cloudcore = (count($ultimoRegistro_Cloudcore));
$ultimoRegistro_Cloudcore = $ultimoRegistro_Cloudcore+1;
$nombre_cloudcore = "Cloudcore";
$fechaBaseDatos_Cloudcore = ControladorInicio::ctrMostrarConsultaControlador("nombreApi",$nombre_cloudcore);

//contorladores de tiempo

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha.' '.$hora;
$controlador = ControladorInicio::ctrMostrarConsultaControlador(null,null);

function actualizarConsultaGetTime($fechaActual,$setTime){

	if ($setTime <= $fechaActual){

		//echo '<script>alert("SetTie menor");</script>';

		return "nel";

	}else{

		//echo '<script>alert("SetTie mayor");</script>';
		
		return "ok";
	}


}
if($controlador){

	foreach ($controlador as $key => $value) {

		$arrayTime[$key] = array(
			"actualizar" => actualizarConsultaGetTime($fechaActual,$value["settime"]),
			"setTime" => $value["setTime"],
			"fechaInicio" => substr($value["fechaInicio"],0,-9),
			"fechaFinal" => substr($value["fechaFinal"],0,-9),
			"consulta" => $value["consulta"],
			"valueSetTime" => $value["ValueSetTime"],
			"paginaInicio" => $value["paginaInicio"],
			"paginaFinal" => $value["paginaFinal"],
			"nombreApi" => $value["nombreApi"],
			"idTyrecheck" => $ultimoRegistro_Tyrecheck,
			"idCloudcore" => $ultimoRegistro_Cloudcore
		);

	}

}else{

	$arrayTime[$key] = array(
			"actualizar" => "null",
			"setTime" => "null",
			"fechaInicio" => "null",
			"fechaFinal" => "null",
			"consulta" => "null",
			"valueSetTime" => "null",
			"paginaInicio" => "null",
			"paginaFinal" => "null",
			"nombreApi" => "null",
			"idTyrecheck" => "null",
			"idCloudcore" => "null"
	);

}

if($fechaBaseDatos_Tyrecheck > $fechaActual){
	$dateTime1 = new DateTime($fechaFinal);
	$dateTime2 = new DateTime($fechaActual);

	$interval = date_diff($dateTime1,$dateTime2);

	$tiempoFin = $interval->format('%h');
}


$numTabConsultaTyrecheck = ControladorTyrecheck::ctrConsultaTyrechekDataJoson(null,null);
$numTabMesurementsTyrecheck = ControladorTyrecheck::ctrConsultaTyrechekMeasurements(null,null);
$numTabObservationsTyrecheck = ControladorTyrecheck::ctrConsultaTyrechekObservations(null,null);
$numTabConsulta_Cloudcore = ControladorCloudcore::ctrConsultaCloudcore(null,null);
$numTabConsultaDataJson_Cloudcore = ControladorCloudcore::ctrConsultaCloudcoreDataJoson(null,null);


if(isset($_SESSION["idBackend"])){

	$admin = ControladorAdministradores::ctrMostrarAdministradores("id", $_SESSION["idBackend"]);

}

//echo  '<script>alert("ok");</script>';

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!--<meta charset="UTF-8">-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="x-ua-compatible" content="ie=edge" Content-type = "application/json">

	<title>Apirest CISA</title>

	<link rel="icon" href="vistas/img/plantilla/icono.jpg" class="img-circle">

	<!--=====================================
	VÍNCULOS CSS
	======================================-->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" >

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=">

	 <!-- Google Font: Source Sans Pro -->
  	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- Theme style AdmninLTE -->
  	<link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

  	<!-- DataTables -->
	<link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

	<!-- Bootstrap Color Picker -->
	 <link rel="stylesheet" href="vistas/css/plugins/bootstrap-colorpicker.min.css">

	<!-- iCheck -->
  	<link rel="stylesheet" href="vistas/css/plugins/iCheck-flat-blue.css">	

  	<!-- Pano -->
	<link rel="stylesheet" href="vistas/css/plugins/jquery.pano.css">

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="vistas/css/plugins/bootstrap-datepicker.standalone.min.css">

	 <!-- fullCalendar -->
	<link rel="stylesheet" href="vistas/css/plugins/fullcalendar.min.css">

	<!-- Morris chart -->
  	<link rel="stylesheet" href="vistas/css/plugins/morris.css">

	<!-- dscountdown -->
	<link rel="stylesheet" href="vistas/css/plugins/dscountdown.css">

	<!--=====================================
	CSS PERSONAL
	======================================-->

	<link rel="stylesheet" href="vistas/css/main.css">

	<!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	
	<!-- AdminLTE App -->
	<script src="vistas/js/plugins/adminlte.min.js"></script>

	<!-- DataTables 
	https://datatables.net/-->
  	<script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
  	<script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script> 
	<script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
  	<script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>	

  	<!-- SWEET ALERT 2 -->	
	<!-- https://sweetalert2.github.io/ -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script>

	<!-- CKEDITOR -->
	<!-- https://ckeditor.com/ckeditor-5/#classic -->
	<script src="vistas/js/plugins/ckeditor.js"></script>

	<!-- dscountdown.min -->
	<script src="vistas/js/plugins/dscountdown.min.js"></script>

	<!-- bootstrap color picker 
	https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  	<script src="vistas/js/plugins/bootstrap-colorpicker.min.js"></script>

  	<!-- iCheck -->
	<!-- http://icheck.fronteed.com/ -->
	<script src="vistas/js/plugins/icheck.min.js"></script>

	<!-- Pano -->
	<!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
	<script src="vistas/js/plugins/jquery.pano.js"></script>

	<!-- bootstrap datepicker -->
	<!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
	<script src="vistas/js/plugins/bootstrap-datepicker.min.js"></script>

	<!-- fullCalendar -->
	<!-- https://momentjs.com/ -->
	<script src="vistas/js/plugins/moment.js"></script>
	<!-- https://fullcalendar.io/docs/background-events-demo -->	
	<script src="vistas/js/plugins/fullcalendar.min.js"></script>

	<!-- Morris.js charts -->
	<!-- https://morrisjs.github.io/morris.js/ -->
	<script src="vistas/js/plugins/raphael-min.js"></script>
	<script src="vistas/js/plugins/morris.min.js"></script>

	<style>
		
	.fc-today{
		background:rgba(255,255,255,0) !important;
	}

	</style>

</head>

<?php if (!isset($_SESSION["validarSesionBackend"])): 

	include "paginas/login.php";

	if(count($arrayTime) != 0){

		foreach ($arrayTime as $key => $value) {

			echo '<input type="hidden" act="'.$value["actualizar"].'" idTyrecheck="'.$value["idTyrecheck"].'" idCloudcore="'.$value["idCloudcore"].'" nombreApi="'.$value["nombreApi"].'" fechaInicio="'.$value["fechaInicio"].'" fechaFinal="'.$value["fechaFinal"].'" setTime="'.$value["setTime"].'" fechaActual="'.$fechaActual.'" consulta="'.$value["consulta"].'" valueSetTime="'.$value["valueSetTime"].'" pi="'.$value["paginaInicio"].'" pf="'.$value["paginaFinal"].'" id="'.$value["nombreApi"].'" >';

		}

	}else{


	}

	echo '	<script src="vistas/js/main.js" type="module"></script>

			<script src="vistas/js/consulta.js"></script>

			<script src="vistas/js/administradores.js"></script>

			<script src="vistas/js/tyrecheck.js"></script>

			<script src="vistas/js/cloudcore.js"></script>';

?>

<?php else: ?>

<div class="contenedor-carga" id="loading" style="display:none">
	<div class="carga"></div>
</div>


<body class="hold-transition sidebar-mini sidebar-collapse" id="body">
	<form method="post">
		<?php

		if(count($arrayTime) != 0){

			foreach ($arrayTime as $key => $value) {

				echo '<input type="hidden" act="'.$value["actualizar"].'" idTyrecheck="'.$value["idTyrecheck"].'" idCloudcore="'.$value["idCloudcore"].'" nombreApi="'.$value["nombreApi"].'" fechaInicio="'.$value["fechaInicio"].'" fechaFinal="'.$value["fechaFinal"].'" setTime="'.$value["setTime"].'" fechaActual="'.$fechaActual.'" consulta="'.$value["consulta"].'" valueSetTime="'.$value["valueSetTime"].'" pi="'.$value["paginaInicio"].'" pf="'.$value["paginaFinal"].'" id="'.$value["nombreApi"].'" >';
	
			}

		}else{


		}


			
		
		?>

		
		
		<input type="hidden" id="datosJsonTyrecheck" value="">
		
	</form>
	<div class="wrapper">

		<?php 

		include "paginas/modulos/header.php";

		include "paginas/modulos/menu.php";

		/*=============================================
		Navagación de páginas
		=============================================*/
		
		if(isset($_GET["pagina"])){

			if($_GET["pagina"] == "inicio" ||
			   $_GET["pagina"] == "administradores" ||
			   $_GET["pagina"] == "tyrecheck" ||
			   $_GET["pagina"] == "consultaTyrecheck" ||
			   $_GET["pagina"] == "consultaCloudcore" ||
			   $_GET["pagina"] == "cloudcore" ||
			   $_GET["pagina"] == "salir"){

				include "paginas/".$_GET["pagina"].".php";

			}else{

				include 'paginas/error404.php';

			}


		}else{

			include "paginas/inicio.php";

		}

		include "paginas/modulos/footer.php";


		?>


	</div>

	<script src="vistas/js/main.js" type="module"></script>

	<script src="vistas/js/consulta.js"></script>

	<script src="vistas/js/administradores.js"></script>

	<script src="vistas/js/tyrecheck.js"></script>

	<script src="vistas/js/cloudcore.js"></script>
	
</body>

<?php endif ?>

</html>