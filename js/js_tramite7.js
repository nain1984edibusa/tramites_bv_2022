var boton_guardar = document.getElementById('guardar');

var lista = document.getElementById("lista");
var datos_objeto = [];
var datos_tramite = [];
var datos_tramite_especifico = [];
var radioboton_1 = document.getElementById('rdgpropietario_1');
var radioboton_2 = document.getElementById('rdgpropietario_1');

boton_guardar.addEventListener("click", enviar);

radioboton_1.addEventListener("click", cambiarModoEnvio);
radioboton_2.addEventListener("click", cambiarModoEnvio);

var cant = 0;
cambiarModoEnvio();

function enviar() {
    debugger;
//    alert('0K');
    var loading = $('#processing-modal');
    isBool = validarCamposTramiteEspecifico();
    if (isBool === true) {
        var tramite_especifico = 0;
        var idt = document.querySelector('#idt').value;
        var estadot = document.querySelector('#estadot').value;
        var duraciont = document.querySelector('#duraciont').value;
        var iniciat = document.querySelector('#iniciat').value;

        datos_tramite.push(
                {"tramite_especifico": tramite_especifico, "idt": idt, "estadot": estadot, "duraciont": duraciont, "iniciat": iniciat}
        );
        var json_datos_objeto = JSON.stringify(datos_objeto);
        var json_datos_tramite = JSON.stringify(datos_tramite);
        var json_datos_tramite_especifico = JSON.stringify(datos_tramite_especifico);
        $.ajax({
            type: "POST",
            url: "controller/registrar_tramite_ajax.php",
            data: {"json_datos_objeto": json_datos_objeto, "json_datos_tramite": json_datos_tramite, "json_datos_tramite_especifico": json_datos_tramite_especifico},
            beforeSend: function ()
            {
                loading.modal('show');
            },
            success: function (result) {
                var jsonData = $.parseJSON(result);
                if (jsonData.success == "1")
                {
                    loading.modal('hide');
                    location.href = './ue_bandeja_enviados.php?proc=regtra&est=1';
                }
            }
        });
    }
}

function validarCamposTramiteEspecifico() {
    debugger;
    let date = new Date();
    var fecha_sistema = (date.toISOString().split('T')[0]);
    var hora_sistema = date.getHours() + ':' + date.getMinutes();

    var objeto_solicitud = document.querySelector('#objeto_solicitud').value;

    var id_provincia = document.querySelector('#id_provincia').value;
    var id_canton = document.querySelector('#id_canton').value;
    var id_parroquia = document.querySelector('#id_parroquia').value;
    var sector = document.querySelector('#sector').value;
    var via_principal = document.querySelector('#via_principal').value;
    var via_secundaria = document.querySelector('#via_secundaria').value;
    var extension = document.querySelector('#extension').value;
    var numero_predio = document.querySelector('#numero_predio').value;
    var numero_catastro = document.querySelector('#numero_catastro').value;

//    var viaja_con_paquete = 1;
//    var id_metodo_envio = document.querySelector('#rdgPropietario').value;
//
//    if (id_metodo_envio != "") {
//        viaja_con_paquete = 2;
//    }

    var id_regional = document.querySelector('#id_regional').value;

    if ($.trim(id_provincia) === "") {
        toastr.error("Seleccione la provincia");
        $("#id_provincia").focus();
        return false;
    } else if ($.trim(id_canton) == "") {
        toastr.error("Seleccione el catón.");
        $("#id_canton").focus();
        return false;
    } else if ($.trim(id_parroquia) == "") {
        toastr.error("Seleccione la parroquia.");
        return false;
    } else if ($.trim(sector) == "") {
        toastr.error("Ingrese el sector");
        $("#sector").focus();
        return false;
    }

    datos_tramite_especifico.push(
            {
                "objeto_solicitud": objeto_solicitud,
                "id_provincia": id_provincia,
                "id_canton": id_canton,
                "id_parroquia": id_parroquia,
                "id_regional": id_regional,
                "sector": sector,
                "via_principal": via_principal,
                "via_secundaria": via_secundaria,
                "extension": extension,
                "numero_predio": numero_predio,
                "numero_catastro": numero_catastro}
    );
    return true;
}

function cambiarModoEnvio() {

    if (document.getElementById("rdgpropietario_1").checked) {
//        document.getElementById("id_metodo_envio").disabled = true;
    } else {
//        document.getElementById("id_metodo_envio").disabled = false;
//        document.getElementById("id_metodo_envio").value = "";
    }
}

function validarFechaEnvio() {
    let date = new Date();
    var fecha_sistema = (date.toISOString().split('T')[0]);

    var fecha_envio = document.querySelector('#fecha_envio').value;
    if (fecha_envio != "") {


        if (fecha_envio < fecha_sistema) {
            toastr.error('Fecha seleccionada incorrecta');
            $("#fecha_envio").val('');
            $("#fecha_envio").focus();
        }
    }
}