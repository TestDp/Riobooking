try {
    urlBase = obtenerUlrBase();
} catch (e) {
    console.error(e.message);
    throw new Error("El modulo transversales es requerido");
};


//Funcion para cargar la vista de seleccionar colaboradores
function renderSectionCargarVPColaboradores(idTipoCIta) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/cargarVPColaboradores/'+idTipoCIta,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#divColaborador').empty().append($(data));
            var x = document.getElementById("divColaborador");
            if (x.style.display === "none") {
                x.style.display = "block";
                window.scrollTo(0, 300);
            } else {
                x.style.display = "none";
            }
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

function renderSectionDisponibilidadColaborador(idColaborador) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/cargarVPDisponibilidadColaborador/'+idColaborador,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#divDisponibilidad').empty().append($(data.vista));
            renderCalendario(data.noDisponibilidadDTO,idColaborador);
            var x = document.getElementById("divDisponibilidad");
            if (x.style.display === "none") {
                x.style.display = "block";
                window.scrollTo(0, 900);
            } else {
                x.style.display = "none";
            }
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

function renderCalendario(arrayFechasNoDisponibles,idColabordor){
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $('#calendar').datepicker({
        todayHighlight: true,
        startDate: today,
        daysOfWeekDisabled: [0],
        weekStart: 1,
        format: "yyyy-mm-dd",
        datesDisabled: arrayFechasNoDisponibles,
        language:"es",
    }).on('changeDate', function(e) {
        var fecha = $(this).datepicker('getDate');
        var anio = fecha.getFullYear();
        var mes  = fecha.getMonth() + 1;
        var dia = fecha.getDate();
        var fecha = anio + '-' + mes + '-' + dia;
        renderSectionTurnosDisponibles(fecha,idColabordor);
    });
}

function renderSectionTurnosDisponibles(fechaConsulta,idColabordor) {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'/cargarVPTurnosDisponibles/'+fechaConsulta + '/' + idColabordor,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#turnosDisponibles').empty().append($(data));
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


function mostrarFormReserva(element,turnoPorColaborador_id) {
    if($(element).prop( "checked" )) {
        var x = document.getElementById("divReservar");
        $("#TurnoPorColaborador_id").val(turnoPorColaborador_id);
        if (x.style.display === "none") {
            x.style.display = "block";
            window.scrollTo(0, 1400);
        } else {
            x.style.display = "none";
        }
   }
}


function iniciarSesion() {
    PopupPosition();
    var form = $("#formLogin");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase +'/login',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            var turnoPorColaborador_id = $("#TurnoPorColaborador_id").val();
            OcultarPopupposition();
           $('#divReservar').empty().append($(data));
            $("#TurnoPorColaborador_id").val(turnoPorColaborador_id);
        },
        error: function (data) {
            OcultarPopupposition();
            $("#errorLogin").html("");
            $("#errorPassword").html("");
            var errors = data.responseJSON;
            if(errors.errors.login){
                var errorlogin = "<strong>"+ errors.errors.login+"</strong>";
                $("#errorLogin").append(errorlogin);}
            if(errors.errors.password){
                var errorPassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorPassword").append(errorPassword);}
        }
    });
}

function registrarUsuarioReserva() {
    PopupPosition();
    var form = $("#registrarUsuario");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'/register',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            var turnoPorColaborador_id = $("#TurnoPorColaborador_id").val();
            OcultarPopupposition();
            $('#divReservar').empty().append($(data));
            $("#TurnoPorColaborador_id").val(turnoPorColaborador_id);
        },
        error: function (data) {
            OcultarPopupposition();
            $("#errorNombre").html("");
            $("#errorApellido").html("");
            $("#errorUsuario").html("");
            $("#errorEmail").html("");
            $("#errorTelefono").html("");
            $("#errorPassword").html("");
            var errors = data.responseJSON;
            if(errors.errors.name){
                var errorNombre = "<strong>"+ errors.errors.name+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.last_name){
                var errorApellido = "<strong>"+ errors.errors.last_name+"</strong>";
                $("#errorApellido").append(errorApellido);}
            if(errors.errors.email){
                var errorEmail = "<strong>"+ errors.errors.email+"</strong>";
                $("#errorEmail").append(errorEmail);}
            if(errors.errors.password){
                var errorPassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorPassword").append(errorPassword);}
            if(errors.errors.username){
                var errorUsuario = "<strong>"+ errors.errors.username+"</strong>";
                $("#errorUsuario").append(errorUsuario);}
            if(errors.errors.telefono){
                var errorTelefono = "<strong>"+ errors.errors.telefono+"</strong>";
                $("#errorTelefono").append(errorTelefono);}
        }
    });
}

function renderSectionCargarVPRegistrarUsuario() {
    PopupPosition();
    var turnoPorColaborador_id = $("#TurnoPorColaborador_id").val();
    $.ajax({
        type: 'GET',
        url: urlBase +'/cargarVPRegistrarUsuario/',
        dataType: 'json',
        success: function (data) {
            var turnoPorColaborador_id = $("#TurnoPorColaborador_id").val();
            OcultarPopupposition();
            $('#divReservar').empty().append($(data));
            $("#TurnoPorColaborador_id").val(turnoPorColaborador_id);
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

function guardarReservaUsuario() {
    PopupPosition();
    var form = $("#formSolicitarResevar");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'/reservar',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: 'Reserva agendada',
                text: "Su reserva fue agendada con exito!",
                icon: 'success',
                buttons: {
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }},
            }).then((result) => {
                window.location.href= data.respuesta;
            });
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
        }
    });
}


function renderSectionCargarRioBookingCompaniasVP() {
    PopupPosition();
    var strNegocios = $("#BuscarNegocios").val();
    if(strNegocios == ''){
        strNegocios='ALL';
    }
    $.ajax({
        type: 'GET',
        url: urlBase +'/cargarVPRioBooking/'+strNegocios,
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#gridCompanias').empty().append($(data));
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
