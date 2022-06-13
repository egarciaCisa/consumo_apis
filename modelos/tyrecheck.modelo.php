<?php

require_once "conexion.php";



class ModeloTyrecheck{

	

	/*=============================================
	Mostrar Administradores
	=============================================*/
	static public function mdlMostrarTablaConsultaTyrecheck($tabla, $item, $valor){

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
	Guardar Autentificacion
	=============================================*/

	static public function mdlGuardarTabConsultaTyrecheck($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreApi, token, estado, dataJson, fechaFinal, fechaInicio) VALUES (:nombreApi, :token, :estado, :dataJson, :fechaFinal, :fechaInicio)");

		$stmt->bindParam(":nombreApi", $datos["nombreApi"], PDO::PARAM_STR);	
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":dataJson", $datos["dataJson"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaFinal", $datos["fechaFinal"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);

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
	Actualizar Autentificacion
	=============================================*/

	static public function mdlActualizarAutentificacion($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2 WHERE $item1 = :$item1");

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
	INSERTAR DATOS A LA TABLA TAB_TIRECCHECK CONSULTA
	=============================================*/

	static public function mdlInsertarDatosTablaTirecheckConsulta($tabla, $datos){

		for ($i=0; $i < count($datos); $i++) { 

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_consulta, id_api, InspectionId, InspectionBeginTime, InspectionEndTime, InspectionFullNumber, VehicleMileage, LocationName, VehicleRegistrationNumber) VALUES (:id_consulta, :id_api, :InspectionId, :InspectionBeginTime, :InspectionEndTime, :InspectionFullNumber, :VehicleMileage, :LocationName, :VehicleRegistrationNumber)");

			$stmt->bindParam(":id_consulta", $datos[$i]["id_consulta"], PDO::PARAM_INT);	
			$stmt->bindParam(":id_api", $datos[$i]["id_api"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionId", $datos[$i]["InspectionId"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionBeginTime", $datos[$i]["InspectionBeginTime"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionEndTime", $datos[$i]["InspectionEndTime"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionFullNumber", $datos[$i]["InspectionFullNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":VehicleMileage", $datos[$i]["VehicleMileage"], PDO::PARAM_STR);
			$stmt->bindParam(":LocationName", $datos[$i]["LocationName"], PDO::PARAM_STR);
			$stmt->bindParam(":VehicleRegistrationNumber", $datos[$i]["VehicleRegistrationNumber"], PDO::PARAM_STR);

			if($stmt->execute()){

	
			}else{
	
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());
			
			}

		
		}

		return "ok";


		

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	INSERTAR DATOS A LA TABLA TAB_TIRECCHECK
	=============================================*/

	static public function mdlInsertarDatosTablaTirecheck($tabla, $datos){

		for ($i=0; $i < count($datos); $i++) { 

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_consulta, id_api, ServiceProviderCode, Measurements, Observations, InspectionNumber, VehicleRegistrationNumber, VehicleFleetNumber, VehicleId, InspectionDate, Mileage, ServiceType, UserCode, ServiceCenterCode) VALUES (:id_consulta, :id_api, :ServiceProviderCode, :Measurements, :Observations, :InspectionNumber, :VehicleRegistrationNumber, :VehicleFleetNumber, :VehicleId, :InspectionDate, :Mileage, :ServiceType, :UserCode, :ServiceCenterCode)");

			$stmt->bindParam(":id_consulta", $datos[$i]["id_consulta"], PDO::PARAM_INT);	
			$stmt->bindParam(":id_api", $datos[$i]["id_api"], PDO::PARAM_STR);
			$stmt->bindParam(":ServiceProviderCode", $datos[$i]["ServiceProviderCode"], PDO::PARAM_STR);
			$stmt->bindParam(":Measurements", $datos[$i]["Measurements"], PDO::PARAM_STR);
			$stmt->bindParam(":Observations", $datos[$i]["Observations"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionNumber", $datos[$i]["InspectionNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":VehicleRegistrationNumber", $datos[$i]["VehicleRegistrationNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":VehicleFleetNumber", $datos[$i]["VehicleFleetNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":VehicleId", $datos[$i]["VehicleId"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionDate", $datos[$i]["InspectionDate"], PDO::PARAM_STR);
			$stmt->bindParam(":Mileage", $datos[$i]["Mileage"], PDO::PARAM_STR);
			$stmt->bindParam(":ServiceType", $datos[$i]["ServiceType"], PDO::PARAM_STR);
			$stmt->bindParam(":UserCode", $datos[$i]["UserCode"], PDO::PARAM_STR);
			$stmt->bindParam(":ServiceCenterCode", $datos[$i]["ServiceCenterCode"], PDO::PARAM_STR);

			if($stmt->execute()){

	
			}else{
	
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());
			
			}

		
		}

		return "ok";


		

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar TABLA TAB_TIRECHECK
	=============================================*/
	static public function mdlMostrarDatosTabla_tirecheck($tabla, $item, $valor){

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
	Mostrar TABLA TAB_TIRECHECK CONSULTAS OBSERVACIONES Y MESUREMENTS
	=============================================*/
	static public function mdlMostrarDatosTablaObservacionesMesumerents($tabla, $item, $valor, $item1, $valor1){

		if($item != null && $valor != null && $item1 != null && $valor1 != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item1 = :$item1");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);

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
	INSERTAR DATOS A LA TABLA TAB_TIRECCHECK_MEASUREMENTS
	=============================================*/

	static public function mdlGuardarDatosTirecheckMeasurements($tabla, $datos){

		for ($i=0; $i < count($datos); $i++) { 

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tirecheck, id_consulta, id_api, MeasurementTypeName, MeasurementUnit, DisplayValue, TyreGrooveNumber, AxlePosition, TyrePosition) VALUES (:id_tirecheck, :id_consulta, :id_api, :MeasurementTypeName, :MeasurementUnit, :DisplayValue, :TyreGrooveNumber, :AxlePosition, :TyrePosition)");

			$stmt->bindParam(":id_tirecheck", $datos[$i]["id_tirecheck"], PDO::PARAM_INT);
			$stmt->bindParam(":id_consulta", $datos[$i]["id_consulta"], PDO::PARAM_INT);
			$stmt->bindParam(":id_api", $datos[$i]["id_api"], PDO::PARAM_STR);
			$stmt->bindParam(":MeasurementTypeName", $datos[$i]["MeasurementTypeName"], PDO::PARAM_STR);
			$stmt->bindParam(":MeasurementUnit", $datos[$i]["MeasurementUnit"], PDO::PARAM_STR);
			$stmt->bindParam(":DisplayValue", $datos[$i]["DisplayValue"], PDO::PARAM_STR);
			$stmt->bindParam(":TyreGrooveNumber", $datos[$i]["TyreGrooveNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":AxlePosition", $datos[$i]["AxlePosition"], PDO::PARAM_STR);
			$stmt->bindParam(":TyrePosition", $datos[$i]["TyrePosition"], PDO::PARAM_STR);

			if($stmt->execute()){

	
			}else{
	
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());
			
			}

		
		}

		return "ok";


		

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	INSERTAR DATOS A LA TABLA TAB_TIRECCHECK_OBSERVATIONS
	=============================================*/

	static public function mdlGuardarDatosTirecheckObservations($tabla, $datos){

		for ($i=0; $i < count($datos); $i++) { 

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tirecheck, id_consulta, id_api, RuleName, ActionName, InspectionFullNumber, ObservationName, ActionLevel, AxlePosition, TyrePosition) VALUES (:id_tirecheck, :id_consulta, :id_api, :RuleName, :ActionName, :InspectionFullNumber, :ObservationName, :ActionLevel, :AxlePosition, :TyrePosition)");

			$stmt->bindParam(":id_tirecheck", $datos[$i]["id_tirecheck"], PDO::PARAM_INT);
			$stmt->bindParam(":id_consulta", $datos[$i]["id_consulta"], PDO::PARAM_INT);
			$stmt->bindParam(":id_api", $datos[$i]["id_api"], PDO::PARAM_STR);
			$stmt->bindParam(":RuleName", $datos[$i]["RuleName"], PDO::PARAM_STR);
			$stmt->bindParam(":ActionName", $datos[$i]["ActionName"], PDO::PARAM_STR);
			$stmt->bindParam(":InspectionFullNumber", $datos[$i]["InspectionFullNumber"], PDO::PARAM_STR);
			$stmt->bindParam(":ObservationName", $datos[$i]["ObservationName"], PDO::PARAM_STR);
			$stmt->bindParam(":ActionLevel", $datos[$i]["ActionLevel"], PDO::PARAM_STR);
			$stmt->bindParam(":AxlePosition", $datos[$i]["AxlePosition"], PDO::PARAM_STR);
			$stmt->bindParam(":TyrePosition", $datos[$i]["TyrePosition"], PDO::PARAM_STR);

			if($stmt->execute()){

	
			}else{
	
				echo "\nPDO::errorInfo():\n";
				print_r(Conexion::conectar()->errorInfo());
			
			}

		
		}

		return "ok";


		

		$stmt->close();
		$stmt = null;

	}


}