/*=============================================
CONTOLADORES DATOS JSON
=============================================*/

function solicitarTotalDeDatosJson(ultimoId,token,fechaI,fechaF) {

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
      datos.append("json", datosJson);
      datos.append("token", token);
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

          if(respuesta == "ok"){

              console.log("[200] Registros Tyrecheck ",respuesta);
              $("#loading").hide();
              $("#dody").show();
              //window.location = "index.php?pagina=tyrecheck";
              return "ok";
                     
          }else{

            console.log("[500] Registros Tyrecheck ",respuesta);
            $("#loading").hide();
            $("#dody").show();
            //window.location = "index.php?pagina=tyrecheck";
            return "error";

          }
  
        }
  
      })
  
    })
    .catch(error => console.log('error', error));

    


 

}

/*=============================================
FUNCION PARA SOLICITAR TOKEN
=============================================*/

function solicitarTokenTirechek(ultimoId,nombApi,fechaI,fechaF) {

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
                $("#dody").hide();
                $("#loading").show();

                console.log("[200] Token Tyrocheck ok");
                solicitarTotalDeDatosJson(ultimoId,respuesta,fechaI,fechaF);
                  
              }else{
                  console.log("[500] Token Tyrocheck error");
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
VARIABLAS GLOBLALES
=============================================*/

let idConsulta = $("#Tyrecheck").attr("idTyrecheck");
let nombreApi = $("#Tyrecheck").attr('nombreApi');
let fechaInicio = $("#Tyrecheck").attr('fechaInicio');
let fechaFinal = $("#Tyrecheck").attr('fechaFinal');
let actulaizar1 = $("#Tyrecheck").attr('act1');
let actulaizar2 = $("#Tyrecheck").attr('act2');

/*=============================================
Inicializar funciciones
=============================================*/


if(idConsulta != "" && nombreApi != "" & fechaInicio != "" && fechaFinal != "" && actulaizar1 == "ok" && actulaizar2 == "ok"){

  solicitarTokenTirechek(idConsulta,nombreApi,fechaInicio,fechaFinal);


}else{

  $("#dody").show();
  $("#loading").hide();
  console.log("Esperando Fecha...");

}

/*=============================================
Inicializar funciciones
=============================================*/


const d = document;
let countdown = $('#Tyrecheck').attr('setTime');

      //console.log(countdown);
      countdownDate = new Date(countdown).getTime();

      let countdownTempo = setInterval(() => {
        let now = new Date().getTime(),
            limitTime = countdownDate - now,
            days = Math.floor(limitTime / (1000*60*60*24)),
            hours = ("0"+Math.floor(limitTime % (1000*60*60*24)/(1000*60*60))).slice(-2),
            minutes = ("0"+Math.floor(limitTime % (1000*60*60)/(1000*60))).slice(-2),
            seconds = ("0"+Math.floor(limitTime % (1000*60)/(1000))).slice(-2);
            console.log(days, hours, minutes, seconds);
            if(limitTime < 0){
                clearInterval(countdownTempo);
                window.location = "index.php?pagina=tyrecheck";
            }
      },1000);











