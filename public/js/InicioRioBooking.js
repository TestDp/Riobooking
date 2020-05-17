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
    $('#calendar').datepicker({
        todayHighlight: true,
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

