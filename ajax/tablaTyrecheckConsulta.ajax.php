<?php 


require_once "../controladores/autentificacion.controlador.php";
require_once "../modelos/autentificacion.modelo.php";

class TablaConsulta{

	/*=============================================
	CONTROLADOR ACTUALIZAR CONSULTA
	=============================================*/	

	public $idConsulta;

	
	/*=============================================
	Tabla Administradores
	=============================================*/ 

	public function mostrarTabla(){

		$item = "id";
		$valor	= $idConsulta;

		$respuesta = ControladorTyrecheck::ctrMostrarConsulta($item, $valor);

		echo '<script>console.log("hola")</script>';

		$respuesta = json_decode($respuesta["dataJson"],true);

		if(count($respuesta["items"]) == 0){

			$datosJson = '{"data":[]}';

			echo $datosJson;

			return;

		}

		$datosJson = '{
	
		"data":[';

		foreach ($respuesta["items"] as $key => $value) {
			
			

			

			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarAdministrador' data-toggle='modal' data-target='#editarAdministrador' idAdministrador='".$value["id"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarAdministrador' idAdministrador='".$value["id"]."'><i class='fas fa-trash-alt'></i></button></div>";
		
			$datosJson .='[
						"'.($key+1).'",
						"'.$value["id"].'",
						"",
						"",
						"",
						""
						],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= ']}';


		echo $datosJson;

	}

}

/*=============================================
Editar Autentificacion
=============================================*/
if(isset($_POST["consulta"])){

	$tocken = new TablaConsulta();
	$tocken -> idConsulta = $_POST["consulta"];
	$tocken -> mostrarTabla();

}else{

	/*=============================================
	Tabla Administradores
	=============================================*/ 

	$tabla = new TablaConsulta();
	$tabla -> mostrarTabla();
	
}







