<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once 'modelo/clsNacionalidad.php';
include_once 'modelo/clspais.php';
include_once 'modelo/clsregional.php';
include_once 'modelo/clsHorario.php';
include_once("./modelo/clsgenero.php");
?>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form enctype="multipart/form-data" method="post" class="form-padding" action="controller/registrar_tramite.php" autocomplete="off">
            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"]; ?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial; ?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo; ?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
                </div>
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-info-outline"></i> &nbsp; Información General</legend>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 checkbox">
                    <div class="group-material">
                        <input id="ubicacion_domiciliaria" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="ubicacion_domiciliaria">Corresponde a mi ubicación domiciliaria</label>
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["codusuario"]; ?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="provincia" name="provincia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Cotopaxi" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Provincia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_provincia" id="id_provincia"/>
                        <input type="hidden" name="id_regional" id="id_regional" value="<?php echo $_SESSION["regional"];?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="canton" name="canton" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Latacunga" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione el cantón de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantón <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_canton" id="id_canton"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="parroquia" name="parroquia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Juan Montalvo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Parroquia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_parroquia" id="id_parroquia"/>
                    </div>
                </div>                             
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="direccion" name="direccion" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Benalcázar 2340 y 9 de Octubre" required="" maxlength="100" data-toggle="tooltip" data-placement="top" title="Escriba la dirección" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Dirección <span class="sp-requerido">*</span></label>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>País de Origen <span class="sp-requerido">*</span></span>
                        <select name="id_nacionalidad" id="id_nacionalidad" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el país de origen">
                            <option value="" disabled="" selected="">Selecciona el país de origen</option>
                            <?php
                            $pais = new clsNacionalidad;
                            $rsNacionalidad = $pais->nac_seleccionartodo();
                            while ($row = mysqli_fetch_array($rsNacionalidad)) {
                                ?>
                                <option value="<?php echo $row["nac_codigo"]; ?>"><?php echo $row["nac_nombre"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>          
            </div>
            <div class="col-xs-12">
                <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; Datos destino</legend>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input name="fecha_envio" id="fecha_envio" type="date" class="material-control tooltips-general" title="Escriba/seleccione la fecha de envió" placeholder="Escoja una fecha de envió" data-toggle="tooltip" data-placement="top" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de envió <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="direccion-envio" name="direccion_envio" type="text" class="material-control tooltips-general" title="Escriba la dirección de envió" placeholder="Por ejemplo: Av. Miguel Angel Nº 193A Urb. Fiori " required="" maxlength="100" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Dirección de envió<span class="sp-requerido">*</span></label>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>País de Envió <span class="sp-requerido">*</span></span>
                        <select name="id_pais_envio" id="id_pais_envio" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el país de envió">
                            <option value="" disabled="" selected="">Selecciona el país de envió</option>
                            <?php
                            $pais = new clspais();
                            $rsPais = $pais->pais_seleccionartodo();
                            while ($row = mysqli_fetch_array($rsPais)) {
                                ?>
                                <option value="<?php echo $row["pai_codigo"]; ?>"><?php echo $row["pai_nombre"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input id="ciudad-envio" name="ciudad_envio" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Lima" required="" maxlength="100" data-toggle="tooltip" title="Escriba la ciudad de envió" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!-- -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Ciudad de envió<span class="sp-requerido">*</span></label>
                    </div>
                </div> 
            </div>
            <br>
            <div class="row">
                <div class = "col-xs-12">
                    <legend><i class = "zmdi zmdi-calendar-alt"></i> &nbsp;
                        Lugar, Fecha y Hora de Atención</legend>
                </div>
                <div class = "col-xs-12 col-sm-12 col-md-12">
                    <div class = "group-material">
                        <span>Lugar de la cita <span class = "sp-requerido">*</span></span>
                        <select name = "id_regional" id = "id_regional" class = "tooltips-general material-control" required = "" data-toggle = "tooltip" data-placement = "top" title = "Elija la zonal">
                            <option value = "" disabled = "" selected = "">Selecciona la regional</option>
                            <?php
                            $regional = new clsregional();
                            $rsRegional = $regional->regionalSeleccionarActivos();
                            while ($row = mysqli_fetch_array($rsRegional)) {
                                ?>
                                <option value="<?php echo $row[0] ?>"><?php echo $row[1] . " - " . $row[2] . " - " . $row[3] . " - " . $row[4] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        
                        <!--<input id="fecha-envio" name="fecha-envio"  type="date" class="tooltips-general material-control " title="Escriba/seleccione la fecha de envió" placeholder="Escoja una fecha de envió" step="1" max="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" required data-toggle="tooltip" data-placement="top" > title="Escribe el código correlativo del libro, solamente números"-->

                        <input id="fecha_atencion" name="fecha_atencion" type="date" class="tooltips-general material-control" title="Escriba/seleccione la fecha de atención" placeholder="Escoge la fecha de atención" pattern="[0-9]{1,20}"  maxlength="20" data-toggle="tooltip" data-placement="top" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de atención <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <span>Horario disponible <span class="sp-requerido">*</span></span>
                        <select name="id_hora" id="id_hora" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija la hora">
                            <option value="" disabled="" selected="">Selecciona la hora</option>
                            <?php
                            $horario = new clsHorario();
                            $rsHorario = $horario->horarioSeleccionarActivos();
                            while ($row = mysqli_fetch_array($rsHorario)) {
                                ?>
                                <option value="<?php echo $row["ho_codigo"]; ?>"><?php echo $row["ho_hora"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 checkbox">
                    <div class="group-material">
                        <input id="checkbox1" required="" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="checkbox1">Acepto el presente <a href="#" data-toggle="modal" data-target="#ModalRegistroObjeto">Acuerdo de Confidencialidad y Responsabilidad</a></label> 
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
</div>
<?php include_once("./modal/acuerdo_conf.php"); ?>
<?php include_once("./includes/footer.php"); ?>

