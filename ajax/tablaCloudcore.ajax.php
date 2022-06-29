<?php 


require_once "../controladores/cloudcore.controlador.php";
require_once "../modelos/cloudcore.modelo.php";

class TablaCloudcore{

	/*=============================================
	Tabla Administradores
	=============================================*/ 

	public function mostrarTabla(){

		$respuesta = ControladorCloudcore::ctrMostrarConsulta(null, null);


		if(count($respuesta) == 0){

			$datosJson = '{"data":[]}';

			echo $datosJson;

			return;

		}

	

		$datosJson = '{
	
		"data":[';

		foreach ($respuesta as $key => $value) {

			$nombreApi = "<div class='btn-group flex-center'>".$value["nombreApi"]."</div>";
			$respuesta = "<div class='btn-group flex-center'>".$value["estado"]."</div>";

			if($value["token"] != ""){

				$token = "<div class='btn-group flex-center'><a class='btn btn-success btn-sm text-white' >Token <i class='fas fa-check-circle ml-1'></i></a></div>";

			}else{

				$token = "<div class='btn-group flex-center'><a class='btn btn-success btn-sm text-white' >Token <i class='fas fa-ban ml-1'></i></a></div>";

			}

			$fechasConsulta = "<div class='btn-group flex-center'>".$value["fechaInicio"]." - ".$value["fechaFinal"]."</div>";

			
			if($value["dataJson1"] == '' && $value["dataJson2"] == ''){

				$esados = "<div class='btn-group flex-center'><i class='fas fa-circle mr-2' style='font-size:20px;color:#2ECC71'></i><i class='fas fa-circle  mr-2' style='font-size:20px;color:#C0392B;'></i><i class='fas fa-circle' style='font-size:20px;color:#C0392B'></i></div>";

			}else{

				$esados = "<div class='btn-group flex-center'><i class='fas fa-circle mr-2' style='font-size:20px;color:#2ECC71'></i><i class='fas fa-circle  mr-2' style='font-size:20px;color:#2ECC71;'></i><i class='fas fa-circle' style='font-size:20px;color:#2ECC71'></i></div>";

			}

			$datoJs = json_decode($value["dataJson1"],true);

			$lipiar = count($datoJs);
			
			$consulta = "<div class='btn-group flex-center'>(".$lipiar.")</div>";


			$acciones = "<div class='btn-group flex-center'><a class='btn btn-primary btn-sm text-white' href='index.php?pagina=consultaCloudcore&id=".$value["id"]."' idUsuario='".$value["id"]."'>Ver consulta <i class='fas fa-code ml-1'></i></a></div>";
			
			$datosJson .='[
						"'.($key+1).'",
						"'.$nombreApi.'",
						"'.$respuesta.'",
						"'.$token.'",
						"'.$fechasConsulta.'",
						"'.$consulta.'",
						"'.$esados.'",
						"'.$acciones.'"
						],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';


		echo $datosJson;

	}

}

/*=============================================
Tabla Administradores
=============================================*/ 

$tabla = new TablaCloudcore();
$tabla -> mostrarTabla();







