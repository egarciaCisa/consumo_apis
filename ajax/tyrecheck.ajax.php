<?php

require_once "../controladores/tyrecheck.controlador.php";
require_once "../modelos/tyrecheck.modelo.php";

class AjaxTyrecheck{

	/*=============================================
	FUNCION DE RECIBIR TOKEN
	=============================================*/	

	public $ultimoIdToken;
	public $nombApiToken;
	public $JsonToken;
	public $fechaIToken;
	public $fechaFToken;

	public function ajaxRecibirToken(){

		$datos = array("nombreApi" => $this->nombApiToken,
						"token" => "",
						"estado" => 200,
						"dataJson" => $this->JsonToken,
						"fechaInicio" => $this->fechaIToken,
						"fechaFinal" => $this->fechaFToken);
		
		echo $respuesta = ControladorTyrecheck::ctrInsertarTokenTyrechek($datos);

	} 

    /*=============================================
	CONTROLADOR ACTUALIZAR CONSULTA
	=============================================*/	

	public $json;
	public $idConsulta;
	public $nombreApi;
	public $token;
	public $fechaInicio;
	public $fechaFinal;
	public $fechaActual;
	public $fechaSetTime;
	public $consulta;
	public $valueSetTime;

	public function ajaxInsertarDatos(){

		$tabla = "consulta";
		$item1 = "id";
		$valor1	= $this->idConsulta;
		$item2 = "dataJson";
		$valor2 = $this->json;
		$key = $this->token;
		$nomAp = $this->nombreApi;
		$fechI = $this->fechaInicio;
		$fechF = $this->fechaFinal;
		$fechA = $this->fechaActual;
		$fechS = $this->fechaSetTime;
		$const = $this->consulta;
		$value = $this->valueSetTime;



		$respuesta = ModeloTyrecheck:: mdlActualizarAutentificacion($tabla, $item1, $valor1, $item2, $valor2);	

		if($respuesta == "ok"){

			 $respuesta2 = ControladorTyrecheck::ctrGuardarTablaTirecheckDatosJoson($valor1,$valor2);

			if($respuesta2 == "ok"){

				$respuesta3 = ControladorTyrecheck::ctrGuardarTablaTirecheckConsulta($valor1,$valor2,$key);

				if($respuesta3 == "ok"){

					$respuesta4 = ControladorTyrecheck::ctrGuardarTablaTirecheckMeasurementsYObservations($valor1);

					if($respuesta4){

						$respuesta5 = ControladorTyrecheck::ctrActualizarSetTime($nomAp,$fechA,$value);
						$respuesta6 = ControladorTyrecheck::ctrActualizarFechaFinal($nomAp,$fechF,$const,"ok");
						
						if($respuesta5 == "okGet" && $respuesta6 == "okFech"){
						
							echo "ok";
						
						}else{
						
							echo "error-1";
						
						}
						
					}else{

						$respuesta7 = ControladorTyrecheck::ctrActualizarSetTime($nomAp,$fechA,$value);
						$respuesta8 = ControladorTyrecheck::ctrActualizarFechaFinal($nomAp,$fechI,$const,"nel");

						if($respuesta7 == "okGet" && $respuesta8 == "okFech"){

							echo "ok-no";

						}else{

							echo "error-2";

						}
					}
					

				}else{

					echo "error";

				}
			}else{

				echo "error";

			}

		}else{

			echo "error";

		}
		
		
		//echo $this->valueSetTime;
   
		

	} 


}

/*=============================================
RECIBIMOS TOKEN
=============================================*/	

if(isset($_POST["jsonToken"])){

	$token = new AjaxTyrecheck();
	$token -> ultimoIdToken = $_POST["idConsulta"];
	$token -> nombApiToken = $_POST["nombApi"];
	$token -> JsonToken = $_POST["jsonToken"];
	$token -> fechaIToken = $_POST["fechaInicio"];
	$token -> fechaFToken = $_POST["fechaFinal"];
	$token -> ajaxRecibirToken();

}

/*=============================================
RECIBIMOS JSON DE CONSULTA POR FECHA
=============================================*/	

if(isset($_POST["json"])){

	$request = new AjaxTyrecheck();
	$request -> idConsulta = $_POST["idConsulta"];
	$request -> nombreApi = $_POST["nombreApi"];
	$request -> json = $_POST["json"];
	$request -> token = $_POST["token"];
	$request -> fechaInicio = $_POST["fechaInicio"];
	$request -> fechaFinal = $_POST["fechaFinal"];
	$request -> fechaActual = $_POST["fechaActual"];
	$request -> fechaSetTime = $_POST["fechaSetTime"];
	$request -> consulta = $_POST["consulta"];
	$request -> valueSetTime = $_POST["ValueSetTime"];
	$request -> ajaxInsertarDatos();

}

