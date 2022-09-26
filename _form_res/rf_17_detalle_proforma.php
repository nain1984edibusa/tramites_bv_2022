<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

$modulo = "Responder";
$opcion = "Trámite Recibido";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
/* incluir modelo(s) */
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
include_once("./modelo/clstuanexos.php");
//include_once("./modelo/clstramiteanexos.php");
include_once("./modelo/clstramiteusuario.php");
include_once("./modelo/cls17AnalisisQuimico.php");
include_once("./modelo/clsTipoAnalisis.php");

$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();

/* generar instancias */
if ((isset($_GET["idtu"]) && (!empty($_GET["idtu"])))) { //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id = $ttramite["tra_id"];
    $tra_codigo = $ttramite["tu_codigo"];
    $regionalId = $ttramite["reg_id"]; // Para Tramite 5
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="group-material">
        <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-file-text"></i> &nbsp; Pedido de Análisis Químico solicitado por el usuario</legend>
        </div>
        <table class="table table-bordered">
            <thead class="btn-primary">
                <tr>
                    <th style="width: 10%">Código Parámetro</th>
                    <th>Ensayo/Parámetro</th>
                </tr>
            </thead>
            <tbody style="background-color:#fff;">
                <?php
                $rstra = $analisisQuimico17;
                while ($row = mysqli_fetch_array($analisisQuimico17)) {
                    ?>
                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                    </tr>
                <?php } //fin while  
                ?> 
            </tbody>
        </table>
    </div>
    <br/>
    <div class="group-material">
        <div class="group-material">
            <legend><i class="zmdi zmdi-border-color"></i> &nbsp; Nueva Proforma</legend>
        </div>
    </div>
    <div class="group-material">
        <button type="button" id="registrarse" class="btn btn-info" data-toggle="modal" data-target="#ModalRegistroItem"> Agregar item &nbsp;&nbsp; <i class="zmdi zmdi-account-add"></i></button>       
    </div>
    <div id="tabla">
    </div>
</div>
<div>
    <?php
    include_once('./modal/registro_detalle_proforma.php');
    ?>
</div>

<script type="text/javascript">
    cargarTabla();

    function cargarTabla() {
        var tramite_especifico = document.querySelector('#tu_id').value;
        $.ajax({
            type: "POST",
            url: "_form_res/rf_17_tabla_proforma.php",
            cache: false,
            data: {tramite_especifico: tramite_especifico},
            success: function (data) {
                $("#tabla").html(data);
            }
        });
    }


    function seleccionarTipoAnalisis() {
        check = document.getElementById("analisis-quimico");
        var itemSeleccionado = check.value;
        $.ajax({
            type: "POST",
            url: "ajax/obtener_valor_unitario.php",
            cache: false,
            data: {itemSeleccionado: itemSeleccionado},
            success: function (datos) {
                $("#Msg").html("<div class='alert alert-success' role='alert'>Registrado.</div> ");
                jQuery('#nombre').val(50);
                var data = $.parseJSON(datos);

                $.each(data, function (i, item) {
                    $("#valor_unitario").val(item.valor_unitario);
                    $("#descripcion").val(item.concepto);
                });
            }
        });
    }

    var cant = 0;
    var boton = document.getElementById('agregar');
    var data = [];
    var datos_tramite = [];
    boton.addEventListener("click", guardarDetalle);

    function guardarDetalle() {
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
</script>

