<?php

require_once "../controladores/autentificacion.controlador.php";
require_once "../modelos/autentificacion.modelo.php";

class AjaxAutentificacion{

	/*=============================================
	Editar Autentificacion
	=============================================*/	

	public $idAutentificacion;
	public $usuarioBacken;

	public function ajaxGuardarAutentificacion(){

		$datos = array("id" => $this->idAutentificacion,
					   "usuario" => $this->usuarioBacken);

		$respuesta = ControladorTyrecheck::ctrGuardarAutentificacion($datos);

		//$respuesta = "ok";

		echo $respuesta;

	}


}

/*=============================================
Editar Autentificacion
=============================================*/
if(isset($_POST["idAutentificacion"])){

	$tocken = new AjaxAutentificacion();
	$tocken -> idAutentificacion = $_POST["idAutentificacion"];
	$tocken -> usuarioBacken = $_POST["usuarioBacken"];
	$tocken -> ajaxGuardarAutentificacion();

}

