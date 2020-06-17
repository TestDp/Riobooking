
function ajaxRenderSectionMiAgenda() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'agenda',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data.vista));
            renderCalendario(data.reservas);
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

function renderCalendario(arrayReservas) {
    var calendarEl = document.getElementById('agenda');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid','interaction','list','timeGrid' ],
        //defaultView:'timeGridDay'
        header:{
            left:'prev,next today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events:arrayReservas
    });
    calendar.setOption('locale','Es');
    calendar.render();
}

function ajaxRenderSectionMiCalendario() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'miCalendario',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data.vista));
            renderCalendarioUser(data.reservas);
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

function ajaxRenderSectionMisCitas() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'misCitas',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data.vista));
            renderCalendarioUser(data.reservas);
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

function renderCalendarioUser(arraymiCalendario) {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid','interaction','list','timeGrid' ],
        //defaultView:'timeGridDay'
        header:{
            left:'prev,next today',
            center:'title',
            right:'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events:arraymiCalendario
    });
    calendar.setOption('locale','Es');
    calendar.render();
}

//Metodo para guarda la informacion del tipo de documento y retorna la vista con todos los tipos de documentos
function CancelarCita() {
    var form = $("#formDetalleCita");
    var token = $("#_token").val();
    var idCitaUser = $("#idCitaUser").val();

    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase+'cancelarCita/'+idCitaUser,
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200) {
                swal({
                    title: "transaccción exitosa!",
                    text: "La cita fue cancelada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }
            else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible cancelar la cita!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar el tipo de cita!",
                icon: "error",
                button: "OK",
            });

        }
    });
}

function CancelarCitaUsuario(){

    var idCitaUser = $("#idCitaUser").val();
    $.ajax({
        url: urlBase+'cancelarCita/'+idCitaUser,
        data: {
            title: title,
            fecha: Start,
            _token :$("#_token").val()
        },
        type: 'POST',
        success: function (result) {
            if (result) {
                $("#qrActivo").html(result);
            }
        }
    });
    $("#lectorQR").val("");

}
