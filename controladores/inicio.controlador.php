<?php

class ControladorInicio{


    /*=============================================
	CONTROLADOR REGISTRO DE APIS (INICIO)
	=============================================*/

	public function ctrRegistroControladoresApi(){

        
		if(isset($_POST["nombreApi"])){


			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["nombreApi"])){

                if($_POST["consulta"] != 0 && $_POST["setInterval"] != 0){



                    function validarFechaFinaConsulta($fecha,$dia){

                        $dia = strval($dia);
               
                        $fechaFinal = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));

                        return $fechaFinal;
          

                    }

                    function validarFechaFinaSetTime($fecha,$dia){

                            $dia = strval($dia);

                            $fechaFinal = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));

                            return $fechaFinal;


                    }

                    if($_POST["paginas"] == 1){

                        $paginaInicio = 1;
                        $paginaFinal = $_POST["paginaFinal"];

                    }else{

                        $paginaInicio = 0;
                        $paginaFinal = 0;

                    }

               
                    $consulta = $_POST["consulta"];
                    $fechaFinal = validarFechaFinaConsulta($_POST["fechaInicio"],$_POST["consulta"]);
                    $settime = validarFechaFinaSetTime($_POST["fechaActual"],$_POST["setInterval"]);



                    $tabla = "tab_controlador";

                    $datos = array("nombreApi" => $_POST["nombreApi"],
                                "fechaInicio" =>  $_POST["fechaInicio"].' 00:00:00',
                                "fechaFinal" =>  $fechaFinal,
                                "consulta" =>  $consulta,
                                "setTime" => $settime,
                                "ValueSetTime" => $_POST["setInterval"],
                                "paginas" => $_POST["paginas"],
                                "paginaInicio" => $paginaInicio,
                                "paginaFinal" => $paginaFinal);



                    $respuesta = ModeloInicio::mdlGuardarTablaControladores($tabla, $datos);

                    
                    if($respuesta == "ok"){

                        echo'<script>

                            swal({
                                    type:"success",
                                    title: "¡CORRECTO!",
                                    text: "El controlador ha sido creado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                            }).then(function(result){

                                    if(result.value){   
                                        window.location = "index.php?pagina=inicio";
                                    } 
                            });

                        </script>';

                    }else{

                        echo'<script>

                            swal({
                                    type:"error",
                                    title: "ERROR!",
                                    text: "El controlador NO ha sido creado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                            }).then(function(result){

                                    if(result.value){   
                                        window.location = "index.php?pagina=inicio";
                                    } 
                            });

                        </script>';

                    }


                    


                }else{


                    $mes = date("m");
                    $año = date("Y");
                    $dia = date("d");
                    $diaMes = 0;


                    switch ($mes) {
                        case 1:
                            $diaMes = 31;
                            break;
                        case 2:
                            $diaMes = 28;
                            break;
                        case 3:
                            $diaMes = 31;
                            break;
                        case 4:
                            $diaMes = 30;
                            break;
                        case 5:
                            $diaMes = 31;
                            break;
                        case 6:
                            $diaMes = 30;
                            break;
                        case 7:
                            $diaMes = 31;
                            break;
                        case 8:
                            $diaMes = 31;
                            break;
                        case 9:
                            $diaMes = 30;
                            break;
                        case 10:
                            $diaMes = 31;
                            break;
                        case 11:
                            $diaMes = 30;
                            break;
                        case 12:
                            $diaMes = 31;
                            break;
                        
                    }

                    function validarFechaFinaConsulta($fecha,$dia){
               

                        $fechaFinal = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));

                        return $fechaFinal;
          
                    }

                    function validarFechaFinaSetTime($fecha,$dia){
   

                            $fechaFinal = date('Y-m-d H:i:s', strtotime($fecha.' + '.$dia.' days'));

                            return $fechaFinal;


                    }

                    if($_POST["paginas"] == 1){

                        $paginaInicio = 1;
                        $paginaFinal = $_POST["paginaFinal"];

                    }else{

                        $paginaInicio = 0;
                        $paginaFinal = 0;

                    }

               
                    $consulta = $_POST["consulta"];
                    $fechaFinal = validarFechaFinaConsulta($_POST["fechaInicio"],$diaMes);
                    $settime = validarFechaFinaSetTime($_POST["fechaActual"],$_POST["setInterval"]);

                    switch ($_POST["nombreApi"]) {
                        case 'Tyrecheck':
                           $hora = ' 00:00:00';
                            break;

                        case 'Cloudcore':
                           $hora = ' 00:10:00';
                            break;
                        
                    }

                    $settime = substr($settime,0,-9);
                    $settime = $settime.$hora;



                    $tabla = "tab_controlador";

                    $datos = array("nombreApi" => $_POST["nombreApi"],
                                "fechaInicio" =>  $_POST["fechaInicio"].' 00:00:00',
                                "fechaFinal" =>  $fechaFinal,
                                "consulta" =>  $consulta,
                                "setTime" => $settime,
                                "ValueSetTime" => $_POST["setInterval"],
                                "paginas" => $_POST["paginas"],
                                "paginaInicio" => $paginaInicio,
                                "paginaFinal" => $paginaFinal);



                    $respuesta = ModeloInicio::mdlGuardarTablaControladores($tabla, $datos);

                    
                    if($respuesta == "ok"){

                        echo'<script>

                            swal({
                                    type:"success",
                                    title: "¡CORRECTO!",
                                    text: "El controlador ha sido creado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                            }).then(function(result){

                                    if(result.value){   
                                        window.location = "index.php?pagina=inicio";
                                    } 
                            });

                        </script>';

                    }else{

                        echo'<script>

                            swal({
                                    type:"error",
                                    title: "Error!",
                                    text: "El controlador NO ha sido creado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                
                            }).then(function(result){

                                    if(result.value){   
                                        window.location = "index.php?pagina=inicio";
                                    } 
                            });

                        </script>';

                    }

                }

            }else{

                echo'<script>

                        swal({
                                type:"error",
                                title: "ERROR!",
                                text: "No se permiten caracteres especiales",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            
                        }).then(function(result){

                                if(result.value){   
                                    window.location = "index.php?pagina=inicio";
                                } 
                        });

                    </script>';
            }

		}


	}

    /*=============================================
	CONTROLADOR TABLAS
	=============================================*/

    static public function ctrMostrarConsultaControlador($item, $valor){

		$tabla = "tab_controlador";

		$respuesta = ModeloInicio::mdlMostrarConsultaControlador($tabla, $item, $valor);

		return $respuesta;

	}

    /*=============================================
	CONTROLADOR ACTUALIZAR GETTIME
	=============================================*/

    static public function ctrAactualizarConsultaGetTime($valor1, $valor2){

		$tabla = "tab_controlador";
        $item1 = "id";
        $item2= "setTime";
        

		$respuesta = ModeloInicio::mdlAactualizarConsultaGetTime($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

    /*=============================================
	CONTROLADOR ACTUALIZAR FECHA INICIO FECHA FINAL
	=============================================*/

    static public function ctrAactualizarConsultafechas($valor1, $valor2, $valor3){

		$tabla = "tab_controlador";
        $item1 = "id";
        $item2= "fechaInicio";
        $item3= "fechaFinal";
        
		$respuesta = ModeloInicio::mdlAactualizarConsultafechas($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

		return $respuesta;

	}

    
	


}