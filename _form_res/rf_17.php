<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./modelo/cls17AnalisisQuimico.php");
include_once("./modelo/clsTipoAnalisis.php");

$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();
//$analisisQuimico17 = mysqli_fetch_array($analisisQuimico17);

$tipoAnalisis = new clsTipoAnalisis();
$catalogoTipoAnalisis = $tipoAnalisis->tipoAnalisisSeleccionarTodo();
$catalogoTipoAnalisisAux = [];
//$catalogoTipoAnalisis = mysqli_fetch_array($catalogoTipoAnalisis);
?>

<?php foreach ($catalogoTipoAnalisis as $catalogo): ?>
    <?php
    $ta1 = $catalogo["ta_id"]
    ?>

    <?php foreach ($analisisQuimico17 as $seleccionado): ?>
        <?php
        $ta1 = $seleccionado["ta_id"]
        ?>


    <?php endforeach ?>  

<?php endforeach ?>  


<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="group-material">
        <form>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Registro de Objetos</h4>
            </div>
            </br>
            <div class="modal-body">
                <div class="row">


                    <div class="col-xs-12 col-sm-12">
                        <div class="group-material">
                            <input id="descripcion" name="descripcion" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Concepto<span class="sp-requerido">*</span></label>
                        </div>
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
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-xs-6 text-center">
                <!--<button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>-->
                <input type="button" value="Agregar" class="btn btn-success mt-3" id="agregar">
            </div>
            <div class="col-xs-6 text-center">
                <!--<button type="submit" id="btn_registrarse" class="btn btn-success"><i class="zmdi zmdi-account-add"></i> &nbsp; Registrarse</button>-->
                <input type="button" value="Guardar" class="btn btn-success mt-3" id="guardar">
            </div>
        </div>
    </div>
</form>

<div class="col-12" id="productos" >
    <table class="table table-striped" id="lista">
        <tr>
            <td>Ensayo/Parámetro</td>
            <td>Nro. Items <br> de ensayo</td>
            <td>Precio por <br> ítem de ensayo US$</td> 
            <td>Total a pagar</td>
            <td>Acciones</td>
        </tr>
    </table>
</div>
<div class="col-10 text-right" id="total"></div>
</div>
</div>
<script type="text/javascript" src="js/app.js"></script>



