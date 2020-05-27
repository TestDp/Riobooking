//Funcion para cargar la vista de crear una jornada 
function ajaxRenderSectionCrearJornada() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearJornada',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

//Metodo para guarda la informacion de la jornada 
function GuardarJornada() {
    PopupPosition();
    var form = $("#formJornada");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarJornada',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200){
                swal({
                    title: "Transaccción exitosa!",
                    text: "La Jornada fue grabada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la Jornada!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la Jornada!",
                icon: "error",
                button: "OK",
            });
            $("#errorFecha").html("");
            $("#errorRegional_id").html("");
            $("#errorTipo_Cita_id").html("");
            $("#errorCupos").html("");
            $("#errorhoraInicial").html("");
            $("#errorhoraFinal").html("");
            $("#errorDuracion").html("");
            $("#errorDescanso").html("");
             $("#errorLugar").html("");


        
     
            var errors = data.responseJSON;
            if(errors.errors.Fecha){
                var errorFecha = "<strong>"+ errors.errors.Fecha+"</strong>";
                $("#errorFecha").append(errorFecha);}
            if(errors.errors.Regional_id){
                var errorRegional_id = "<strong>"+ errors.errors.Regional_id+"</strong>";
                $("#errorRegional_id").append(errorRegional_id);}
            if(errors.errors.Tipo_Cita_id){
                var errorTipo_Cita_id= "<strong>"+ errors.errors.Tipo_Cita_id+"</strong>";
                $("#errorTipo_Cita_id").append(errorTipo_Cita_id);}
            if(errors.errors.Cupos){
                var errorCupos= "<strong>"+ errors.errors.Cupos+"</strong>";
                $("#errorCupos").append(errorCupos);}
            if(errors.errors.Duracion){
                var errorDuracion= "<strong>"+ errors.errors.Duracion+"</strong>";
                $("#errorDuracion").append(errorDuracion);}
            if(errors.errors.Descanso){
                var errorDescanso= "<strong>"+ errors.errors.Descanso+"</strong>";
                $("#errorDescanso").append(errorDescanso);}
             if(errors.errors.Lugar){
                var errorLugar= "<strong>"+ errors.errors.Lugar+"</strong>";
                $("#errorLugar").append(errorLugar);}
           
        }
    });
}

//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaJornadas() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'jornadas',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}




function VerJornada(idJornada) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'detalleJornada/'+ idJornada,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function validarHora() {
   var horaInicio  =  $("#Inicio").val();
   var horaFin =  $("#Fin").val();

   if(horaInicio>horaFin){
       swal({
           title: "Hora Incorrecta!",
           text: "La hora inicio no puede ser mayor la hora fin!",
           icon: "error",
           button: "OK",
       });
   }

}

function exportarJornada(idJornada) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'exportarJornada/'+ idJornada,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

function validarFecha() {
   var fecha  =  $("#Fecha").val();
var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1;
var yyyy = hoy.getFullYear();


   if(fecha<hoy){
       swal({
           title: "Fecha Incorrecta!",
           text: "La Fecha no puede ser menor a la fecha actual!",
           icon: "error",
           button: "OK",
       });
   }

}

function validarHoraF() {
   var horaInicio  =  $("#Inicio").val();
   var horaFin =  $("#Fin").val();

   if(horaInicio >horaFin){
       swal({
           title: "Hora Incorrecta!",
           text: "La hora fin no puede ser menor a  la hora Inicio!",
           icon: "error",
           button: "OK",
       });
   }

}

function ajaxRenderSectionEditarJornada(idJornada) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'editarJornada/'+ idJornada,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}


