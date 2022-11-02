<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2022
 */
include_once("./modelo/clsTipoAnalisis.php");
?>
<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistroItem2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Registro de items 2</h4>
            </div>
            </br>
            <div class="modal-body">
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
                                    <?php } // fin while     ?>
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
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-6 text-center">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                    </div>
                    <div class="col-xs-6 text-center">
                        <button type="button" value="Agregar" id="agregar" class="btn btn-info"  style="margin-right: 20px;"><i class="zmdi zmdi-plus-circle-o"></i> &nbsp;&nbsp; Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
