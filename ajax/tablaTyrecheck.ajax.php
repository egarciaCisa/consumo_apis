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

			
			if($value["dataJson"] == ""){

				$acciones2 = "<div class='btn-group float-right'><i class='fas fa-circle' style='font-size:30px;color:red;'></i></div>";

			}else{

				$acciones2 = "<div class='btn-group float-right'><i class='fas fa-circle' style='font-size:30px;color:green;'></i></div>";

			}

			if($value["dataJson"] != ""){

				$acciones3 = 200;

			}else{

				$acciones3 = 400;

			}
	
			



			

			$acciones = "<div class='btn-group'><a class='btn btn-primary btn-sm text-white' href='index.php?pagina=consultaTyrecheck&id=".($value["id"]-1)."' idUsuario='".$value["id"]."'>Ver Json <i class='fas fa-eye '></i></a></div>";
			
			$datosJson .='[
						"'.($key+1).'",
						"'.$value["nombreApi"].' '.$acciones2.'",
						"'.$value["token"].'",
						"'.$acciones3.'",
						"'.$value["fechaFinal"].'",
						"'.$acciones.'",
						""
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







