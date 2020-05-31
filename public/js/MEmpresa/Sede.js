
//Funcion para cargar la vista de crear categoria
function ajaxRenderSectionCrearSede() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearSede',
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
function GuardarSede() {
    PopupPosition();
    var form = $("#formSede");
    var token = $("#_token").val()
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarSede',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200){
                swal({
                    title: "Transaccción exitosa!",
                    text: "La Sede fue grabada con éxito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar la Sede!",
                    icon: "error",
                    button: "OK",
                });
            }
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar la sede!",
                icon: "error",
                button: "OK",
            });
            $("#errorNombre").html("");
            $("#errorDireccion").html("");
            $("#errorTelefono").html("");
            var errors = data.responseJSON;
            if(errors.errors.Nombre){
                var errorNombre = "<strong>"+ errors.errors.Nombre+"</strong>";
                $("#errorNombre").append(errorNombre);}
            if(errors.errors.Direccion){
                var errorDireccion = "<strong>"+ errors.errors.Direccion+"</strong>";
                $("#errorDireccion").append(errorDireccion);}
            if(errors.errors.Telefono){
                var errorTelefono = "<strong>"+ errors.errors.Telefono+"</strong>";
                $("#errorTelefono").append(errorTelefono);}
        }
    });
}

//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaSedes() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'sedes',
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


function cargarSedesEmpresa() {
    var idCompania =$("#Compania_id").val();
    var $Sede =$("#Sede_id");
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'cargarSedesEmpresa/'+ idCompania,
        dataType: 'json',
        success: function (result) {
            OcultarPopupposition();
            if (result) {
                $Sede.find("option").remove();//Removemos las opciónes anteriores
                $Sede.append(new Option("Seleccionar", ""));// agregamos la opción de seleccionar
                $.each(result, function (ind, element) {
                    $Sede.append(new Option(element.Nombre, element.id));//agregamos las opciónes consultadas
                });
            }
        }
    });
}
