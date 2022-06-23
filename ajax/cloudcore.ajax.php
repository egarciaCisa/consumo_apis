<?php

require_once "../controladores/cloudcore.controlador.php";
require_once "../modelos/cloudcore.modelo.php";

class AjaxCloudcore{

	/*=============================================
	FUNCION DE RECIBIR TOKEN
	=============================================*/	

	public $ultimoIdToken;
	public $nombApiToken;
	public $fechaIToken;
	public $fechaFToken;
	public $paginaInicio;
	public $paginaFinal;

	public function ajaxRecibirToken(){

		$datos = array("nombreApi" => $this->nombApiToken,
						"estado" => 200,
						"fechaInicio" => $this->fechaIToken,
						"fechaFinal" => $this->fechaFToken,
						"paginaInicio" => $this->paginaInicio,
						"paginaFinal" => $this->paginaFinal);

		
		echo $respuesta = ControladorCloudcore::ctrInsertarTokenCloudcore($datos);

	


	} 

    /*=============================================
	CONTROLADOR ACTUALIZAR CONSULTA
	=============================================*/	


	public $idConsulta;
	public $nombreApi;
	public $token;
	public $fechaInicioJs;
	public $fechaFinalJS;
	public $paginaInicioJS;
	public $paginaFinalJS;
	public $fechaActualJs;
	public $fechaSetTimeJS;
	public $consultaJS;
	public $valueSetJS;
	
	

	public function ajaxInsertarDatos(){

		$key = $this->token;
		$nomAp = $this->nombreApi;
		$fechI = $this->fechaInicioJs;
		$fechF = $this->fechaFinalJS;
		$fechA = $this->fechaActualJs;
		$fechS = $this->fechaSetTimeJS;
		$const = $this->consultaJS;
		$value = $this->valueSetJS;
		
		$datos = array(
			"idConsulta" => $this->idConsulta,
			"fechaInicio" => $this->fechaInicioJs,
			"fechaFinal" => $this->fechaFinalJS,
			"paginaInicio" => $this->paginaInicioJS,
			"paginaFinal" => $this->paginaFinalJS,
			"fechaActual" => $this->fechaActualJs,
			"fechaSetTime" => $this->fechaSetTimeJS,
			"consulta" => $this->consultaJS,
			"ValueSetTime" => $this->valueSetJS
		);

		//echo 'jolio';
		//var_dump($datos);
	
		$respuesta = ControladorCloudcore::crtRegistrosDataJson($datos);

		if($respuesta == "ok"){

			$respuesta1 = ControladorCloudcore::ctrActualizarSetTime($nomAp,$fechA,$value);
			$respuesta2 = ControladorCloudcore::ctrActualizarFechaFinal($nomAp,$fechF,$const,"ok");
			
			if($respuesta1 == "okGet" && $respuesta2 == "okFech"){
			
				echo "ok-si";
			
			}else{
			
				echo "error-1";
			
			}

		

		}else{

			$respuesta3 = ControladorCloudcore::ctrActualizarSetTime($nomAp,$fechA,$value);
			$respuesta4 = ControladorCloudcore::ctrActualizarFechaFinal($nomAp,$fechI,$const,"nel");

			if($respuesta3 == "okGet" && $respuesta4 == "okFech"){

				echo "ok-no";

			}else{

				echo "error-2";

			}

		}

	


	} 


}

/*=============================================
RECIBIMOS TOKEN
=============================================*/	

if(isset($_POST["paginaInicio"])){

	$token = new AjaxCloudcore();
	$token -> ultimoIdToken = $_POST["idConsulta"];
	$token -> nombApiToken = $_POST["nombApi"];
	$token -> fechaIToken = $_POST["fechaInicio"];
	$token -> fechaFToken = $_POST["fechaFinal"];
	$token -> paginaInicio = $_POST["paginaInicio"];
	$token -> paginaFinal = $_POST["paginaFinal"];
	$token -> ajaxRecibirToken();

}

/*=============================================
RECIBIMOS JSON DE CONSULTA POR FECHA
=============================================*/	

if(isset($_POST["token"])){

	$request = new AjaxCloudcore();
	$request -> idConsulta = $_POST["idConsulta"];
	$request -> nombreApi = $_POST["nombreApi"];
	$request -> token = $_POST["token"];
	$request -> fechaInicioJs = $_POST["fechaInicio"];
	$request -> fechaFinalJS = $_POST["fechaFinal"];
	$request -> paginaInicioJS = $_POST["pagInicio"];
	$request -> paginaFinalJS = $_POST["pagFinal"];
	$request -> fechaActualJs = $_POST["fechaActual"];
	$request -> fechaSetTimeJS = $_POST["fechaSetTime"];
	$request -> consultaJS = $_POST["consulta"];
	$request -> valueSetJS = $_POST["ValueSetTime"];
	$request -> ajaxInsertarDatos();

}

