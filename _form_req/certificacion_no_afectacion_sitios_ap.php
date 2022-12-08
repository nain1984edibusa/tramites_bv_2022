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
            </div>
            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <!--<span>Viaja con el paquete <span class="sp-requerido">*</span></span>-->
                        <span>¿El solicitante es propietario del predio?<span class="sp-requerido">*</span></span>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <input type="radio" name="rdgPropietario" id="rdgpropietario_1"  value="1" checked="true"> SI
                        <input type="radio" name="rdgPropietario" id="rdgpropietario_2"  value="0" > NO

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Objeto de la solicitud <span class="sp-requerido">*</span></span>
                        <textarea id="objeto_solicitud" name="objeto_solicitud"  value="PRUEBA SOLICITUD" class="tooltips-general material-control" placeholder="Escriba la razón de su solicitud" required="" data-toggle="tooltip" data-placement="top" title="Escribe la razón de tu solicitud" onKeyUp="this.value = this.value.toUpperCase();"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; <b> Información del Predio </b></legend>
                </div>
            </div>
            <div class="row">  
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="provincia" value="PICHINCHA" name="provincia" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Pichincha" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione la provincia de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Provincia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_provincia" value="17" id="id_provincia"/>
                        <input type="hidden" name="id_regional" value="2"  id="id_regional" value="<?php echo $_SESSION["regional"]; ?>"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="canton" value= "QUITO" name="canton" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Quito" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione el cantón de ubicación del bien" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Cantón <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_canton" value="1701" id="id_canton"/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="parroquia" name="parroquia" value="BELISARIO QUEVEDO" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Belisario Quevedo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escriba/seleccione su parroquia de residencia" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Parroquia <span class="sp-requerido">*</span></label>
                        <input type="hidden" name="id_parroquia" value="170101"  id="id_parroquia"/>
                    </div>
                </div>                             
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="sector" name="sector" type="text"  value="SECTOR" class="tooltips-general material-control" placeholder="Escriba el sector de ubicación" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el sector" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Sector <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="via_principal" name="via_principal" type="text"  value="VIA PRINCIPAL" class="tooltips-general material-control" placeholder="Escriba la calle o vía principal del predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe la vía principal" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Vía Principal <span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="via_secundaria" name="via_secundaria" type="text"  value="VIA SECUNDARIA" class="tooltips-general material-control" placeholder="Escriba la calle o vía secundaria del predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe la vía secundaria" onKeyUp="this.value = this.value.toUpperCase();">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Vía Secundaria <span class="sp-requerido">*</span></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="extension" name="extension" value="1"type="number" class="tooltips-general material-control" placeholder="Ingrese la extensión del predio en ha" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el valor de la hectárea">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Extensión(Máximo 1 hectárea)<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="numero_predio" name="numero_predio" value="3090" type="text" class="tooltips-general material-control" placeholder="Escriba el número de predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el número de predio">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Número de Predio<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="group-material">
                        <input id="numero_catastro" name="numero_catastro" value="9030" type="text" class="tooltips-general material-control" placeholder="Escriba el número de catastro" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Escribe el número de catastro">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Número Catastro<span class="sp-requerido">*</span></label>
                    </div>
                </div> 
            </div>
<!--            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <span>Ubicación del Predio en Google Maps<span class="sp-requerido">*</span></span>
                        <p class="texto_small"><strong>Latitud:</strong> Desconocida <strong>Longitud:</strong> Desconocida</p>
                        <div class="mapa_ubicacion_gm">
                        </div>
                    </div>
                </div>
            </div>-->
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <legend><i class="zmdi zmdi-calendar-alt"></i> &nbsp;  <b> Archivos/Requisitos </b></legend>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" placeholder="Ingrese la extensión del predio en ha" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Suba una fotografía del predio que facilite su ubicación">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Foto del Predio (PDF)<span class="sp-requerido">*</span></label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" placeholder="Escriba el número de predio" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Suba el documento de uso de Suelo, Línea de Fábrica o IRM">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Uso de Suelo, Línea de Fábrica o IRM (PDF)<span class="sp-requerido">*</span></label>
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
                        <button type="button" id="guardar"  value="Guardar" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Enviar</button>
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

<script src="js/js_tramite7.js"></script>
<script>

</script>

