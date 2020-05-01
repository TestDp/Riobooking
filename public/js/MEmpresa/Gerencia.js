//Funcion para cargar la vista de crear categoria
function ajaxRenderSectionCrearGerencia() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearGerencia',
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

//Metodo para guarda la informacion de la unidad retorna la vista con todas las unidades
function GuardarGerencia() {
    PopupPosition();
    var form = $("#formGerencia");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarGerencia',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200){
                swal({
                    title: "Transaccción exitosa!",
                    text: "La Gerencia fue grabada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la Gerencia!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la Gerencia!",
                icon: "error",
                button: "OK",
            });
            $("#errorNombre").html("");
            $("#errorRegional_id").html("");
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Regional_id){
                var errorRegional_id = "<strong>"+ errors.errors.Regional_id+"</strong>";
                $("#errorRegional_id").append(errorRegional_id);}
            }
    });
}

//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaGerencias() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'gerencias',
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