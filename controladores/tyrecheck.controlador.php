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











































































	static public function ctrInicializarConsultaApi($fechaInicio,$fechaFinal,$nombre,$ultimoRegistro){

		$validacion = null;
		$mensjae = null;

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://portal.test.tyrecheck.com/api/token',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => 'grant_type=password&username=andres.rodriguez&password=a%40000000',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded'
		),
		));

		$response = curl_exec($curl);

		if($response){
			echo '<script>console.log("[200 token]")</script>';
		}else{
			echo '<script>console.log("[400 token]")</script>';
		}


		$token = null;
		$datos = null;

	

		curl_close($curl);

		$json = json_decode($response,true);
		$array = array($json);

		echo '<script>console.log("'.$token.'")</script>';


		foreach ($array as $key => $value) {
			$token = $value["access_token"];
		}

		if($token != null){

			$datos = array("nombreApi" => $nombre,
						"token" => $token,
						"estado" => 200,
						"dataJson" => "",
						"fechaInicio" => $fechaInicio,
						"fechaFinal" => $fechaFinal);

		}else{

			$datos = array("nombreApi" => $nombre,
						"token" => "null",
						"estado" => 400,
						"dataJson" => "",
						"fechaInicio" => $fechaInicio,
						"fechaFinal" => $fechaFinal);

		}


		$tabla = "consulta";
		$respuesta = ModeloTyrecheck::mdlGuardarTabConsultaTyrecheck($tabla, $datos);

		if($respuesta == "ok" && $token != null){


			$validacion = ModeloTyrecheck::mdlMostrarTablaConsultaTyrecheck($tabla, "token", $token);

			if($validacion["token"] != "null"){

				$mensaje = array("id" => $ultimoRegistro,
								"token" => $token,
								"fechaInicio" => $fechaInicio,
								"fechaFinal" => $fechaFinal);		

			}else{

				$mensaje = array("id" => "",
								"token" => "",
								"fechaInicio" => "",
								"fechaFinal" => "");
				
			}
			
		}else{
			
		}
		

		return $mensaje;

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