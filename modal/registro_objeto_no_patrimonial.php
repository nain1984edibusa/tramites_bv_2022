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
include_once("./modelo/clstipobiencultural.php");
?>

<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistroObjeto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Registro de Objetos</h4>
            </div>
            </br>
            <form role="form" method="post" id="agregar">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="cantidad" name="cantidad" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantidad<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <span>País de bien cultural <span class="sp-requerido">*</span></span>
                                <select name="tipobiencultural" id="tipobiencultural" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural">
                                    <option value="" disabled="" selected="">Selecciona el tipo de bien cultural</option>
                                    <?php
                                    $tipoBienCultural = new clstipobiencultural();
                                    $rsTipoBienCultural = $tipoBienCultural->tipoBienCulturalSeleccionarActivos();
                                    while ($row = mysqli_fetch_array($rsTipoBienCultural)) {
                                        ?>
                                        <option value="<?php echo $row["tbc_codigo"]; ?>"><?php echo $row["tbc_nombre"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="tema" name="tema" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Abstracto" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Tema <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="autor" name="autor" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Autor <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="tecnica" name="tecnica" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Oleo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Técnica <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <div class="group-material">
                                    <input id="largo" name="largo" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Largo (cm)<span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="ancho" name="ancho" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ancho (cm)<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="group-material">
                                <input id="profundidad" name="profundidad" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Profundidad (cm)<span class="sp-requerido">*</span></label>
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
                <button type="submit" class="btn btn-default">Agregar</button>
            </form>
        </div>
    </div>
</div>

