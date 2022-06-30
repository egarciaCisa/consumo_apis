/*=============================================
CONTOLADORES DATOS JSON
=============================================*/

function solicitarTotalDeDatosJson(ultimoId,token,fechaI,fechaF,fechaA,fechaS,numA,numS,nombre) {

  

    let myHeaders = new Headers();
    myHeaders.append("Authorization", "Bearer "+token);
  
    let requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
    };
  
    fetch("https://portal.test.tyrecheck.com/api/api/tcInspection?items=['InspectionId','InspectionFullNumber','VehicleMileage',{'name':'tcLocation','items':['LocationName'],'mode':0},{'name':'tcVehicle','items':['VehicleRegistrationNumber'],'mode':0},'InspectionBeginTime','InspectionEndTime']&mode=0&query= InspectionEndTime > '"+fechaI+" 00:00' AND InspectionEndTime < '"+fechaF+" 00:00'", requestOptions)
    .then(response => response.json())
    .then(json => {

      console.log(json);
     
      json = JSON.stringify(json);
  
      $("#datosJsonTyrecheck").val(json);
      let datosJson = $("#datosJsonTyrecheck").val();
  
  
      let datos = new FormData();
      datos.append("idConsulta", ultimoId);
      datos.append("nombreApi", nombre);
      datos.append("json", datosJson);
      datos.append("token", token);
      datos.append("fechaInicio", fechaI);
      datos.append("fechaFinal", fechaF);
      datos.append("fechaActual", fechaA);
      datos.append("fechaSetTime", fechaS);
      datos.append("consulta", numA);
      datos.append("ValueSetTime", numS);

      $.ajax({
  
        url:"ajax/tyrecheck.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){

          console.log(respuesta);

          if(respuesta == "ok"){

              console.log("[Tyrocheck] Registros [cargado] / setTime [ok]  ");
              setTimeout(() =>{
                window.location = "index.php?pagina=tyrecheck";
              },20000);
              
                     
          }else if(respuesta == "ok-no"){

              console.log("[Tyrocheck] Registros [vacio] / setTime [ok] ");
              $("#loading").hide();
              $("#dody").show();
              setTimeout(() =>{
                window.location = "index.php?pagina=tyrecheck";
              },20000);

          }else{

              console.log("[Tyrocheck] Registros [error] / setTime [error] ");
              $("#loading").hide();
              $("#dody").show();
              setTimeout(() =>{
                window.location = "index.php?pagina=tyrecheck";
              },20000);

          }
  
        }
  
      })
  
    })
    .catch(error => console.log('error', error));

    


 

}

/*=============================================
FUNCION PARA SOLICITAR TOKEN
=============================================*/

function solicitarTokenTirechek(ultimoId,nombApi,fechaI,fechaF,$fechaActual,$fechaSetTime,numconsulta,numSeTtime) {

  $("#dody").hide();
  $("#loading").show();

  if(ultimoId){
    
    ultimoId = parseInt(ultimoId);

    if(nombApi != ""){

      let myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

      let urlencoded = new URLSearchParams();
      urlencoded.append("grant_type", "password");
      urlencoded.append("username", "andres.rodriguez");
      urlencoded.append("password", "a@000000");

      let requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
      };

      fetch("https://portal.test.tyrecheck.com/api/token", requestOptions)
      .then(response => response.json())
      .then(json => {

        if(json != null){

          let jsonToken = JSON.stringify(json);

          let datos = new FormData();
          datos.append("idConsulta", ultimoId);
          datos.append("nombApi", nombApi);
          datos.append("jsonToken", jsonToken);
          datos.append("fechaInicio", fechaI);
          datos.append("fechaFinal", fechaF);

          $.ajax({
  
            url:"ajax/tyrecheck.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success:function(respuesta){

              if(respuesta){
                
                console.log("[Tyrocheck] Token [ok]");
                solicitarTotalDeDatosJson(ultimoId,respuesta,fechaI,fechaF,$fechaActual,$fechaSetTime,numconsulta,numSeTtime,nombApi);
                  
              }else{
                  console.log("[Tyrocheck] Token [error]");
              }
  
            }
  
          })

        }else{

        }

      })
      .catch(error => console.log('error', error));

    }else{
      console.log("[500] vacío");
      return "error";
    }
  }else{
    return "error";
  }

  

  

  
}



$(".tablaAautentificacion").DataTable({
	"ajax":"ajax/tablatyrecheck.ajax.php",
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


function validarTiempoFechaTyrocheck(val) {

  /*=============================================
  VARIABLAS GLOBLALES
  =============================================*/

  let activador_tyrocheck = val;
  let id_tyrecheck = $("#Tyrecheck").attr("idTyrecheck");
  let nombre_tyrecheck = $("#Tyrecheck").attr('nombreApi');
  let fechaI_tyrecheck = $("#Tyrecheck").attr('fechaInicio');
  let fechaF_tyrecheck = $("#Tyrecheck").attr('fechaFinal');
  let fechaActual_tyrocheck = $("#Tyrecheck").attr('fechaActual');
  let fechaSetTime_tyrocheck = $("#Tyrecheck").attr('setTime');
  let numConsulta_tyrocheck = $("#Tyrecheck").attr('consulta');
  let numSetTime_tyrocheck = $("#Tyrecheck").attr('valueSetTime');
  let paginaI_tyrecheck = $("#Tyrecheck").attr('pi');
  let paginaF_tyrecheck = $("#Tyrecheck").attr('pf');

  if(id_tyrecheck != "" && nombre_tyrecheck == "Tyrecheck" & fechaI_tyrecheck != "" && fechaF_tyrecheck != "" && fechaActual_tyrocheck != "" && fechaSetTime_tyrocheck != "" && activador_tyrocheck == "ok"){

    $("#loading").hide();
    $("#dody").show();
    solicitarTokenTirechek(id_tyrecheck,nombre_tyrecheck,fechaI_tyrecheck,fechaF_tyrecheck,fechaActual_tyrocheck,fechaSetTime_tyrocheck,numConsulta_tyrocheck,numSetTime_tyrocheck);
    
  }else{
  
    $("#dody").show();
    $("#loading").hide();
  
  }
    
}




/*=============================================
Inicializar funciciones
=============================================*/


const d = document;
let countdown_tyrecheck = $('#Tyrecheck').attr('setTime');

//console.log(countdown);
countdownDate_tyrecheck = new Date(countdown_tyrecheck).getTime();

let countdownTempo_tyrecheck = setInterval(() => {
  let now = new Date().getTime(),
      limitTime = countdownDate_tyrecheck - now,
      days = Math.floor(limitTime / (1000*60*60*24)),
      hours = ("0"+Math.floor(limitTime % (1000*60*60*24)/(1000*60*60))).slice(-2),
      minutes = ("0"+Math.floor(limitTime % (1000*60*60)/(1000*60))).slice(-2),
      seconds = ("0"+Math.floor(limitTime % (1000*60)/(1000))).slice(-2);
      //console.log(days, hours, minutes, seconds);
      if(limitTime < 0){
          clearInterval(countdownTempo_tyrecheck);
          validarTiempoFechaTyrocheck("ok");
      }
},1000);











