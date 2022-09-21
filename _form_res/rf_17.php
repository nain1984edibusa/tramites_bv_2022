<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clsTipoAnalisis.php");
/* incluir modelo(s) */
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
include_once("./modelo/clstuanexos.php");
//include_once("./modelo/clstramiteanexos.php");
include_once("./modelo/clstramiteusuario.php");
include_once("./modelo/cls17AnalisisQuimico.php");
include_once("./modelo/clsTipoAnalisis.php");
include_once("./modelo/clstramite17DetalleProforma.php");
/**/
$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();

/* detalle proforma */
$detalleProforma = new clstramite17DetalleProforma();
$detalleProforma->setTu_id($tespecifico["tu_id"]);
$detalleProforma = $detalleProforma->detalleProformaPorTramite();

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
        <span>Información Adicional <span class="sp-requerido">*</span></span>
        <?php
        $infoadicional = "";
        if (isset($trespuesta)) {
            $infoadicional = $trespuesta["tuc_infoadicional"];
        }
        ?>
        <textarea id="infoadicional" name="infoadicional" rows="4" class="tooltips-general material-control" placeholder="" required="" data-toggle="tooltip" data-placement="top" title="Escriba información adicional que se incluya en la respuesta"><?php echo str_replace('<br />', '\n', $infoadicional); ?></textarea>
    </div>
    <div class="group-material">
        <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-file-text"></i> &nbsp; Pedido de Análisis Químico solicitado por el usuario</legend>
        </div>
        <table class="table table-bordered">
            <thead class="btn-primary">
                <tr>
                    <th>Ensayo/Parámetro</th>
                </tr>
            </thead>
            <tbody style="background-color:#fff;">
                <?php
                $rstra = $analisisQuimico17;
                while ($row = mysqli_fetch_array($analisisQuimico17)) {
                    ?>
                    <tr>
                        <td><?php echo $row[1] ?></td>
                    </tr>
                <?php } //fin while  
                ?> 
            </tbody>
        </table>
    </div>
    <div class="group-material">
        <legend><i class="zmdi zmdi-border-color"></i> &nbsp; Nueva Proforma</legend>
    </div>
    <div class="group-material">
        <button type="reset" id="registrarse" class="btn btn-info" data-toggle="modal" data-target="#ModalRegistroItem"> Agregar item &nbsp;&nbsp; <i class="zmdi zmdi-account-add"></i></button>       
    </div>
    <div class="group-material" id="productos">
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-file"></i> &nbsp; Detalle items ingresados</legend>
        </div>
        <table class="table table-bordered" id="lista">
            <thead class="btn-primary">
                <tr>
                    <td>Ensayo/Parámetro</td>
                    <td>Nro. Items <br> de ensayo</td>
                    <td>Precio por <br> ítem de ensayo US$</td> 
                    <td>Total a pagar</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody style="background-color:#fff;">
                <?php
                $rstra = $analisisQuimico17;
                $detalles = $detalleProforma;
                while ($row = mysqli_fetch_array($detalles)) {
                    ?>
                    <tr>
                        <td><?php echo $row[3] ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[4] ?></td>
                        <td><?php echo $row[5] ?></td>
                    </tr>
                <?php } //fin while
                ?>
            </tbody>
        </table>
        <div class="col-10 text-right" id="subtotal"></div>
        <div class="col-10 text-right" id="iva"></div>
        <div class="col-10 text-right" id="total"></div>
    </div>
</div>
<?php
include_once('./modal/registro_detalle_proforma.php');
?>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
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
</script>

