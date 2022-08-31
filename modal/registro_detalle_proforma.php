<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2022
 */
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clsTipoAnalisis.php");
?>

<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistroItem">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="controller/registrar_detalle_proforma.php"  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Registro de Objetos</h4>
                </div>
                </br>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <span>Tipo análisis químico <span class="sp-requerido">*</span></span>
                                <select name="analisis-quimico" id="analisis-quimico" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural">
                                    <option value="" disabled="" selected="">Selecciona el tipo de análisis químico</option>
                                    <?php
                                    $tipoAnalisisQuimico = new clsTipoAnalisis();
                                    $rsAnalisisQuimico = $tipoAnalisisQuimico->tipoAnalisisSeleccionarTodo();
                                    while ($row = mysqli_fetch_array($rsAnalisisQuimico)) {
                                        ?>
                                        <option value="<?php echo $row["ta_codigo"]; ?>"><?php echo $row["ta_concepto"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="cantidad" name="cantidad" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantidad<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="valor_unitario" name="valor_unitario" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Unitario<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <input id="valor_total" name="valor_total" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor Total<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                        </div>
                        <div class="col-xs-6 text-center">
                                   <button name="guardar" type="submit" class="btn btn-primary">Registrar Ahora</button>
                            <!--<button type="submit" id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Registrarse</button>-->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>

<!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button name="guardar" type="submit" class="btn btn-primary">Registrar Ahora</button>-->

