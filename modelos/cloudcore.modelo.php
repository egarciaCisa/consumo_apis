<?php

require_once "conexion.php";

class ModeloCloudcore{

	/*=============================================
	GUARDAR EN LA TABLA CONSULTA CLOUDCORE
	=============================================*/

	static public function mdlGuardarTabConsultaCloudcore($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreApi, token, estado, dataJson1, dtaaJson2, fechaInicio, fechaFinal, paginaInicio, paginaFinal) VALUES (:nombreApi, :token, :estado, :dataJson1, :dtaaJson2, :fechaInicio, :fechaFinal, :paginaInicio, :paginaFinal)");

		$stmt->bindParam(":nombreApi", $datos["nombreApi"], PDO::PARAM_STR);	
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":dataJson1", $datos["dataJson1"], PDO::PARAM_STR);
        $stmt->bindParam(":dtaaJson2", $datos["dataJson2"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaFinal", $datos["fechaFinal"], PDO::PARAM_STR);
		$stmt->bindParam(":paginaInicio", $datos["paginaInicio"], PDO::PARAM_INT);
		$stmt->bindParam(":paginaFinal", $datos["paginaFinal"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());
		
		}

		$stmt->close();
		$stmt = null;

	}

    /*=============================================
	MOSTRAR TABLA CONSULA CLOUDCORE
	=============================================*/
	static public function mdlMostrarTablaConsultaCloudcore($tabla, $item, $valor){

		if($item != null && $valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt-> close();

		$stmt = null;

	}

    /*=============================================
	Actualizar Autentificacion
	=============================================*/

	static public function mdlActualizarCloudcore($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2, $item3 = :$item3 WHERE $item1 = :$item1");

		$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();

		$stmt = null;

	}

    /*=============================================
	GUARDAR EN LA TABLA CONSULTA CLOUDCORE
	=============================================*/

	static public function mdlGuardarTablaCloudcoreDataJson1($tabla, $datos){

        for ($i=0; $i < count($datos); $i++) { 

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_consulta, invoiceId, taxFolio, issuer, issuerRfc, issuerAddress, receiver, receiverRfc, receiverAddress, subtotal, discount, total, transferredTaxes, retainedTaxes, issueDate, concepts, voucherType, issuingPlace, cfdiUsageId, changeType, issuerRegimeTax, currency, folio, series, paymentMethod, paymentWay, url) VALUES (:id_consulta, :invoiceId, :taxFolio, :issuer, :issuerRfc, :issuerAddress, :receiver, :receiverRfc, :receiverAddress, :subtotal, :discount, :total, :transferredTaxes, :retainedTaxes, :issueDate, :concepts, :voucherType, :issuingPlace, :cfdiUsageId, :changeType, :issuerRegimeTax, :currency, :folio, :series, :paymentMethod, :paymentWay, :url)");

            $stmt->bindParam(":id_consulta", $datos[$i]["id_consulta"], PDO::PARAM_INT);
            $stmt->bindParam(":invoiceId", $datos[$i]["invoiceId"], PDO::PARAM_STR);
            $stmt->bindParam(":taxFolio", $datos[$i]["taxFolio"], PDO::PARAM_STR);
            $stmt->bindParam(":issuer", $datos[$i]["issuer"], PDO::PARAM_STR);
            $stmt->bindParam(":issuerRfc", $datos[$i]["issuerRfc"], PDO::PARAM_STR);
            $stmt->bindParam(":issuerAddress", $datos[$i]["issuerAddress"], PDO::PARAM_STR);
            $stmt->bindParam(":receiver", $datos[$i]["receiver"], PDO::PARAM_STR);
            $stmt->bindParam(":receiverRfc", $datos[$i]["receiverRfc"], PDO::PARAM_STR);
            $stmt->bindParam(":receiverAddress", $datos[$i]["receiverAddress"], PDO::PARAM_STR);
            $stmt->bindParam(":subtotal", $datos[$i]["subtotal"], PDO::PARAM_STR);
            $stmt->bindParam(":discount", $datos[$i]["discount"], PDO::PARAM_STR);
            $stmt->bindParam(":total", $datos[$i]["total"], PDO::PARAM_STR);
            $stmt->bindParam(":transferredTaxes", $datos[$i]["transferredTaxes"], PDO::PARAM_STR);
            $stmt->bindParam(":retainedTaxes", $datos[$i]["retainedTaxes"], PDO::PARAM_STR);
            $stmt->bindParam(":issueDate", $datos[$i]["issueDate"], PDO::PARAM_STR);
            $stmt->bindParam(":concepts", $datos[$i]["concepts"], PDO::PARAM_STR);
            $stmt->bindParam(":voucherType", $datos[$i]["voucherType"], PDO::PARAM_STR);
            $stmt->bindParam(":issuingPlace", $datos[$i]["issuingPlace"], PDO::PARAM_STR);
            $stmt->bindParam(":cfdiUsageId", $datos[$i]["cfdiUsageId"], PDO::PARAM_STR);
            $stmt->bindParam(":changeType", $datos[$i]["changeType"], PDO::PARAM_STR);
            $stmt->bindParam(":issuerRegimeTax", $datos[$i]["issuerRegimeTax"], PDO::PARAM_STR);
            $stmt->bindParam(":currency", $datos[$i]["currency"], PDO::PARAM_STR);
            $stmt->bindParam(":folio", $datos[$i]["folio"], PDO::PARAM_STR);
            $stmt->bindParam(":series", $datos[$i]["series"], PDO::PARAM_STR);
            $stmt->bindParam(":paymentMethod", $datos[$i]["paymentMethod"], PDO::PARAM_STR);
            $stmt->bindParam(":paymentWay", $datos[$i]["paymentWay"], PDO::PARAM_STR);
			$stmt->bindParam(":url", $datos[$i]["url"], PDO::PARAM_STR);

            if($stmt->execute()){


            }else{

                echo "\nPDO::errorInfo():\n";
                print_r(Conexion::conectar()->errorInfo());
            
            }

        }
     
        return "chi";

		$stmt->close();
		$stmt = null;

	}


}