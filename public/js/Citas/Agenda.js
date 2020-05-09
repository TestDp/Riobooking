
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