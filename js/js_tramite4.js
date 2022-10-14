var boton_agregar = document.getElementById('agregar');
var boton_guardar = document.getElementById('guardar');
var lista = document.getElementById("lista");
var data = [];
var datos_tramite = [];
var datos_tramite_especifico = [];

boton_agregar.addEventListener("click", agregar);
boton_guardar.addEventListener("click", enviar);

var cant = 0;
function agregar() {
    //        alert('0K');
    isBool = validarCamposObjeto();
    if (isBool === true) {
        var cantidad = parseFloat(document.querySelector('#cantidad').value)
        var tipo_bien_cultural = document.querySelector('#tipo_bien_cultural').value;
        var descripcion_bien_cultural = document.querySelector('#descripcion_bien_cultural').value;
        var tema = document.querySelector('#tema').value;
        var autor = document.querySelector('#autor').value;
        var tecnica = document.querySelector('#tecnica').value;
        var largo = parseFloat(document.querySelector('#largo').value);
        var ancho = parseFloat(document.querySelector('#ancho').value);
        var profundidad = parseFloat(document.querySelector('#profundidad').value);
        var dimensiones = largo + 'x' + ancho + 'x' + profundidad + 'cm';

        //agrega elementos al arreglo
        data.push(
                {"id": cant, "cantidad": cantidad, "tipo_bien_cultural": tipo_bien_cultural, "descripcion_bien_cultural": descripcion_bien_cultural, "tema": tema, "autor": autor, "tecnica": tecnica, "largo": largo, "ancho": ancho, "profundidad": profundidad, "dimensiones": dimensiones}
        );

        //convertir el arreglo a json
        // console.log(JSON.stringify(data));
        var id_row = 'row' + cant;
        var fila = '<tr id=' + id_row + '><td>' + cantidad + '</td><td>' + descripcion_bien_cultural + '</td><td>' + tema + '</td><td>' + autor + '</td><td>' + tecnica + '</td><td>' + dimensiones + '</td><td><a href="#" class="zmdi zmdi-delete" class="btn btn-default" onclick="eliminar(' + cant + ')";></a></td></tr>';
        //agregar fila a la tabla
        $("#lista").append(fila);
        $("#cantidad").val('');
        $("#tipo_bien_cultural").val('');
        $("#descripcion_bien_cultural").val('');
        $("#tema").val('');
        $("#autor").val('');
        $("#tecnica").val('');
        $("#largo").val('');
        $("#ancho").val('');
        $("#profundidad").val('');
        cant++;
    } else {
//        alert ('KO');
    }

}
function eliminar(row) {
    //remueve la fila de la tabla html
    $("#row" + row).remove();
    //remover el elmento del arreglo
    //data.splice(row,1);
    //buscar el id a eliminar
    var i = 0;
    var pos = -1;
    for (x of data) {
        console.log(x.id);
        if (x.id == row) {
            pos = i;
        }
        i++;
    }
    data.splice(pos, 1);
    sumar();
}
function cantidad(row) {
    var canti = parseInt(prompt("Nueva cantidad"));
    data[row].cantidad = canti;
    data[row].total = data[row].cantidad * data[row].precio;
    var filaid = document.getElementById("row" + row);
    celda = filaid.getElementsByTagName('td');
    celda[2].innerHTML = canti;
    celda[3].innerHTML = data[row].total;
    console.log(data);
    sumar();
}

function validarCamposObjeto() {
    var cantidad = document.querySelector('#cantidad').value;
    var tipobiencultural = document.querySelector('#tipo_bien_cultural').value;
    var tema = document.querySelector('#tema').value;
    var autor = document.querySelector('#autor').value;
    var tecnica = document.querySelector('#tecnica').value;
    var largo = document.querySelector('#largo').value;
    var ancho = document.querySelector('#ancho').value;
    var profundidad = document.querySelector('#profundidad').value;

    if ($.trim(cantidad) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese la cantidad.");
        $("#mensaje").fadeOut(4000);
        $("#cantidad").focus();
        return false;
    } else if ($.trim(tipobiencultural) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Seleccione el tipo de bien cultural.");
        $("#mensaje").fadeOut(4000);
        $("#tipobiencultural").focus();
        return false;
    } else if ($.trim(tema) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese el tema.");
        $("#mensaje").fadeOut(4000);
        $("#tema").focus();
        return false;
    } else if ($.trim(autor) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese el autor.");
        $("#mensaje").fadeOut(4000);
        $("#autor").focus();
        return false;
    } else if ($.trim(tecnica) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese la tecnica.");
        $("#mensaje").fadeOut(4000);
        $("#tecnica").focus();
        return false;
    } else if ($.trim(largo) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese el largo.");
        $("#mensaje").fadeOut(4000);
        $("#largo").focus();
        return false;
    } else if ($.trim(ancho) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese el ancho.");
        $("#mensaje").fadeOut(4000);
        $("#ancho").focus();
        return false;
    } else if ($.trim(profundidad) == "") {
        $("#mensaje").show();
        $("#mensaje").html("Ingrese la profundidad.");
        $("#mensaje").fadeOut(4000);
        $("#profundidad").focus();
        return false;
    }
    return true;
}

function seleccionarTipoBienCultural() {
    check = document.getElementById("tipo_bien_cultural");
    var itemSeleccionado = check.value;
    $.ajax({
        type: "POST",
        url: "ajax/obtener_tipo_bien_cultural.php",
        cache: false,
        data: {itemSeleccionado: itemSeleccionado},
        success: function (datos) {
            var data = $.parseJSON(datos);

            $.each(data, function (i, item) {
                $("#tipo_bien_cultural").val(item.tipobiencultural);
                $("#descripcion_bien_cultural").val(item.nombre);
            });
        }
    });
}

function enviar() {
    debugger
    alert('0K');

    isBool = validarCamposTramiteEspecifico();



    var tramite_especifico = 0;
    var idt = document.querySelector('#idt').value;
    var estadot = document.querySelector('#estadot').value;
    var duraciont = document.querySelector('#duraciont').value;
    var iniciat = document.querySelector('#iniciat').value;

    datos_tramite.push(
            {"tramite_especifico": tramite_especifico, "idt": idt, "estadot": estadot, "duraciont": duraciont, "iniciat": iniciat}
    );

    var json = JSON.stringify(data);
    var json_datos_tramite = JSON.stringify(datos_tramite);
    var json_datos_tramite_especifico = JSON.stringify(datos_tramite_especifico);
    $.ajax({
        type: "POST",
        url: "controller/registrar_tramite_ajax.php",
        data: {"json": json, "json_datos_tramite": json_datos_tramite, "json_datos_tramite_especifico": json_datos_tramite_especifico},
        success: function (respo) {
            location.reload();
        }
    });
}


function validarCamposTramiteEspecifico() {
    debugger;
    var id_provincia = document.querySelector('#id_provincia').value;
    var id_canton = document.querySelector('#id_canton').value;
    var id_parroquia = document.querySelector('#id_parroquia').value;
    var direccion = document.querySelector('#direccion').value;
    var id_pais_origen = document.querySelector('#id_pais_origen').value;

    var fecha_envio = document.querySelector('#fecha_envio').value;
    var direccion_envio = document.querySelector('#direccion_envio').value;
    var id_pais_envio = document.querySelector('#id_pais_envio').value;
    var ciudad_envio = document.querySelector('#ciudad_envio').value;

    var id_regional = document.querySelector('#id_regional').value;
    var id_zonal = document.querySelector('#id_zonal').value;
    var fecha_atencion = document.querySelector('#fecha_atencion').value;
    var id_hora = document.querySelector('#id_hora').value;

    datos_tramite_especifico.push(
            {"id_provincia": id_provincia,
                "id_canton": id_canton,
                "id_parroquia": id_parroquia,
                "direccion": direccion,
                "id_pais_origen": id_pais_origen,
                "fecha_envio": fecha_envio,
                "direccion_envio": direccion_envio,
                "id_pais_envio": id_pais_envio,
                "ciudad_envio": ciudad_envio,
                "id_regional": id_regional,
                "id_zonal": id_zonal,
                "fecha_atencion": fecha_atencion,
                "id_hora": id_hora}
    );


//    if ($.trim(cantidad) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese la cantidad.");
//        $("#mensaje").fadeOut(4000);
//        $("#cantidad").focus();
//        return false;
//    } else if ($.trim(tipobiencultural) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Seleccione el tipo de bien cultural.");
//        $("#mensaje").fadeOut(4000);
//        $("#tipobiencultural").focus();
//        return false;
//    } else if ($.trim(tema) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese el tema.");
//        $("#mensaje").fadeOut(4000);
//        $("#tema").focus();
//        return false;
//    } else if ($.trim(autor) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese el autor.");
//        $("#mensaje").fadeOut(4000);
//        $("#autor").focus();
//        return false;
//    } else if ($.trim(tecnica) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese la tecnica.");
//        $("#mensaje").fadeOut(4000);
//        $("#tecnica").focus();
//        return false;
//    } else if ($.trim(largo) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese el largo.");
//        $("#mensaje").fadeOut(4000);
//        $("#largo").focus();
//        return false;
//    } else if ($.trim(ancho) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese el ancho.");
//        $("#mensaje").fadeOut(4000);
//        $("#ancho").focus();
//        return false;
//    } else if ($.trim(profundidad) == "") {
//        $("#mensaje").show();
//        $("#mensaje").html("Ingrese la profundidad.");
//        $("#mensaje").fadeOut(4000);
//        $("#profundidad").focus();
//        return false;
//    }
    return true;
}