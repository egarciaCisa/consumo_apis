

/*$(".tablaConsulta").DataTable({

	"ajax":"ajax/tablaConsulta.ajax.php",
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

});*/

$(document).on("click", ".btnConsultar", function(){

	let token = $(this).attr('token');
	let fullNumber = $(this).attr('fullNumber')
	
	let myHeaders = new Headers();
	myHeaders.append("Authorization", "Bearer "+token);

	var requestOptions = {
	method: 'GET',
	headers: myHeaders,
	redirect: 'follow'
	};

	fetch("https://portal.test.tyrecheck.com/api/api/Inspection/"+fullNumber, requestOptions)
	.then(response => response.json())
	.then(result => { ;

		console.log(result.items[0]["ServiceProviderCode"]);
		
		$("#ServiceProviderCode").text(result.items[0]["ServiceProviderCode"]);
		$("#InspectionNumber").text(result.items[0]["InspectionNumber"]);
		$("#VehicleRegistrationNumber").text(result.items[0]["VehicleRegistrationNumber"]);
		$("#VehicleFleetNumber").text(result.items[0]["VehicleFleetNumber"]);
		$("#VehicleId").text(result.items[0]["VehicleId"]);
		$("#InspectionDate").text(result.items[0]["InspectionDate"]);
		$("#Mileage").text(result.items[0]["Mileage"]);
		$("#ServiceType").text(result.items[0]["ServiceType"]);
		$("#UserCode").text(result.items[0]["UserCode"]);
		$("#ServiceCenterCode").text(result.items[0]["ServiceCenterCode"]);	

	})
	.catch(error => console.log('error', error));

	
});




	







