/*=============================================
MODULOS
=============================================*/

let finOferta = $(".countdown");
let fechaFinOferta = [];



for (var i = 0; i < finOferta.length; i++) {

    fechaFinOferta[i] = $(finOferta[i]).attr("reset");

    $(finOferta[i]).dsCountDown({

        endDate: new Date(fechaFinOferta[i]),

        theme: 'flat',

        titleDays: 'Días',

        titleHours: 'Horas',

        titleMinutes: 'Minutos',

        titleSeconds: 'Segundos',

        onFinish: true 


    });

}



