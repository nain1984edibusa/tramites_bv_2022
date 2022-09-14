var boton = document.getElementById('agregar');
var guardar = document.getElementById('guardarDetalle');
var lista = document.getElementById("lista");
var data = [];
var datos_tramite = [];
boton.addEventListener("click", agregar);
guardar.addEventListener("click", save);

var tramite_especifico = document.querySelector('#tu_id').value;
datos_tramite.push(
        {"tramite_especifico": tramite_especifico}
);
var cant = 0;
function agregar() {
    debugger;
    var tramite_especifico = document.querySelector('#tu_id').value;
    var id_analisis_quimico = document.querySelector('#analisis-quimico').value;
    var descripcion = document.querySelector('#descripcion').value;
    var precio = parseFloat(document.querySelector('#valor_unitario').value);
    var cantidad = parseFloat(document.querySelector('#cantidad').value);
    var total_a_pagar = precio * cantidad;
    //agrega elementos al arreglo
    data.push(
            {"id": cant, "id_analisis_quimico": id_analisis_quimico, "tramite_especifico": tramite_especifico, "descripcion": descripcion, "cantidad": cantidad, "precio": precio, "total": total_a_pagar}
    );

    //convertir el arreglo a json
    // console.log(JSON.stringify(data));
    var id_row = 'row' + cant;
    var fila = '<tr id=' + id_row + '><td>' + descripcion + '</td><td>' + cantidad + '</td><td>' + precio + '</td><td>' + total_a_pagar + '</td><td><a href="#" class="btn btn-danger" onclick="eliminar(' + cant + ')";>Eliminar</a></td></tr>';

    //agregar fila a la tabla
    $("#lista").append(fila);
    $("#descripcion").val('');
    $("#cantidad").val('');
    $("#valor_unitario").val('');
    $("#nombre").focus();
    cant++;
    sumar();
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
/*
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
 
 */
function sumar() {
    let subtot = 0;
    let tot = 0;
    let iva = 0;
    for (x of data) {
        subtot = subtot + x.total;
    }
    iva = (subtot * 12) / 100;
    tot = subtot + iva;
    document.querySelector("#subtotal").innerHTML = "SUB TOTAL: " + subtot;
    document.querySelector("#iva").innerHTML = "12% IVA: " + iva;
    document.querySelector("#total").innerHTML = "TOTAL: " + tot;
}


function save() {
    debugger
    var json = JSON.stringify(data);
    var json_datos_tramite = JSON.stringify(datos_tramite);
    $.ajax({
        type: "POST",
        url: "controller/registrar_detalle_proforma.php",
        data: {"json": json, "json_datos_tramite": json_datos_tramite},
        success: function (respo) {
            location.reload();
        }
    });
}