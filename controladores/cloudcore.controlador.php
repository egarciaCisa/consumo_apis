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
            echo $response = curl_exec($curl); 
            curl_close($curl);

            return $response;

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

            return $response;

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

            return $token;

        }

        $token = solicitarToken();
        $datosJson = solicitarDatosJson($token,$datos["fechaInicio"],$datos["fechaFinal"],$datos["paginaInicio"],$datos["paginaFinal"]);
        $datosXML = solicitarXML($token,$datos["fechaInicio"],$datos["fechaFinal"],$datos["paginaInicio"],$datos["paginaFinal"]);

    
        if($token != null){
            

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


            $array = array("nombreApi" => "null",
                        "token" => "null",
                        "estado" => 400,
                        "dataJson1" => "null",
                        "dataJson2" => "null",
                        "fechaInicio" => $datos["fechaInicio"],
                        "fechaFinal" => $datos["fechaFinal"],
                        "paginaInicio" => $datos["paginaInicio"],
                        "paginaFinal" => $datos["paginaFinal"]);

        }

        $tabla = "tab_cloudcore_consulta";
        $respuesta = ModeloCloudcore::mdlGuardarTabConsultaCloudcore($tabla, $array);

        if($respuesta == "ok"){

            return $token;

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
        $respuestaVista = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor);
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

    }

	
	

    static public function ctrMostrarConsulta($item, $valor){

		$tabla = "tab_cloudcore_consulta";

		$respuesta = ModeloCloudcore::mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor);

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