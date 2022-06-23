<?php

class ControladorTyrecheck{


	/*=============================================
	CONTOLADOR INSERTAR TOKEN TYRECHECK
	=============================================*/

	static public function ctrInsertarTokenTyrechek($datos){

		$json = json_decode($datos["dataJson"],true);
		$array = array($json);
		$token = null;

		foreach ($array as $key => $value) {
			$token = $value["access_token"];
		}
		

		if($token != null){
			

			$array = array("nombreApi" => $datos["nombreApi"],
						"token" => $token,
						"estado" => 200,
						"dataJson" => "",
						"fechaInicio" => $datos["fechaInicio"],
						"fechaFinal" => $datos["fechaFinal"]);

		}else{


			$array = array("nombreApi" => "null",
						"token" => "null",
						"estado" => 400,
						"dataJson" => "",
						"fechaInicio" => $datos["fechaInicio"],
						"fechaFinal" => $datos["fechaFinal"]);

		}

		$tabla = "consulta";
		$respuesta = ModeloTyrecheck::mdlGuardarTabConsultaTyrecheck($tabla, $array);

		if($respuesta == "ok"){

			return $token;

		}else{

			return "error";

		}

		
	}

	

	/*=============================================
	GUARDAR TABLA TYRECHEK DATAJESON
	=============================================*/


	static public function ctrGuardarTablaTirecheckDatosJoson($id, $json){

		$datosJson = json_decode($json,true);
		$array = array();
		$respuesta;

		if($datosJson != null){

			foreach ($datosJson["items"] as $key => $value) {

				$VehicleMileage = "";
				if($value["VehicleMileage"] == null){
					$VehicleMileage = "null";
				}else{
					$VehicleMileage = $value["VehicleMileage"];
				}

				$array[$key] = array(
					"id_consulta" => $id,
					"id_api" => $value["InspectionFullNumber"],
					"InspectionId" => $value["InspectionId"],
					"InspectionBeginTime" => $value["InspectionBeginTime"],
					"InspectionEndTime" => $value["InspectionEndTime"],
					"InspectionFullNumber" => $value["InspectionFullNumber"],
					"VehicleMileage" => $VehicleMileage,
					"LocationName" => $value["tcLocation"]["LocationName"],
					"VehicleRegistrationNumber" => $value["tcVehicle"]["VehicleRegistrationNumber"]
				);

		
			}

			$tabla = "tab_tirecheck_datajson";

			$respuesta = ModeloTyrecheck::mdlInsertarDatosTablaTirecheckConsulta($tabla, $array);

		}else{

			$respuesta = "error";

		}

		return $respuesta;


	}

	/*=============================================
	SEPARAR Y GUARDAR POR BLOQUERS
	=============================================*/

	static public function ctrGuardarTablaTirecheckConsulta($id, $json, $token){

		$datosJson = json_decode($json,true);

		function peticionCurl($idLlanta,$token){


			$curl = curl_init(); 
			$api = "https://portal.test.tyrecheck.com/api/api/Inspection/".$idLlanta; 
			curl_setopt($curl, CURLOPT_URL, $api); 
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_ENCODING, ''); 
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); 
			$headers = array( 
				"Accept: application/json", 
				"Authorization: Bearer ".$token,
			 ); 
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
			$response = curl_exec($curl);
			curl_close($curl);


			return $response;

		}

		if($datosJson != null){

			$datos = array();

			foreach ($datosJson["items"] as $key => $value) {

				do {
		
					$peticionCurl = peticionCurl($value["InspectionFullNumber"],$token);
					$datosJson2 = json_decode($peticionCurl,true);
		
					if($datosJson2 != null){
		
						foreach ($datosJson2["items"] as $key2 => $value2) {
		
							$VehicleFleetNumber;
							$Mileage;
		
							if($value2["VehicleFleetNumber"] == null){
		
								$VehicleFleetNumber = "null";
		
							}else{
		
								$VehicleFleetNumber = $value2["VehicleFleetNumber"];
		
							}
		
							if($value2["Mileage"] == null){
		
								$Mileage = "null";
		
							}else{
		
								$Mileage = $value2["Mileage"];
		
							}
						
		
							$datos[$key] = array(
								"id_consulta" => $id,
								"id_api" => $value2["InspectionNumber"],
								"ServiceProviderCode" => $value2["ServiceProviderCode"],
								"Measurements" => json_encode($value2["Measurements"]),
								"Observations" => json_encode($value2["Observations"]),
								"InspectionNumber" => $value2["InspectionNumber"],
								"VehicleRegistrationNumber" => $value2["VehicleRegistrationNumber"],
								"VehicleFleetNumber" => $VehicleFleetNumber,
								"VehicleId" => $value2["VehicleId"],
								"InspectionDate" => $value2["InspectionDate"],
								"Mileage" => $Mileage,
								"ServiceType" => $value2["ServiceType"],
								"UserCode" => $value2["UserCode"],
								"ServiceCenterCode" => $value2["ServiceCenterCode"]);
								
		
						}
			
						
					}else{
		
						foreach ($datosJson2["items"] as $key2 => $value2) {
		
							$datos[$key] = array(
								"id_consulta" => $id,
								"id_api" => "null",
								"ServiceProviderCode" => "null",
								"Measurements" => "null",
								"Observations" => "null",
								"InspectionNumber" => "null",
								"VehicleRegistrationNumber" => "null",
								"VehicleFleetNumber" => "null",
								"VehicleId" => "null",
								"InspectionDate" => "null",
								"Mileage" => "null",
								"ServiceType" => "null",
								"UserCode" => "null",
								"ServiceCenterCode" => "null"
							);
		
						}
		
					}
		
		
				} while ($key >= count($datosJson["items"]));			
		
			}

			$tabla = "tab_tirecheck";
			$respuesta = ModeloTyrecheck::mdlInsertarDatosTablaTirecheck($tabla, $datos);

			return $respuesta;


		}else{

			return "error";

		}	

	}

	/*=============================================
	SEPARAR Y GUARDAR POR CONSULTAS EXTERNAS Y OBSERVACIONES
	=============================================*/


	static public function ctrGuardarTablaTirecheckMeasurementsYObservations($id){

		$tabla = "tab_tirecheck";
    	$mostrar = ModeloTyrecheck::mdlMostrarDatosTabla_tirecheck($tabla, null, null);

		function arrayTirecheckMeasurements($idApi,$idConsulta){

			$tabla = "tab_tirecheck";
			$item = "id_api";
			$item1 = "id_consulta";
			$respuesta = ModeloTyrecheck::mdlMostrarDatosTablaObservacionesMesumerents($tabla, $item, $idApi, $item1, $idConsulta);


			$limpiar = json_decode($respuesta["Measurements"],true);

			$array = array();

			foreach ($limpiar as $key => $value) {

				$id_tab_tirecheck = $respuesta["id"];;
				$id_consulta = $respuesta["id_consulta"];
				$id_api	= $respuesta["id_api"];
				$MeasurementTypeName = $value["MeasurementValue"]["MeasurementTypeName"];
				$MeasurementUnit = $value["MeasurementValue"]["MeasurementUnit"];
				$DisplayValue = $value["MeasurementValue"]["DisplayValue"];
				if($value["TyreGrooveNumber"] == null){
					$TyreGrooveNumber = "null";
				}else{
					$TyreGrooveNumber = $value["TyreGrooveNumber"];
				}
				$AxlePosition = $value["AxlePosition"];
				$TyrePosition = $value["TyrePosition"];

				$array[$key] = array(
					"id_tirecheck" => $id_tab_tirecheck,
					"id_consulta" => $id_consulta,
					"id_api" => $id_api,
					"MeasurementTypeName" => $MeasurementTypeName,
					"MeasurementUnit" => $MeasurementUnit,
					"DisplayValue" => $DisplayValue,
					"TyreGrooveNumber" => $TyreGrooveNumber,
					"AxlePosition" => $AxlePosition,
					"TyrePosition" => $TyrePosition
				);

				
			}

			$tabla2 = "tab_tirecheck_measurements";
        	$respuesta2 = ModeloTyrecheck::mdlGuardarDatosTirecheckMeasurements($tabla2, $array);

			if($respuesta2 == "ok"){

				return "ok";

			}else{

				return "nel";

			}
		
			



		}

		function arrayTirecheckObservations($idApi,$idConsulta){

			$tabla = "tab_tirecheck";
			$item = "id_api";
			$item1 = "id_consulta";
			$respuesta = ModeloTyrecheck::mdlMostrarDatosTablaObservacionesMesumerents($tabla, $item, $idApi, $item1, $idConsulta);

			$limpiar = json_decode($respuesta["Observations"],true);

			$array = array();

			foreach ($limpiar as $key => $value) {

				$id_tab_tirecheck = $respuesta["id"];;
				$id_consulta = $respuesta["id_consulta"];
				$id_api	= $respuesta["id_api"];
				$RuleName = $value["RuleName"];
				$ActionName = $value["ActionName"];
				$InspectionFullNumber = $value["InspectionFullNumber"];
				$ObservationName = $value["ObservationName"];
				$ActionLevel = $value["ActionLevel"];
				$AxlePosition = $value["AxlePosition"];
				$TyrePosition = $value["TyrePosition"];
			
				

				$array[$key] = array(
					"id_tirecheck" => $id_tab_tirecheck,
					"id_consulta" => $id_consulta,
					"id_api" => $id_api,
					"RuleName" => $RuleName,
					"ActionName" => $ActionName,
					"InspectionFullNumber" => $InspectionFullNumber,
					"ObservationName" => $ObservationName,
					"ActionLevel" => $ActionLevel,
					"AxlePosition" => $AxlePosition,
					"TyrePosition" => $TyrePosition
				);

				
			}

			$tabla2 = "tab_tirecheck_observations";
        	$respuesta2 = ModeloTyrecheck::mdlGuardarDatosTirecheckObservations($tabla2, $array);

			if($respuesta2 == "ok"){

				return "ok";

			}else{

				return "nel";

			}

		}

		$respuestaOk = "";

		
		foreach ($mostrar as $key => $value) {

			if($value["id_consulta"] == $id){

				$Measurements = arrayTirecheckMeasurements($value["id_api"],$id);
				$Observations = arrayTirecheckObservations($value["id_api"],$id);

				if($Measurements == "ok" && $Observations == "ok"){

					$respuestaOk = "ok";

				}else{

					$respuestaOk = "nel";
					
				}

			}


		}

		return $respuestaOk;

	}

	/*=============================================
	ACTUALISAT SETTIME Y FECHAS
	=============================================*/

	static public function ctrActualizarSetTime($nombre,$setTime,$dia){

		$hora = ' 00:00:10';

		$fecha = substr($setTime,0,-8);

		$fechaSetTime = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));
		
		$fechaSetTime = substr($fechaSetTime,0,-9).$hora;

		$tabla = "tab_controlador";
		$item1 = "nombreApi";
		$valor1 = $nombre;
		$item2 = "setTime";
		$valor2 = $fechaSetTime;

		return $actualizarGetTime = ModeloTyrecheck::mdlAactualizarConsultaGetTime($tabla, $item1, $valor1, $item2, $valor2);
		//return $valor2;

	}

	static public function ctrActualizarFechaFinal($nombre,$fechFinal,$consulta,$ok){

		function verificarFecha($fechFinal,$Consulta,$ok){

			$substr = substr($fechFinal,5,-3);
			$intval = intval($substr);
			$dato = strval($Consulta);
			$añoSubstr = substr($fechFinal,0,-6);
			$año = intval($añoSubstr);
			$dia = '01';
			$hora = ' 00:00:00';
			$fechaInicio = '';
			$fechaFinal = '';

			//$respuesta = $año;
	
			if($Consulta == 0){
	
			   	if($ok == "ok"){

					switch ($intval) {
						case 1:
		
							$mesI = '-01-';
							$mesF = '-02-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 2:
		
							$mesI = '-02-';
							$mesF = '-03-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 3:
		
							$mesI = '-03-';
							$mesF = '-04-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 4:
		
							$mesI = '-04-';
							$mesF = '-05-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 5:
		
							$mesI = '-05-';
							$mesF = '-06-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 6:
		
							$mesI = '-06-';
							$mesF = '-07-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 7:
		
							$mesI = '-07-';
							$mesF = '-08-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 8:
		
							$mesI = '-08-';
							$mesF = '-09-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 9:
		
							$mesI = '-09-';
							$mesF = '-10-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 10:
		
							$mesI = '-10-';
							$mesF = '-11-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 11:
		
							$mesI = '-11-';
							$mesF = '-12-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $año.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
						case 12:
		
							$nuevo = ($año + 1);
							$mesI = '-12-';
							$mesF = '-01-';
		
							$fechaInicio = $año.$mesI.$dia.$hora;
							$fechaFinal = $nuevo.$mesF.$dia.$hora;
		
							$array = array(
								"fechaInicio"=>$fechaInicio,
								"fechaFinal"=>$fechaFinal
							);
		
							break;
					
					}
		
					$respuesta = $array; 

			  	}else{


					switch ($intval) {
                        case 1:
                            $diaMes = '31';
                            break;
                        case 2:
                            $diaMes = '28';
                            break;
                        case 3:
                            $diaMes = '31';
                            break;
                        case 4:
                            $diaMes = '30';
                            break;
                        case 5:
                            $diaMes = '31';
                            break;
                        case 6:
                            $diaMes = '30';
                            break;
                        case 7:
                            $diaMes = '31';
                            break;
                        case 8:
                            $diaMes = '31';
                            break;
                        case 9:
                            $diaMes = '30';
                            break;
                        case 10:
                            $diaMes = '31';
                            break;
                        case 11:
                            $diaMes = '30';
                            break;
                        case 12:
                            $diaMes = '31';
                            break;
                        
                    }



					$fechaInicio = $fechFinal.' 00:00:00';
					$getFecha = date('Y-m-d H:i:s', strtotime($fechaInicio.' + '.$diaMes.' days'));
					$fechaFinal = substr($getFecha,0,-9).' 00:00:00';
		
					$array = array(
						"fechaInicio"=>$fechaInicio,
						"fechaFinal"=>$fechaFinal,
					);
		
					$respuesta = $array;

					

				}   
	
			}else{
	
				$fechaInicio = $fechFinal.' 00:00:00';
				$getFecha = date('Y-m-d H:i:s', strtotime($fechaInicio.' + '.$dato.' days'));
				$fechaFinal = substr($getFecha,0,-9).' 00:00:00';
	
				$array = array(
					"fechaInicio"=>$fechaInicio,
					"fechaFinal"=>$fechaFinal,
				);
	
				$respuesta = $array;
	
			}
	
			
			return $respuesta;
		}
	
	
		$fechas = verificarFecha($fechFinal,$consulta,$ok);
		$tabla = "tab_controlador";
		$item1 = "nombreApi";
		$valor1 = $nombre;
		$item2 = "fechaInicio";
		$valor2 = $fechas["fechaInicio"];
		$item3 = "fechaFinal";
		$valor3 = $fechas["fechaFinal"];

		return $respuesta = ModeloTyrecheck::mdlAactualizarConsultafechas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
		
		//return verificarFecha($fechFinal,$consulta);
	}


	static public function ctrMostrarConsulta($item, $valor){

		$tabla = "consulta";

		$respuesta = ModeloTyrecheck::mdlMostrarTablaConsultaTyrecheck($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrConsultaTyrechekDataJoson($item, $valor){

		$tabla = "tab_tirecheck";

		$respuesta = ModeloTyrecheck::mdlMostrarTablaConsultaTyrecheck($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrConsultaTyrechekMeasurements($item, $valor){

		$tabla = "tab_tirecheck_measurements";

		$respuesta = ModeloTyrecheck::mdlMostrarTablaConsultaTyrecheck($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrConsultaTyrechekObservations($item, $valor){

		$tabla = "tab_tirecheck_observations";

		$respuesta = ModeloTyrecheck::mdlMostrarTablaConsultaTyrecheck($tabla, $item, $valor);

		return $respuesta;

	}

	

	

	


	

}