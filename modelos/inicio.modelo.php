<?php

require_once "conexion.php";

class ModeloInicio{


    /*=============================================
	Guardar TABLA CONSTROLADORES
	=============================================*/

	static public function mdlGuardarTablaControladores($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreApi, fechaInicio, fechaFinal, consulta, setTime, ValueSetTime, paginas, paginaInicio, paginaFinal) VALUES (:nombreApi, :fechaInicio, :fechaFinal, :consulta, :setTime, :ValueSetTime, :paginas, :paginaInicio, :paginaFinal)");

		$stmt->bindParam(":nombreApi", $datos["nombreApi"], PDO::PARAM_STR);	
		$stmt->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaFinal", $datos["fechaFinal"], PDO::PARAM_STR);
		$stmt->bindParam(":consulta", $datos["consulta"], PDO::PARAM_STR);
		$stmt->bindParam(":setTime", $datos["setTime"], PDO::PARAM_STR);
		$stmt->bindParam(":ValueSetTime", $datos["ValueSetTime"], PDO::PARAM_INT);
		$stmt->bindParam(":paginas", $datos["paginas"], PDO::PARAM_INT);
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
	MOSTRAR CONSULTAS
	=============================================*/
	static public function mdlMostrarConsultaControlador($tabla, $item, $valor){

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
	Actualizar TABLA CONTROLADORES GETTIME
	=============================================*/

	static public function mdlAactualizarConsultaGetTime($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2 WHERE $item1 = :$item1");

		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);

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
	Actualizar TABLA CONTROLADORES FECHAS
	=============================================*/

	static public function mdlAactualizarConsultafechas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item2 = :$item2, $item3 = :$item3  WHERE $item1 = :$item1");

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

	


}