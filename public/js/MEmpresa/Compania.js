//Funcion para cargar la vista de crear categoria
function ajaxRenderSectionCrearCompania() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearCompania',
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
function GuardarCompania() {
    PopupPosition();
    var formData = new FormData();
    formData.append('fileLogoNegocio', $('#LogoNegocio')[0].files[0]);
    formData.append('Nombre', $('#Nombre').val());
    formData.append('Direccion', $('#Direccion').val());
    formData.append('Categoria_id', $('#Categoria_id').val());
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        contentType: false,
        processData: false,
        url: urlBase +'guardarCompania',
        dataType: 'json',
        enctype: 'multipart/form-data',
        headers: {'X-CSRF-TOKEN': token},
        data:formData,
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200){
                swal({
                    title: "Transaccción exitosa!",
                    text: "La Compañia fue grabada con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la sede!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la Compania!",
                icon: "error",
                button: "OK",
            });
            $("#errorNombre").html("");
            $("#errorDireccion").html("");
     
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Direccion){
                var errorDireccion = "<strong>"+ errors.errors.Direccion+"</strong>";
                $("#errorDireccion").append(errorDireccion);}
           
        }
    });
}

//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaCompanias() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'Companias',
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