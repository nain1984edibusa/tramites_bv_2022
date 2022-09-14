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
    <div class="col-xs-12 col-sm-12 col-md-12">
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
                            <!--<td><?php echo $row[0] ?></td>-->
                            <td><?php echo $row[1] ?></td>
                        </tr>
                    <?php } //fin while  
                    ?> 
                </tbody>
            </table>
        </div>
        <br/>
        <div class="group-material">
            <div class="col-xs-12">
                <legend><i class="zmdi zmdi-border-color"></i> &nbsp; Nueva Proforma</legend>
            </div>
                <div class="group-material">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <span>Tipo análisis químico <span class="sp-requerido">*</span></span>
                                <select id="analisis-quimico" name="analisis-quimico" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona el Evento" onchange="javascript:seleccionarTipoAnalisis();">
                                    <option value="" disabled="" selected="">Seleccione tipo de análisis químico</option> 
                                    <?php
                                    $tipoAnalisisQuimico = new clsTipoAnalisis();
                                    $rsAnalisisQuimico = $tipoAnalisisQuimico->tipoAnalisisSeleccionarTodo();
                                    while ($row = mysqli_fetch_array($rsAnalisisQuimico)) {
                                        ?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                    <?php } // fin while    ?>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="descripcion" name="descripcion" type="text" readonly="ReadOnly" class="tooltips-general material-control" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Concepto</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="group-material">
                                <input id="cantidad" name="cantidad" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10"  maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nro. Items de ensayo</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="group-material">
                                <input id="valor_unitario" name="valor_unitario" type="number"  readonly="ReadOnly"class="material-control tooltips-general" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Precio por ítem de ensayo <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            <div class="row">        
                                <div class="col-xs-12 col-sm-12">
                                    <span class="text-danger align-middle" id="Msg"></span>
                                </div>
                            </div>-->
        </div>
        <div class="row">
            <div class="col-xs-12">
                <p class="text-center">
                    <button type="button" value="Agregar" id="agregar" class="btn btn-info"  style="margin-right: 20px;"><i class="zmdi zmdi-plus-circle-o"></i> &nbsp;&nbsp; Agregar item</button>
                    <button type="button" value="Guardar" id="guardarDetalle" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Guardar</button>
                </p>
            </div>
        </div>
        <div class="group-material">
            <!--        <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                            <input type="button" value="Agregar" class="btn btn-success mt-3" id="agregar">
                        </div>
                        <div class="col-xs-6 text-center">
                            <button type="submit" id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Registrarse</button>
                            <input type="button" value="Guardar" class="btn btn-success mt-3" id="guardar">
                        </div>
                    </div>
                </div>
                <br/>-->

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
                </table>
                <div class="col-10 text-right" id="subtotal"></div>
                <div class="col-10 text-right" id="iva"></div>
                <div class="col-10 text-right" id="total"></div>
            </div>

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

