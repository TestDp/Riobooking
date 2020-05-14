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