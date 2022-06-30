<?php

class ControladorCloudcore{

    /*=============================================
	CONTOLADOR INSERTAR TOKEN TYRECHECK
	=============================================*/

    static public function ctrInsertarTokenCloudcore($datos){

		function solicitarDatosJson($token,$fechaInicio,$fechaFinal,$pagInicio,$pagFinal){

            $curl = curl_init();  
            $api = 'https://corerdapi.ccoreapps.mx/invoices?start='.$fechaInicio.'&end='.$fechaFinal.'&page='.$pagInicio.'&pageSize='.$pagFinal.'';  
            curl_setopt($curl, CURLOPT_URL, $api);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); 
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_POSTFIELDS, '{
                \'username\': \'CisaaApiUser \', 
                \'password\': \'C1S44$Api$2022\', 
                \'requestingApp\': \'CISAA\'
                }');
            $headers = array(  
                'Authorization: Bearer '.$token,
                "Accept: application/json",  
                "Content-Type:application/json"
            );  
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
            $response = curl_exec($curl); 
            curl_close($curl);

            if($response){
				return $response;
			}else{
				return "{}";
			}

        }

		function solicitarXML($token,$fechaInicio,$fechaFinal,$pagInicio,$pagFinal){

            $curl = curl_init();  
            $api = 'https://corerdapi.ccoreapps.mx/invoices/urls?start='.$fechaInicio.'&end='.$fechaFinal.'&page='.$pagInicio.'&pageSize='.$pagFinal.'';  
            curl_setopt($curl, CURLOPT_URL, $api);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); 
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_POSTFIELDS, '{
                \'username\': \'CisaaApiUser \', 
                \'password\': \'C1S44$Api$2022\', 
                \'requestingApp\': \'CISAA\'
                }');
            $headers = array(  
                'Authorization: Bearer '.$token,
                "Accept: application/json",  
                "Content-Type:application/json"
            );  
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
            $response = curl_exec($curl); 
            curl_close($curl);

			if($response){
				return $response;
			}else{
				return "{}";
			}

            

        }		

		function solicitarToken(){

            $curl = curl_init();  
            $api = "https://corerdapi.ccoreapps.mx/auth/token";  
            curl_setopt($curl, CURLOPT_URL, $api);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_POSTFIELDS, '{
                \'username\': \'CisaaApiUser \', 
                \'password\': \'C1S44$Api$2022\', 
                \'requestingApp\': \'CISAA\'
                }');
            $headers = array(  
                "Accept: application/json",  
                "Content-Type:application/json"
            );  
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);  
            $response = curl_exec($curl); 
            curl_close($curl);

            $json = json_decode($response,true);
            $array = array($json);
            $token = null;

            foreach ($array as $key => $value) {
                $token = $value["token"];
            }

			if($token){
				return $token;
			}else{
				return null;
			}

            

        }

		$token = solicitarToken();
		$datosJson = solicitarDatosJson($token,$datos["fechaInicio"],$datos["fechaFinal"],$datos["paginaInicio"],$datos["paginaFinal"]);
		$datosXML = solicitarXML($token,$datos["fechaInicio"],$datos["fechaFinal"],$datos["paginaInicio"],$datos["paginaFinal"]);
		
		if($token != null){

			if($datosJson != "{}" && $datosJson != "{}"){

				$array = array("nombreApi" => $datos["nombreApi"],
                        "token" => $token,
                        "estado" => 200,
                        "dataJson1" => $datosJson,
                        "dataJson2" => $datosXML,
                        "fechaInicio" => $datos["fechaInicio"],
                        "fechaFinal" => $datos["fechaFinal"],
                        "paginaInicio" => $datos["paginaInicio"],
                        "paginaFinal" => $datos["paginaFinal"]);

			}else{

				$array = array("nombreApi" => $datos["nombreApi"],
                        "token" => $token,
                        "estado" => 200,
                        "dataJson1" => $datosJson,
                        "dataJson2" => $datosXML,
                        "fechaInicio" => $datos["fechaInicio"],
                        "fechaFinal" => $datos["fechaFinal"],
                        "paginaInicio" => $datos["paginaInicio"],
                        "paginaFinal" => $datos["paginaFinal"]);

			}
            
        }else{


            $array = array("nombreApi" => $datos["nombreApi"],
                        "token" => "[error token]",
                        "estado" => 400,
                        "dataJson1" => "null",
                        "dataJson2" => "null",
                        "fechaInicio" => "",
                        "fechaFinal" => "",
                        "paginaInicio" => 0,
                        "paginaFinal" => 0);

        }

        $tabla = "tab_cloudcore_consulta";
        $respuesta = ModeloCloudcore::mdlGuardarTabConsultaCloudcore($tabla, $array);

        if($respuesta == "ok"){

            return "ok";

        }else{

            return "error token";

		}
    
    }

    /*=============================================
	ACTUALIZAR DATOS JSON
	=============================================*/

 

	static public function crtRegistrosDataJson($datos){

        function obtenerUrlXML($json,$invoiceId){


            foreach ($json as $key => $value) {

                if($invoiceId == $value["invoiceId"]){

                    return $value["url"];

                }

            }

        }


        $tabla = "tab_cloudcore_consulta";
        $item = "id";
        $valor = $datos["idConsulta"];
        $respuestaVista = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor,null);
        $id = $datos["idConsulta"];
        $array = array();

        $dataJson1 = json_decode($respuestaVista["dataJson1"],true);
        $dataJson2 = json_decode($respuestaVista["dtaaJson2"],true);


		foreach ($dataJson1 as $key => $value) {
	
			$array[$key] = array(
								
				"id_consulta" => $id,
				"invoiceId" => $value["invoiceId"],
				"taxFolio" => $value["taxFolio"],
				"issuer" => $value["issuer"],
				"issuerRfc" => $value["issuerRfc"],
				"issuerAddress" => $value["issuerAddress"],
				"receiver" => $value["receiver"],
				"receiverRfc" => $value["receiverRfc"],
				"receiverAddress" => $value["receiverAddress"],
				"subtotal" => $value["subtotal"],
				"discount" => $value["discount"],
				"total" => $value["total"],
				"transferredTaxes" => $value["transferredTaxes"],
				"retainedTaxes" => $value["retainedTaxes"],
				"issueDate" => $value["issueDate"],
				"concepts" => $value["concepts"],
				"voucherType" => $value["voucherType"],
				"issuingPlace" => $value["issuingPlace"],
				"cfdiUsageId" => $value["cfdiUsageId"],
				"changeType" => $value["changeType"],
				"issuerRegimeTax" => $value["issuerRegimeTax"],
				"currency" => $value["currency"],
				"folio" => $value["folio"],
				"series" => $value["series"],
				"paymentMethod" => $value["paymentMethod"],
				"paymentWay" => $value["paymentWay"],
				"url" => obtenerUrlXML($dataJson2,$value["invoiceId"])
			
		
			);
		}


        $tabla2 = "tab_cloudcore_datajson";
        $respuesta2 = ModeloCloudcore::mdlGuardarTablaCloudcoreDataJson1($tabla2, $array);

        return $respuesta2;

        //return $respuestaVista;

    }

    /*=============================================
	ACTUALISAT SETTIME Y FECHAS
	=============================================*/

	static public function ctrActualizarSetTime($nombre,$setTime,$dia){

		$hora = ' 00:10:00';

		$fecha = substr($setTime,0,-8);

		$fechaSetTime = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));
		
		$fechaSetTime = substr($fechaSetTime,0,-9).$hora;

		$tabla = "tab_controlador";
		$item1 = "nombreApi";
		$valor1 = $nombre;
		$item2 = "setTime";
		$valor2 = $fechaSetTime;

		return $actualizarGetTime = ModeloCloudcore::mdlAactualizarConsultaGetTime($tabla, $item1, $valor1, $item2, $valor2);
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
	
			
			return $array;
		}
	
	
		$fechas = verificarFecha($fechFinal,$consulta,$ok);
		$tabla = "tab_controlador";
		$item1 = "nombreApi";
		$valor1 = $nombre;
		$item2 = "fechaInicio";
		$valor2 = $fechas["fechaInicio"];
		$item3 = "fechaFinal";
		$valor3 = $fechas["fechaFinal"];

		return $respuesta = ModeloCloudcore::mdlAactualizarConsultafechas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

		//return $nombre.'-'.$fechFinal.'-'.$consulta.'-'.$ok.'-';

		//return $valor1;
		
		//return verificarFecha($fechFinal,$consulta,$ok);
	}

	
	

    static public function ctrMostrarConsulta($item, $valor,$orden){

		$tabla = "tab_cloudcore_consulta";

		$respuesta = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor,$orden);

		return $respuesta;

        

	}

    static public function ctrConsultaCloudcoreDataJoson($item, $valor){

		$tabla = "tab_cloudcore_consulta";

		$respuesta = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor);

		return $respuesta;

        

	}

    static public function ctrConsultaCloudcore($item, $valor){

		$tabla = "tab_cloudcore_datajson";

		$respuesta = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor);

		return $respuesta;

        

	}

	


	

}