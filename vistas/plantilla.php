<?php 
session_start();

//rutas de sistema

$ruta = ControladorRuta::ctrRuta();
$htacces = "index.php?pagina=";

//controladores Tyrecheck
$ultimoRegistro_Tyrecheck = ControladorTyrecheck::ctrMostrarConsulta(null,null);
$ultimoRegistro_Tyrecheck = (count($ultimoRegistro_Tyrecheck));
if($ultimoRegistro_Tyrecheck == 0){
	$ultimoRegistro_Tyrecheck = 1;
}
$nombre_tyrecheck = "Tyrecheck";
$fechaCountdown_Tyrecheck = ControladorInicio::ctrMostrarConsultaControlador("nombreApi",$nombre_tyrecheck);

$ultimoRegistro_Cloudcore = ControladorCloudcore::ctrMostrarConsulta(null,null);
$ultimoRegistro_Cloudcore = (count($ultimoRegistro_Cloudcore));
if($ultimoRegistro_Tyrecheck == 0){
	$ultimoRegistro_Tyrecheck = 1;
}
$nombre_cloudcore = "Cloudcore";
$fechaBaseDatos_Cloudcore = ControladorInicio::ctrMostrarConsultaControlador("nombreApi",$nombre_cloudcore);

//contorladores de tiempo

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d');
$hora = date('H:i:s');
$fechaActual = $fecha.' '.$hora;
$controlador = ControladorInicio::ctrMostrarConsultaControlador(null,null);

function actualizarConsultaGetTime($fechaActual,$setTime,$dia,$id){

	if($setTime > $fechaActual){

		$fecha1 = substr($fechaActual,0,-9);
		$fecha2 = substr($setTime,0,-9);
		

		if( $fecha1 == $fecha2 ){

			$fecha = substr($setTime,0,-8);

			$fechaSetTime = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));
			
			$fechaSetTime = substr($fechaSetTime,0,-9).' 00:00:10';

			return $actualizarGetTime = ControladorInicio::ctrAactualizarConsultaGetTime($id,$fechaSetTime);

		}else{
			return "nel";
		}

	}else{

		$fecha = substr($fechaActual,0,-8);

		$fechaD = date('Y-m-d H:i:s', strtotime($fecha.' + 1 days'));

		$fechaDefaul = substr($fechaD,0,-9).' 00:00:10';

		if($id){
			
			return $actualizarGetTime = ControladorInicio::ctrAactualizarConsultaGetTime($id,$fechaDefaul);

		}

		


	}
}


function actualizarConsultaFechas($fechaActual,$setTime,$fechasFinal,$dia2,$id){

	$fecha1 = substr($fechaActual,0,-9);
	$fecha2 = substr($setTime,0,-9);


	if($fecha1 == $fecha2){

		$fecha = substr($fechasFinal,0,-9);
		$fechaInicio = substr($fechasFinal,0,-9).' 00:00:00';
		$getFechaFinal = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia2.' days'));
		$getFechaFinal = substr($getFechaFinal,0,-9).' 00:00:00';

		return $actualizarGetTime = ControladorInicio::ctrAactualizarConsultafechas($id,$fechaInicio,$getFechaFinal);

	}else{
		return "nel";
	}
}

$arrayTime = array();

if($controlador){

	foreach ($controlador as $key => $value) {

		$arrayTime[$key] = array(
			"actualizarGetTime" => actualizarConsultaGetTime($fechaActual,$value["setTime"],$value["ValueSetTime"],$value["id"]),
			"actualizarFechas" => actualizarConsultaFechas($fechaActual,$value["setTime"],$value["fechafinal"],$value["consulta"],$value["id"]),
			"setTime" => $value["setTime"],
			"fechaInicio" => substr($value["fechaInicio"],0,-9),
			"fechaFinal" => substr($value["fechaFinal"],0,-9),
			"paginaInicio" => $value["paginaInicio"],
			"paginaFinal" => $value["paginaFinal"],
			"nombreApi" => $value["nombreApi"],
			"idTyrecheck" => $ultimoRegistro_Tyrecheck,
			"idCloudcore" => $ultimoRegistro_Cloudcore
		);

	}

}else{

	$arrayTime[$key] = array(
		"actualizarGetTime" => "vacio",
		"actualizarFechas" => "vacio",
		"setTime" => $fechaActual,
		"fechaInicio" => "",
		"fechaFinal" => "",
		"paginaInicio" => 0,
		"paginaFinal" => 0,
		"nombreApi" => "vacio",
		"idTyrecheck" => "",
		"idCloudcore" => ""
	);

}



//echo "Actualizar Crono ".actualizarConsultaGetTime($fechaActual,"2022-06-08 00:00:00",1,1);
//echo "Actualizar Fecha ".actualizarConsultaFechas($fechaActual,"2022-06-09 00:00:00","2022-01-01 00:00:00",30,1);

//$cloudcore = ControladorCloudcore::ctrInicializarConsultaApi($fechaActual,$fechaFinal,$nombre_cloudcore,$ultimoRegistro_Tyrecheck,1,20);




























	

if($fechaBaseDatos_Tyrecheck > $fechaActual){
	$dateTime1 = new DateTime($fechaFinal);
	$dateTime2 = new DateTime($fechaActual);

	$interval = date_diff($dateTime1,$dateTime2);

	$tiempoFin = $interval->format('%h');
}


if(isset($_SESSION["idBackend"])){

	$admin = ControladorAdministradores::ctrMostrarAdministradores("id", $_SESSION["idBackend"]);

}

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

				echo '<input type="hidden" act1="'.$value["actualizarGetTime"].'" act2="'.$value["actualizarFechas"].'" idTyrecheck="'.$value["idTyrecheck"].'" idCloudcore="'.$value["idCloudcore"].'" nombreApi="'.$value["nombreApi"].'" fechaInicio="'.$value["fechaInicio"].'" fechaFinal="'.$value["fechaFinal"].'" setTime="'.$fechaCountdown_Tyrecheck["setTime"].'" pi="'.$value["paginaInicio"].'" pf="'.$value["paginaFinal"].'" id="'.$value["nombreApi"].'" >';
	
			}

		}else{


		}

			//echo '<input type="hidden" act1="nel" act2="ok" idTyrecheck="5" idCloudcore="0" nombreApi="Tyrecheck" fechaInicio="2022-05-01" fechaFinal="2022-05-31" setTime="'.$fechaActual.'" pi="0" pf="0" id="Tyrecheck">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="122" nombreApi="Cloudcore" fechaInicio="2022-05-01" fechaFinal="2022-05-02" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="123" nombreApi="Cloudcore" fechaInicio="2022-05-02" fechaFinal="2022-05-03" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="124" nombreApi="Cloudcore" fechaInicio="2022-05-03" fechaFinal="2022-05-04" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="125" nombreApi="Cloudcore" fechaInicio="2022-05-04" fechaFinal="2022-05-05" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="126" nombreApi="Cloudcore" fechaInicio="2022-05-05" fechaFinal="2022-05-06" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="127" nombreApi="Cloudcore" fechaInicio="2022-05-06" fechaFinal="2022-05-07" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="128" nombreApi="Cloudcore" fechaInicio="2022-05-07" fechaFinal="2022-05-08" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="129" nombreApi="Cloudcore" fechaInicio="2022-05-08" fechaFinal="2022-05-09" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="130" nombreApi="Cloudcore" fechaInicio="2022-05-09" fechaFinal="2022-05-10" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="131" nombreApi="Cloudcore" fechaInicio="2022-05-10" fechaFinal="2022-05-11" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="132" nombreApi="Cloudcore" fechaInicio="2022-05-11" fechaFinal="2022-05-12" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="133" nombreApi="Cloudcore" fechaInicio="2022-05-12" fechaFinal="2022-05-13" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="134" nombreApi="Cloudcore" fechaInicio="2022-05-13" fechaFinal="2022-05-14" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="135" nombreApi="Cloudcore" fechaInicio="2022-05-14" fechaFinal="2022-05-15" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="136" nombreApi="Cloudcore" fechaInicio="2022-05-15" fechaFinal="2022-05-16" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="137" nombreApi="Cloudcore" fechaInicio="2022-05-16" fechaFinal="2022-05-17" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="138" nombreApi="Cloudcore" fechaInicio="2022-05-17" fechaFinal="2022-05-18" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="139" nombreApi="Cloudcore" fechaInicio="2022-05-18" fechaFinal="2022-05-19" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="140" nombreApi="Cloudcore" fechaInicio="2022-05-19" fechaFinal="2022-05-20" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="141" nombreApi="Cloudcore" fechaInicio="2022-05-20" fechaFinal="2022-05-21" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="142" nombreApi="Cloudcore" fechaInicio="2022-05-21" fechaFinal="2022-05-22" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="143" nombreApi="Cloudcore" fechaInicio="2022-05-22" fechaFinal="2022-05-23" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="144" nombreApi="Cloudcore" fechaInicio="2022-05-23" fechaFinal="2022-05-24" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="145" nombreApi="Cloudcore" fechaInicio="2022-05-24" fechaFinal="2022-05-25" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="146" nombreApi="Cloudcore" fechaInicio="2022-05-25" fechaFinal="2022-05-26" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="147" nombreApi="Cloudcore" fechaInicio="2022-05-26" fechaFinal="2022-05-27" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="148" nombreApi="Cloudcore" fechaInicio="2022-05-27" fechaFinal="2022-05-28" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="149" nombreApi="Cloudcore" fechaInicio="2022-05-28" fechaFinal="2022-05-01" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="150" nombreApi="Cloudcore" fechaInicio="2022-05-29" fechaFinal="2022-05-30" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="151" nombreApi="Cloudcore" fechaInicio="2022-05-30" fechaFinal="2022-05-31" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';
			//echo '<input type="hidden" act1="ok" act2="ok" idTyrecheck="0" idCloudcore="152" nombreApi="Cloudcore" fechaInicio="2022-05-31" fechaFinal="2022-06-01" setTime="'.$fechaActual.'" pi="1" pf="1000" id="Cloudcore">';



			
		
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