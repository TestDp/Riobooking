//Funcion para cargar la vista de crear una jornada 
function ajaxRenderSectionCrearReserva() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'guardarReserva',
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
function GuardarReserva(idCita) {
    PopupPosition();
    //var form = $("#formCitas");
    //var token = $("#_token").val()
    $.ajax({
        type: 'GET',
        url: urlBase +'guardarReserva/' + idCita,
        dataType: 'json',
         success: function (data) {
             OcultarPopupposition();
            if(data.codeStatus == 200) {
                swal({
                    title: "transaccción exitosa!",
                    text: "La reserva fue grabada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }
            else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la reserva!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la reserva!",
                icon: "error",
                button: "OK",
            });

        }
    });
}



//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaCitas() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'citas',
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


//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaCitasUsuario() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'cancelarReserva',
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

function GuardarCancelacion(idCita) {
    PopupPosition();
    //var form = $("#formCitas");
    //var token = $("#_token").val()
    $.ajax({
        type: 'GET',
        url: urlBase +'guardarCancelacion/' + idCita,
        dataType: 'json',
         success: function (data) {
             OcultarPopupposition();
            if(data.codeStatus == 200) {
                swal({
                    title: "transaccción exitosa!",
                    text: "La cancelacion fue grabada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }
            else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la cancelacion!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la cancelacion!",
                icon: "error",
                button: "OK",
            });

        }
    });
}



function BuscadorCitas() {
    PopupPosition();
    var buscador = new Object();
    buscador.TipoCita = $("#Tipo_Cita_id").val();
    buscador.Fecha = $("#fecha").val();
    buscador.Regional = $("#Regional_id").val();
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'buscarCitas',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:{'array': JSON.stringify(buscador)},
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data.data));

        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible realizar la busqueda!",
                icon: "error",
                button: "OK",
            });

        }
    });

}

function ajaxRenderSectionBorrarCita(idCita) {
    PopupPosition();
    //var form = $("#formCitas");
    //var token = $("#_token").val()
    $.ajax({
        type: 'GET',
        url: urlBase +'guardarBorrado/' + idCita,
        dataType: 'json',
         success: function (data) {
             OcultarPopupposition();
            if(data.codeStatus == 200) {
                swal({
                    title: "transaccción exitosa!",
                    text: "La cancelacion fue borrada con exito de la jornada!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }
            else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar el borrado!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar el borrado!",
                icon: "error",
                button: "OK",
            });

        }
    });
}

    

