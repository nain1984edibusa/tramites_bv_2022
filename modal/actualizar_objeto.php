<?php
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
include_once '../modelo/clstramite4objeto.php';
include_once '../modelo/clstipobiencultural.php';
include_once '../modelo/clstramite4tipocontenedor.php';

session_start();
//include "conexion.php";
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$obj_id = $_GET["id"];

$objeto = new clstramite4objeto();
$objeto->setObj_id($obj_id);
$oespecifico = $objeto->obj_seleccionar_objeto_por_id();
$oespecifico = mysqli_fetch_object($oespecifico);

$host = "localhost";
$user = "tramitesp";
$password = "Patrimoni02019";
$db = "tramites_bv";
$con = new mysqli($host, $user, $password, $db);

$sql = " SELECT * FROM _ct_tramite4_estado_objeto ";
$rsCondicion = $con->query($sql);

$sql1 = " SELECT * FROM _ct_tramite4_tipo_bien_cultural ";
$query1 = $con->query($sql1);

$sql2 = " SELECT * FROM _ct_tramite4_tipo_contenedor ";
$rsTipoContenedor = $con->query($sql2);

$sql3 = " SELECT * FROM _ct_tramite4_contenedor where obj_id = " . $oespecifico->obj_id . " and tu_id = " . $oespecifico->tu_id;
$rsContenedor = $con->query($sql3);
$rsContenedor = mysqli_fetch_object($rsContenedor);
?>
<div>
    <script type="text/javascript" src="js/funciones_generales.js"></script>
    <form role="form" id="actualizar" method="post" class="form-padding">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="group-material">
                    <input id="cantidad" name="cantidad"  type="number" value="<?php echo $oespecifico->obj_cantidad; ?>" min="0" type="number" class="tooltips-general material-control"  required="" data-toggle="tooltip" data-placement="top" onkeypress="return valida_solonumeros(event)";"><!--title="Escriba su número de identificación"-->
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Cantidad<span class="sp-requerido">*</span></label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="group-material">
                    <div class="group-material">
                        <span>Tipo de bien cultural <span class="sp-requerido">*</span></span>
                        <select name="tipo_bien_cultural" id="tipo_bien_cultural" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural" onchange="javascript:seleccionarTipoBienCultural();">
                            <option value="" disabled="" selected="">Selecciona el tipo de bien cultural</option>
                            <?php
                            while ($row = mysqli_fetch_row($query1)) {
                                if ($row[0] == $oespecifico->tbc_id)
                                    $selected = "selected";
                                else
                                    $selected = "";
                                ?>	
                                <option <?php echo $selected ?> value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php } // fin while  ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input id="tema" name="tema" type="text" value="<?php echo $oespecifico->obj_tema; ?>"class="tooltips-general material-control" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Tema <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input id="autor" name="autor" type="text" value="<?php echo $oespecifico->obj_autor; ?>"class="tooltips-general material-control" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Autor <span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input id="tecnica" name="tecnica" type="text" value="<?php echo $oespecifico->obj_tecnica; ?>"class="tooltips-general material-control" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Técnica <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <div class="group-material">
                            <input id="largo" name="largo" min="0" type="number" value="<?php echo $oespecifico->obj_largo; ?>"class="material-control tooltips-general" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Altura (cm)<span class="sp-requerido">*</span></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input id="ancho" name="ancho" min="0" type="number" value="<?php echo $oespecifico->obj_ancho; ?>"class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Ancho (cm)<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <input id="profundidad" min="0" name="profundidad" type="number" value="<?php echo $oespecifico->obj_profundidad; ?>"class="material-control tooltips-general" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Profundidad (cm)<span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>

            <!--onchange="javascript:showContent();-->
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="group-material">
                        <span>Seleccionar condición <span class="sp-requerido">*</span></span>

                        <select name="id_condicion" id="id_condicion" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural" onchange="javascript:showContent();">
                            <option value="" disabled="" selected="">Selecciona la condición</option>
                            <?php
                            while ($row = mysqli_fetch_row($rsCondicion)) {
                                if ($row[0] == $oespecifico->eob_id)
                                    $selected = "selected";
                                else
                                    $selected = "";
                                ?>	
                                <option <?php echo $selected ?> value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php } // fin while  ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel panel-default" id="datosContenedor">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-file-text"></i> &nbsp;  <b>Contenedor</b></legend>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="group-material">
                                <span>Seleccionar condición</span>
                                <select name="id_tipo_contenedor" id="id_tipo_contenedor" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el tipo de contenedor">
                                    <option value="" disabled="" selected="">Selecciona el tipo de contenedor</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($rsTipoContenedor)) {
                                        ?>
                                        <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
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
                                <input id="numero_contenedor" name="numero_contenedor"  value="<?php echo $rsContenedor->con_numero; ?>" min="0" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="10" data-toggle="tooltip" data-placement="top";">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número Contenedor</label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6" >
                            <div class="group-material">
                                <input id="numero_seguridad" name="numero_seguridad"  value="<?php echo $rsContenedor->con_seguridad; ?>" min="0" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="10" data-toggle="tooltip" data-placement="top";">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número Seguridad</label>
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
                        <input type="hidden"  name="obj_id" value="<?php echo $oespecifico->obj_id; ?>">
                        <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $oespecifico->tu_id; ?>">
                        <input type="hidden" name="tbc_id" value="<?php echo $oespecifico->tbc_id; ?>">
                        <input type="hidden"  name="eob_id" value="<?php echo $oespecifico->eob_id; ?>">
                        <input type="hidden" name="con_id" value="<?php echo $oespecifico->con_id; ?>">
                        <button type="submit" formnovalidate="" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i>&nbsp; Guardar</button>
                    </div>
                </div>
            </div>
    </form>
</div>

<script>
    
    showContent();
    
    function showContent() {
        element2 = document.getElementById("datosContenedor");
        check = document.getElementById("id_condicion");
        if (check.value == 2) {
            element2.style.display = 'block';
        } else {
            element2.style.display = 'none';
        }
    }
    
    $("#actualizar").submit(function (e) {
        e.preventDefault();
        $.post("./controller/actualizar_objeto.php", $("#actualizar").serialize(), function (data) {
             cargarTablaObjetos();
        });
    });

</script>

