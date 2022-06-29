<?php 


require_once "../controladores/tyrecheck.controlador.php";
require_once "../modelos/tyrecheck.modelo.php";

class TablaAutentificacion{

	/*=============================================
	Tabla Administradores
	=============================================*/ 

	public function mostrarTabla(){

		$respuesta = ControladorTyrecheck::ctrMostrarConsulta(null, null);


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

			
			if($value["dataJson"] == '{"qty":null,"items":[]}'){

				$esados = "<div class='btn-group flex-center'><i class='fas fa-circle mr-2' style='font-size:20px;color:#2ECC71'></i><i class='fas fa-circle' style='font-size:20px;color:#99A3A4;'></i></div>";

			}else if($value["dataJson"] != ''){

				$esados = "<div class='btn-group flex-center'><i class='fas fa-circle mr-2' style='font-size:20px;color:#2ECC71'></i><i class='fas fa-circle' style='font-size:20px;color:#2ECC71'></i></div>";

			}else{

				$esados = "<div class='btn-group flex-center'><i class='fas fa-circle mr-2' style='font-size:20px;color:#2ECC71'></i><i class='fas fa-circle' style='font-size:20px;color:#C0392B'></i></div>";

			}

			$dato = json_decode($value["dataJson"],true);

			$lipiar = count($dato["items"]);
			
			$consulta = "<div class='btn-group flex-center'>(".$lipiar.")</div>";


			if($value["dataJson"] != ""){

				$acciones3 = 200;

			}else{

				$acciones3 = 400;

			}

			

	
			$acciones = "<div class='btn-group flex-center'><a class='btn btn-primary btn-sm text-white' href='index.php?pagina=consultaTyrecheck&id=".$value["id"]."' idUsuario='".$value["id"]."'>Ver consulta <i class='fas fa-code ml-1'></i></a></div>";
			
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

$tabla = new TablaAutentificacion();
$tabla -> mostrarTabla();







