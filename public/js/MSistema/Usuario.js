
//Funcion para cargar la vista de crear un usuario
function ajaxRenderSectionCrearUsuario() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearUsuario',
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

//Funcion para cargar la vista de crear un usuario
function ajaxRenderSectionCrearColaborador() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearColaborador',
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

//Metodo para guarda la informacion del usaurio
function GuardarUsuario() {
    var formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('last_name', $('#last_name').val());
    formData.append('username', $('#username').val());
    formData.append('email', $('#email').val());
    formData.append('telefono', $('#telefono').val());
    formData.append('password', $('#password').val());
    formData.append('password_confirmation', $('#password_confirmation').val());
    formData.append('Sede_id', $('#Sede_id').val());
    $("#Roles_id").find('option:selected').each(function(ind,option){
        formData.append('Roles_id[]', $(option).val());
    });
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        contentType: false,
        processData: false,
        url: urlBase +'guardarUsuario',
        dataType: 'json',
        enctype: 'multipart/form-data',
        headers: {'X-CSRF-TOKEN': token},
        data:formData,
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "El usuario fue grabado con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar el usuario!",
                icon: "error",
                button: "OK",
            });
            $("#errorname").html("");
            $("#errorlast_name").html("");
            $("#errorusername").html("");
            $("#erroremail").html("");
            $("#errortelefono").html("");
            $("#errorpassword").html("");
            $("#errorSede_id").html("");
            $("#errorRoles_id").html("");
           // $("#errorUnidadDeMedida_id").html("");
            //$("#errorProveedor_id").html("");

            var errors = data.responseJSON;
            if(errors.errors.name){
                var errorname = "<strong>"+ errors.errors.name+"</strong>";
                $("#errorname").append(errorname);}
            if(errors.errors.last_name){
                var errorlast_name = "<strong>"+ errors.errors.last_name+"</strong>";
                $("#errorlast_name").append(errorlast_name);}
            if(errors.errors.username){
                var errorusername = "<strong>"+ errors.errors.username+"</strong>";
                $("#errorusername").append(errorusername);}
            if(errors.errors.email){
                var errorPrecioemail = "<strong>"+ errors.errors.email+"</strong>";
                $("#erroremail").append(errorPrecioemail);}
            if(errors.errors.password){
                var errorpassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorpassword").append(errorpassword);}
            if(errors.errors.Sede_id){
                var errorSede_id = "<strong>"+ errors.errors.Sede_id+"</strong>";
                $("#errorSede_id").append(errorSede_id);}
              if(errors.errors.telefono){
                var errortelefono = "<strong>"+ errors.errors.telefono+"</strong>";
                $("#errortelefono").append(errortelefono);}
            if(errors.errors.Roles_id){
                var errorRoles_id = "<strong>"+ errors.errors.Roles_id+"</strong>";
                $("#errorRoles_id").append(errorRoles_id);}

        }
    });
}


//Funcion para mostrar la lista de categorias
function ajaxRenderSectionListaUsuarios() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'usuarios',
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

//Funcion para mostrar la lista de colaboradores
function ajaxRenderSectionListaColaboradores() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'colaboradores',
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


//Metodo para guarda la informacion del producto retorna la vista con todos los provedores
function GuardarColaborador() {
    var form = $("#formColaborador");
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarColaborador',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transaccción exitosa!",
                text: "El colaborador fue grabado con exito!",
                icon: "success",
                button: "OK",
            });
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            OcultarPopupposition();
            swal({
                title: "Transacción con error!",
                text: "No fue posible grabar el colaborador!",
                icon: "error",
                button: "OK",
            });
            $("#errorname").html("");
            $("#errorlast_name").html("");
            $("#errorusername").html("");
            $("#erroremail").html("");
            $("#errortelefono").html("");
            $("#errorpassword").html("");
            $("#errorSede_id").html("");
            $("#errorRoles_id").html("");
            // $("#errorUnidadDeMedida_id").html("");
            //$("#errorProveedor_id").html("");

            var errors = data.responseJSON;
            if(errors.errors.name){
                var errorname = "<strong>"+ errors.errors.name+"</strong>";
                $("#errorname").append(errorname);}
            if(errors.errors.last_name){
                var errorlast_name = "<strong>"+ errors.errors.last_name+"</strong>";
                $("#errorlast_name").append(errorlast_name);}
            if(errors.errors.username){
                var errorusername = "<strong>"+ errors.errors.username+"</strong>";
                $("#errorusername").append(errorusername);}
            if(errors.errors.email){
                var errorPrecioemail = "<strong>"+ errors.errors.email+"</strong>";
                $("#erroremail").append(errorPrecioemail);}
            if(errors.errors.password){
                var errorpassword = "<strong>"+ errors.errors.password+"</strong>";
                $("#errorpassword").append(errorpassword);}
            if(errors.errors.Sede_id){
                var errorSede_id = "<strong>"+ errors.errors.Sede_id+"</strong>";
                $("#errorSede_id").append(errorSede_id);}
            if(errors.errors.telefono){
                var errortelefono = "<strong>"+ errors.errors.telefono+"</strong>";
                $("#errortelefono").append(errortelefono);}
            if(errors.errors.Roles_id){
                var errorRoles_id = "<strong>"+ errors.errors.Roles_id+"</strong>";
                $("#errorRoles_id").append(errorRoles_id);}

        }
    });
}