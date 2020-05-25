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
        url: urlBase +'cargarVPColaboradores/'+idTipoCIta,
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
        url: urlBase +'cargarVPDisponibilidadColaborador/'+idColaborador,
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
        url: urlBase +'cargarVPTurnosDisponibles/'+fechaConsulta + '/' + idColabordor,
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
        url: urlBase +'login',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
           $('#divReservar').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            $("#errorNombre").html("");
            $("#errorDescripcion").html("");
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Descripcion){
                var errorDescripcion = "<strong>"+ errors.errors.Descripcion+"</strong>";
                $("#errorDescripcion").append(errorDescripcion);}
        }
    });
}

function registrarUsuarioReserva() {
    PopupPosition();
    var form = $("#registrarUsuario");
    var token = $("#_token").val();
    $.ajax({
        type: 'POST',
        url: urlBase +'register',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            $('#divReservar').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            $("#errorNombre").html("");
            $("#errorDescripcion").html("");
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Descripcion){
                var errorDescripcion = "<strong>"+ errors.errors.Descripcion+"</strong>";
                $("#errorDescripcion").append(errorDescripcion);}
        }
    });
}

function renderSectionCargarVPRegistrarUsuario() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'cargarVPRegistrarUsuario/',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#divReservar').empty().append($(data));
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
        url: urlBase +'reservar',
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
                location.reload();
            });
        },
        error: function (data) {
            OcultarPopupposition();
            var errors = data.responseJSON;
        }
    });
}

