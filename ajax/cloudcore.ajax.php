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
	public $token;
	public $fechaInicioJs;
	public $fechaFinalJS;
	public $paginaInicioJS;
	public $paginaFinalJS;
	
	

	public function ajaxInsertarDatos(){
		
		$datos = array(
			"idConsulta" => $this->idConsulta,
			"token" => $this->token,
			"fechaInicio" => $this->fechaInicioJs,
			"fechaFinal" => $this->fechaFinalJS,
			"paginaInicio" => $this->paginaInicioJS,
			"paginaFinal" => $this->paginaFinalJS,
		);

		
		
		var_dump($respuesta = ControladorCloudcore::crtRegistrosDataJson($datos));

		/*if($respuesta == "ok"){

			echo $respuesta;

		}else{

			echo "error ajax";

		}*/

	


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

if(isset($_POST["idConsulta"])){

	$request = new AjaxCloudcore();
	$request -> idConsulta = $_POST["idConsulta"];
	$request -> token = $_POST["token"];
	$request -> fechaInicioJs = $_POST["fechaInicio"];
	$request -> fechaFinalJS = $_POST["fechaFinal"];
	$request -> paginaInicioJS = $_POST["pagInicio"];
	$request -> paginaFinalJS = $_POST["pagFinal"];
	$request -> ajaxInsertarDatos();

}

