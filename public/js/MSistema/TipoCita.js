

//Funcion para cargar la vista de crear tipo documento
function ajaxRenderSectionCrearTipoCita() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'crearTipoCita',
        dataType: 'json',
        success: function (data) {
            OcultarPopupposition();
            $('#principalPanel').empty().append($(data));
        },
        error: function (data) {
            var errors = data.responseJSON;
            if (errors) {
                $.each(errors, function (i) {
                    console.log(errors[i]);
                });
            }
        }
    });
}

//Metodo para guarda la informacion del tipo de documento y retorna la vista con todos los tipos de documentos
function GuardarTipoCita() {
    var form = $("#formTipoCita");
    var token = $("#_token").val();
    PopupPosition();
    $.ajax({
        type: 'POST',
        url: urlBase +'guardarTipoCita',
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': token},
        data:form.serialize(),
        success: function (data) {
            OcultarPopupposition();
            if(data.codeStatus == 200) {
                swal({
                    title: "transaccción exitosa!",
                    text: "El tipo de cita fue grabado con exito!",
                    icon: "success",
                    button: "OK",
                });
                $('#principalPanel').empty().append($(data.data));
            }
            else{
                swal({
                    title: "Transacción con error!",
                    text: "No fue posible grabar el tipo de cita!",
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

//Funcion para mostrar la lista de proveedores
function ajaxRenderSectionListaTiposCitas() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'tiposCitas',
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

function CargarTiposCitasPorRegional(){
    var idRegional =$("#Regional_id").val();
    var tipoCitasSelect= $("#Tipo_Cita_id");

    $.ajax({
        url: urlBase+'tiposCitasR/'+idRegional,//primero el modulo/controlador/metodo que esta en el controlador
        type: 'GET',
        success: function (result) {
            if (result) {
                tipoCitasSelect.find("option").remove();//Removemos las opciónes anteriores
                tipoCitasSelect.append(new Option("Seleccionar", ""));// agregamos la opción de seleccionar
                $.each(result, function (ind, element) {
                    tipoCitasSelect.append(new Option(element.Nombre, element.id));//agregamos las opciónes consultadas
                })

            }
        }
    });




}

function ActivarCampo()
{
    $("#divCupo").removeAttr("hidden");
}

function DesactivarCampo()
{
    $("#divCupo").attr("hidden", "hidden");
}

//Funcion para mostrar la lista de proveedores
function ajaxRenderSectionServiciosColaborador() {
    PopupPosition();
    $.ajax({
        type: 'GET',
        url: urlBase +'ServiciosColaborador',
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