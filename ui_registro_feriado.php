<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

$modulo="Visualizar";
$opcion="Detalles del Feriado";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
include_once("./modelo/clsregional.php");
/*incluir modelo(s)*/
//include_once("./modelo/Config.class.php");
//include_once("./modelo/Db.class.php");
include_once("./modelo/clsferiados.php");
/*generar instancias*/
   
    $area = new clsregional;
    $rsarea = $area->regional_seleccionartodo();
    
    //echo $tra_id;
?>

<?php
$redireccion="ui_adm_fechas.php";
?>
<div class="container-fluid">
    <div class="row msuperior">
        <div class="col-xs-3">
            <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
        </div>

    </div>
</div>
<div class="container-fluid">      
    <?php include_once './includes/errores.php';?>
</div>

    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form enctype="multipart/form-data" method="post" class="form-padding" action="controller/registrar_feriado.php" autocomplete="off">
                                                
            <div class="row">
               
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar"></i> &nbsp; Información del Feriado a Registrar</legend>
                </div>
                
                <div class="row margensup">
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="group-material">
                            <input id="nombre_feriado" name="nombre_feriado" type="text" value = "" class="tooltips-general material-control" placeholder="Ingrese la descripción del feriado" required="true" maxlength="200" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Descripción del Feriado<span class="sp-requerido">*</span></label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <input id="dia_conmemoracion" name="dia_conmemoracion" type="text" value = "" class="tooltips-general material-control" required="true" maxlength="2" data-toggle="tooltip" data-placement="top" title="Ingrese sus nombres" onKeyUp="this.value = this.value.toUpperCase();">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label>Día de conmemoración  <span class="sp-requerido">*</span></label>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <span>Seleccione el Mes de Conmemoración<span class="sp-requerido">*</span></span>
                            <select name="mes_conmemoracion" id="mes_conmemoracion" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona la regional" required="true">
                                <option value = "" disabled="" selected="">Seleccione el mes de Conmemoración </option>                           
                                <option value="ENERO">ENERO</option>
                                <option value="FEBRERO">FEBRERO</option>
                                <option value="MARZO">MARZO</option>
                                <option value="ABRIL">ABRIL</option>
                                <option value="MAYO">MAYO</option>
                                <option value="JUNIO">JUNIO</option>
                                <option value="JULIO">JULIO</option>
                                <option value="AGOSTO">AGOSTO</option>
                                <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                                <option value="OCTUBRE">OCTUBRE</option>
                                <option value="NOVIEMBRE">NOVIEMBRE</option>
                                <option value="DICIEMBRE">DICIEMBRE</option>
                            </select>

                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <span>Seleccione el Tipo de Feriado<span class="sp-requerido">*</span></span>
                            <select name="tipo_feriado" id="tipo_feriado" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona la regional" required="true">
                                <option value="" disabled="" selected="">Seleccione el Tipo de Feriado</option>                           
                                <option value="LOCAL">LOCAL</option>
                                <option value="NACIONAL">NACIONAL</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="group-material">
                            <span>Seleccione la Regional a cual pertenece el Feriado<span class="sp-requerido">*</span></span>
                            <select name="sel_regional" id="sel_regional" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" title="Selecciona la regional" required="true">
                                <option value="" disabled="" selected="">Seleccione la Regional</option> 
                                <?php while($row = $rsarea->fetch_row()){?>
                                <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                <?php } // fin while?>
                            </select>                        
                        </div>
                    </div>
                
                </div>
                
                           
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="feriado_inicio" name="feriado_inicio" type="date" value="<?php echo $fechaInicioFeriado["fea_fecha"] ?>" class="material-control tooltips-general" required="true" data-toggle="tooltip" data-placement="top"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de Incio de Feriado <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="feriado_fin" name="feriado_fin" type="date" value = "<?php echo $fechaFinFeriado["fea_fecha"]?>"class="material-control tooltips-general" required="true" data-toggle="tooltip" data-placement="top"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de Fin de Feriado<span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-xs-12">
                    <p class="text-center">
                        <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Enviar</button>
                        <!--<a href="ue_bandeja_enviados.php?proc=regtra&est=1" class="enlace_especial">Completado</a>-->
                    </p>
               </div>
            </div>

            
       </form>
    </div>


<?php 
include_once('./modal/validar_requisitos.php');
include_once('./modal/validar_anexos.php');
include_once('./modal/validar_respuesta.php');
include_once('./modal/reasignar_tramite.php'); 
include_once('./modal/convalidar_tramite.php');
include_once("./includes/footer.php");
include_once('./modal/auditoria.php'); 

?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>
<script type="text/javascript" src="js/_ui_visualizacion_tramite.js"></script>

