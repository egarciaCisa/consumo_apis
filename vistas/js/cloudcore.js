function actualizarDatosJsonCloudcore(ultimoId,token,fechaI,fechaF,pi,pf){

	let datos = new FormData();
		datos.append("idConsulta", ultimoId);
		datos.append("token", token);
		datos.append("fechaInicio", fechaI);
		datos.append("fechaFinal", fechaF);
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

	
				if(respuesta){
					console.log("[200] Registro Cloudcore ok");
				
				}else{
					console.log("[500] Registro Cloudcore error");
					
				}

			}

		});


	

}

function solicitarTokenCloudcore(ultimoId,nombApi,fechaI,fechaF,pi,pf) {

	if(ultimoId){

		console.log(ultimoId);

	$("#dody").hide();
	$("#loading").show();
	  
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
		
					if(respuesta){
						$("#dody").show();
						$("#loading").hide();
						actualizarDatosJsonCloudcore(ultimoId,respuesta,fechaI,fechaF,pi,pf);
						console.log("[200] Token Cloudcore ok");
					
					}else{

						$("#dody").show();
						$("#loading").hide();
						console.log("[500] Token Cloudcore error");
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
VARIABLAS GLOBLALES
=============================================*/

let idConsultaCloudcore = $("#Cloudcore").attr("idCloudcore");
let nombreApiCloudcore = $("#Cloudcore").attr('nombreApi');
let fechaInicioCloudcore = $("#Cloudcore").attr('fechaInicio');
let fechaFinalCloudcore = $("#Cloudcore").attr('fechaFinal');
let paginaInicioCloudcore = $("#Cloudcore").attr('pi');
let paginFinalCloudcore = $("#Cloudcore").attr('pf');
let actulaizar1Cloudcore = $("#Cloudcore").attr('act1');
let actulaizar2Cloudcore = $("#Cloudcore").attr('act2');


/*=============================================
Inicializar funciciones
=============================================*/

if(idConsultaCloudcore != "" && nombreApiCloudcore != "" && fechaInicioCloudcore != "" && fechaFinalCloudcore != "" && paginaInicioCloudcore != "" && paginFinalCloudcore != "" && actulaizar1Cloudcore == "ok" && actulaizar2Cloudcore == "ok"){
	solicitarTokenCloudcore(idConsultaCloudcore,nombreApiCloudcore,fechaInicioCloudcore,fechaFinalCloudcore,paginaInicioCloudcore,paginFinalCloudcore);
}else{
	$("#dody").show();
	$("#loading").hide();
	console.log("Esperando Fecha Cloudcore...");
}



/*=============================================
Inicializar funciciones
=============================================*/


/*const d = document;
let countdown = $('#Cloudcore').attr('setTime');

      console.log(countdown);
      countdownDate = new Date(countdown).getTime();

      let countdownTempo = setInterval(() => {
        let now = new Date().getTime(),
            limitTime = countdownDate - now,
            days = Math.floor(limitTime / (1000*60*60*24)),
            hours = ("0"+Math.floor(limitTime % (1000*60*60*24)/(1000*60*60))).slice(-2),
            minutes = ("0"+Math.floor(limitTime % (1000*60*60)/(1000*60))).slice(-2),
            seconds = ("0"+Math.floor(limitTime % (1000*60)/(1000))).slice(-2);
            //console.log(days, hours, minutes, seconds);
            if(limitTime < 0){
                clearInterval(countdownTempo);
                window.location = "index.php?pagina=tyrecheck";
            }
      },1000);*/