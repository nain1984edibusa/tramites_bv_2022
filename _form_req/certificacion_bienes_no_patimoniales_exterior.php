<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once 'modelo/clsnacionalidad.php';
include_once 'modelo/clspais.php';
include_once 'modelo/clsregional.php';
include_once 'modelo/clsHorario.php';
include_once 'modelo/clstramite4objeto.php';
include_once 'modelo/clstramite4modoenvio.php';
include_once 'modelo/clstipobiencultural.php';

session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Hoja de estilos Toastr--> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!--   JQuery Primero 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <!--Toastr.js Después--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head> 
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        <form id="formulario_tramite" class="form-padding">

            <div id="msg-alert-danger" class="alert alert-danger alert-dismissible"  style="display: none;"></div>
            <div id="msg-alert-success" class="alert alert-success alert-dismissible"  style="display: none;"></div>

            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"]; ?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial; ?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo; ?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
            <div class="row">
                <div class="col-xs-12">
                    <p class="instrucciones_formularios_ct">Recuerde que los campos marcados con <span class="sp-requerido">*</span> son requeridos.</p>
                </div>
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-info-outline"></i> &nbsp; <b> Información General </b></legend>
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
                        <input type="hidden" name="id_regional" id="id_regional" value="<?php echo $_SESSION["regional"]; ?>"/>
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
                        <span>Nacionalidad<span class="sp-requerido">*</span></span>
                        <select name="id_pais_origen" id="id_pais_origen" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija la nacionalidad">
                            <option value="" disabled="" selected="">Selecciona la nacionalidad</option>
                            <?php
                            $nacionalidad = new clsnacionalidad;
                            $rsNacionalidad = $nacionalidad->nac_seleccionartodo();
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
            <br>
            <div class="col-xs-12">
                <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; <b> Datos destino </b></legend>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <span>País de destino <span class="sp-requerido">*</span></span>
                        <select name="id_pais_envio" id="id_pais_envio" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el país de destino">
                            <option value="" disabled="" selected="">Selecciona el país de desino</option>
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
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="ciudad_envio" name="ciudad_envio" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Lima" required="" maxlength="100" data-toggle="tooltip" title="Escriba la ciudad de destino" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!-- -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Ciudad de destino<span class="sp-requerido">*</span></label>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="direccion_envio" name="direccion_envio" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Av. Miguel Angel Nº 193A Urb. Fiori" required="" maxlength="100" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de destino" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Dirección de destino<span class="sp-requerido">*</span></label>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input name="fecha_envio" id="fecha_envio" type="date" class="material-control tooltips-general" title="Escriba/seleccione la fecha de envió" placeholder="Escoja una fecha de envió" data-toggle="tooltip" data-placement="top"  onchange="return validarFechaEnvio()" > <!--title="Escribe el código correlativo del libro, solamente números"-->
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Fecha de envio <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <!--<span>Viaja con el paquete <span class="sp-requerido">*</span></span>-->
                        <span>Viaja con el paquete<span class="sp-requerido">*</span></span>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <input type="radio" name="rdgllevo" id="rdgllevo_1"  value="1" checked="true"> SI
                        <input type="radio" name="rdgllevo" id="rdgllevo_2"  value="2" > NO

                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <span>Método de envío<span class="sp-requerido">*</span></span>
                        <select name="id_metodo_envio" id="id_metodo_envio" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el país de envió">
                            <option value="" disabled="" selected="">Selecciona el método de envió</option>
                            <?php
                            $modoEnvio = new clstramite4modoenvio();
                            $rsModoEnvio = $modoEnvio->modo_envio_seleccionarActivos();
                            while ($row = mysqli_fetch_array($rsModoEnvio)) {
                                ?>
                                <option value="<?php echo $row["me_id"]; ?>"><?php echo $row["me_nombre"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-file-text"></i> &nbsp;  <b>Objetos a certificar</b></legend>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead alert alert-info">
                        <h4><b>INFORMACIÓN</b></h4>
                        <b>Estimad@ ciudadano se le recuerda registrar cada uno de los objetos a certificar.</b> 
                    </div>
                </div>
            </div>
            <div id="mensaje" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div class="panel panel-default" id="formularioObjetos">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="cantidad" name="cantidad"  min="0" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escriba la cantidad" onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Cantidad<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <span>Tipo de bien cultural <span class="sp-requerido">*</span></span>
                                <select name="tipo_bien_cultural" id="tipo_bien_cultural" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural" onchange="javascript:seleccionarTipoBienCultural();">
                                    <option value="" disabled="" selected="">Selecciona el tipo de bien cultural</option>
                                    <?php
                                    $tipoBienCultural = new clstipobiencultural();
                                    $rsTipoBienCultural = $tipoBienCultural->tbc_seleccionaractivos();
                                    while ($row = mysqli_fetch_array($rsTipoBienCultural)) {
                                        ?>
                                        <option value="<?php echo $row["tbc_id"]; ?>"><?php echo $row["tbc_nombre"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4" >
                            <div class="group-material">
                                <input id="descripcion_bien_cultural" name="descripcion_bien_cultural" readonly="ReadOnly" type="text" class="tooltips-general material-control" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Descripción bien cultural <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="tema" name="tema" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Abstracto / Línea Nro. 10" title="Escriba la temática o título" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Temática/Título <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="autor" name="autor" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" title="Escriba el autor" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Autor <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="tecnica" name="tecnica" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Oleo" title="Escriba la tecnica" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Técnica <span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <div class="group-material">
                                    <input id="largo" name="largo" min="0" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" title="Escriba la altura" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Altura (cm)<span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="ancho" name="ancho" min="0" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" title="Escriba el ancho" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ancho (cm)<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="group-material">
                                <input id="profundidad" min="0" name="profundidad" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" title="Escriba la profundidad" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Profundidad (cm)<span class="sp-requerido">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <button type="button" value="Agregar"  id="agregar" class="btn btn-success"><i class="zmdi zmdi-plus-circle"></i> &nbsp; Agregar</button>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <legend><i class="zmdi zmdi-check-all"></i> &nbsp;  <b>Objetos a ser revisados</b></legend></legend>
                    </div>
                    <div class="col-xs-12" id="productos" >
                        <table class="table table-striped" id="lista">
                            <tr>
                                <td style="width: 5%"><b>Cantidad</b></td>
                                <td><b>Tipo de bien cultural</b></td> 
                                <td><b>Temática/Título</b></td>
                                <td><b>Autor</b></td>
                                <td><b>Técnica</b></td>
                                <td style="width: 5%"><b>Dimensiones</b></td>
                                <td style="width: 5%"><b>Acciones</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class = "col-xs-12">
                    <legend><i class = "zmdi zmdi-calendar-alt"></i> &nbsp; <b> Lugar, Fecha y Hora de Atención </b></legend>
                </div>
                <div class = "col-xs-12 col-sm-12 col-md-12">
                    <div class = "group-material">
                        <span>Lugar de la cita <span class = "sp-requerido">*</span></span>
                        <select name = "id_zonal" id = "id_zonal" class = "tooltips-general material-control" required = "" data-toggle = "tooltip" data-placement = "top" title = "Elija la zonal">
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
                        <input id="fecha_atencion" name="fecha_atencion" type="date" class="tooltips-general material-control"  title="Escriba/seleccione la fecha de atención" placeholder="Escoge la fecha de atención" data-toggle="tooltip" data-placement="top" onchange="return validarFechaAtención()">
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
                        <label for="checkbox1">Acepto el presente <a href="#" data-toggle="modal" data-target="#ModalAcuerdoConfidencialidad">Acuerdo de Confidencialidad y Responsabilidad</a></label> 
                    </div>
                </div>            
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-center">
                        <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                        <button type="button" id="guardar"  disabled="disabled" value="Guardar" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Enviar</button>
                        <!--<button type="button" value="Agregar"  id="agregar" class="btn btn-success"><i class="zmdi zmdi-plus-circle"></i> &nbsp; Agregar</button>-->
                    </p>
                </div>
            </div>
        </form>
    </div>
    <div class="form-group" id="process" style="display:none;">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
            </div>
        </div>
    </div>
</div>
<?php include_once("./modal/acuerdo_conf.php"); ?>
<?php include_once("./includes/footer.php"); ?>
<?php include_once("./modal/loading.php"); ?>

<script src="js/js_tramite4.js"></script>
<script>

</script>

