function actualizarDatosJsonCloudcore(ultimoId,nomApi,token,fechaI,fechaF,fechaA,fechaS,numF,numS,pi,pf){

	let datos = new FormData();
		datos.append("idConsulta", ultimoId);
		datos.append("nombreApi", nomApi);
		datos.append("token", token);
		datos.append("fechaInicio", fechaI);
		datos.append("fechaFinal", fechaF);
		datos.append("fechaActual", fechaA);
		datos.append("fechaSetTime", fechaS);
		datos.append("consulta", numF);
		datos.append("ValueSetTime", numS);
		datos.append("pagInicio", pi);
		datos.append("pagFinal", pf);
		//datos.append("paginaFinal", pf);

		$.ajax({

			url:"ajax/cloudcore.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success:function(respuesta){

				//console.log(respuesta);
	
				if(respuesta == "ok-si"){

					console.log("[Cloudcore] Registros [cargado] / setTime [ok]");
					$("#loading").hide();
					$("#dody").show();
					setTimeout(() =>{
						window.location = "index.php?pagina=cloudcore";
					  },5000);
				
				}else if(respuesta == "ok-no"){
					console.log("[Cloudcore] Registros [vacio] / setTime [ok]");
					$("#loading").hide();
					$("#dody").show();
					setTimeout(() =>{
						window.location = "index.php?pagina=cloudcore";
					  },5000);
					
				}else{
					console.log("[Cloudcore] Registros [error] / setTime [error]");
					$("#loading").hide();
					$("#dody").show();
					setTimeout(() =>{
						window.location = "index.php?pagina=cloudcore";
					  },5000);

				}

			}

		});


}

function solicitarTokenCloudcore(ultimoId,nombApi,fechaI,fechaF,fechaA,fechaS,numF,numS,pi,pf) {

	if(ultimoId){

		//console.log(ultimoId);

	
		ultimoId = parseInt(ultimoId);
	
			if(nombApi != ""){
	
				let datos = new FormData();
				datos.append("idConsulta", ultimoId);
				datos.append("nombApi", nombApi);
				datos.append("fechaInicio", fechaI);
				datos.append("fechaFinal", fechaF);
				datos.append("paginaInicio", pi);
				datos.append("paginaFinal", pf);

				$.ajax({

					url:"ajax/cloudcore.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					success:function(respuesta){

						//console.log(respuesta);
			
						if(respuesta){
						
							actualizarDatosJsonCloudcore(ultimoId,nombApi,respuesta,fechaI,fechaF,fechaA,fechaS,numF,numS,pi,pf);
							console.log("[Cloudcore] token ["+respuesta+"] ");
						
						}else{

							
							console.log("[Cloudcore] token ["+respuesta+"] ");
						}

					}

				});
	
			}else{
				console.log("[500] vacío");
				return "error";
			}
		}else{
	return "error";
	}
  
}



$(".tablaCloudcore").DataTable({
	"ajax":"ajax/tablaCloudcore.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
});

/*=============================================
Inicializar funciciones
=============================================*/

function validarTiempoFechaCloudcore(val) {

	/*=============================================
	VARIABLAS 
	=============================================*/

	let activador_cloudcore = val;
	let id_cloudcore = $("#Cloudcore").attr("idCloudcore");
	let nombre_cloudcore = $("#Cloudcore").attr('nombreApi');
	let fechaI_cloudcore = $("#Cloudcore").attr('fechaInicio');
	let fechaF_cloudcore = $("#Cloudcore").attr('fechaFinal');
	let fechaActual_cloudcore = $("#Cloudcore").attr('fechaActual');
	let fechaSetTime_cloudcore = $("#Cloudcore").attr('setTime');
	let numConsulta_cloudcore = $("#Cloudcore").attr('consulta');
	let numSetTime_cloudcore = $("#Cloudcore").attr('valueSetTime');
	let paginaI_cloudcore = $("#Cloudcore").attr('pi');
	let paginaF_cloudcore = $("#Cloudcore").attr('pf');


	if(id_cloudcore != "" && nombre_cloudcore == "Cloudcore" & fechaI_cloudcore != "" && fechaF_cloudcore != "" && fechaActual_cloudcore != "" && fechaSetTime_cloudcore != "" && activador_cloudcore == "ok"){


		$("#dody").hide();
		$("#loading").show();	
		solicitarTokenCloudcore(id_cloudcore,nombre_cloudcore,fechaI_cloudcore,fechaF_cloudcore,fechaActual_cloudcore,fechaSetTime_cloudcore,numConsulta_cloudcore,numSetTime_cloudcore,paginaI_cloudcore,paginaF_cloudcore);

	}else{

	$("#dody").show();
	$("#loading").hide();

	}
}



/*=============================================
Inicializar funciciones
=============================================*/


//const d = document;
let countdown_cloudcore = $('#Cloudcore').attr('setTime');

//console.log(countdown);
countdownDate_cloudcore = new Date(countdown_cloudcore).getTime();

let countdownTempo_cloudcore = setInterval(() => {
  let now = new Date().getTime(),
      limitTime = countdownDate_cloudcore - now,
      days = Math.floor(limitTime / (1000*60*60*24)),
      hours = ("0"+Math.floor(limitTime % (1000*60*60*24)/(1000*60*60))).slice(-2),
      minutes = ("0"+Math.floor(limitTime % (1000*60*60)/(1000*60))).slice(-2),
      seconds = ("0"+Math.floor(limitTime % (1000*60)/(1000))).slice(-2);
      //console.log(days, hours, minutes, seconds);
      if(limitTime < 0){
          clearInterval(countdownTempo_cloudcore);
		  validarTiempoFechaCloudcore("ok");        
      }
},1000);