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

			

		
			
	
			$datosApis = "<div class='countdown' reset='' style='display:none'></div>";



			

			$acciones = "<div class='btn-group'><a class='btn btn-primary btn-sm text-white' href='index.php?pagina=consultaCloudcore&id=".($value["id"])."' idUsuario='".$value["id"]."'>Ver Json <i class='fas fa-eye '></i></a>";
			
			$datosJson .='[
						"'.($key+1).'",
						"'.$value["nombreApi"].'",
						"'.$value["token"].'",
						"'.$value["estado"].'",
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

$tabla = new TablaCloudcore();
$tabla -> mostrarTabla();







