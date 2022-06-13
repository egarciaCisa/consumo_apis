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
	public $token;

	public function ajaxInsertarDatos(){

		$tabla = "consulta";
		$item1 = "id";
		$valor1	= $this->idConsulta;
		$item2 = "dataJson";
		$valor2 = $this->json;
		$key = $this->token;

		$respuesta = ModeloTyrecheck:: mdlActualizarAutentificacion($tabla, $item1, $valor1, $item2, $valor2);	

		if($respuesta == "ok"){

			 $respuesta2 = ControladorTyrecheck::ctrGuardarTablaTirecheckDatosJoson($valor1,$valor2);

			if($respuesta2 == "ok"){

				$respuesta3 = ControladorTyrecheck::ctrGuardarTablaTirecheckConsulta($valor1,$valor2,$key);

				if($respuesta3 == "ok"){

					$respuesta4 = ControladorTyrecheck::ctrGuardarTablaTirecheckMeasurementsYObservations($valor1);

					if($respuesta4){
						echo "ok";
					}else{
						echo "error";
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
	$request -> json = $_POST["json"];
	$request -> token = $_POST["token"];
	$request -> fechaInicio = $_POST["fechaInicio"];
	$request -> fechaFinal = $_POST["fechaFinal"];
	$request -> ajaxInsertarDatos();

}

