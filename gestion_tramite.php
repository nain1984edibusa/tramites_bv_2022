<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo = "Administrador";
$opcion = "Ayuda del Sistema de Trámites";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
/* incluir modelo(s) */
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstipoidentificacion.php");
include_once("./modelo/clsregional.php");
include_once("./modelo/clsareagestiontramite.php");
include_once("./modelo/clstramites.php");
//
/* Listado tipo de identificacion */
$listado_tipo_identificacion = new clstipoidentificacion();
$rsTipoIdentificacion = $listado_tipo_identificacion->tipo_identificacion_seleccionartodo();

///* Listado de todos los trámites */
$listado_regionales = new clsregional();
$regionales = $listado_regionales->regionalSeleccionarActivos();

/* Listado estados gestion tramite */
$listado_area = new clsareagestiontramite();
$areas = $listado_area->agt_cargar_areas();

/* Listado de todos los trámites */
$listado_catalogo_tramites = new cl_tramites();
$catalogo_tramite = $listado_catalogo_tramites->tra_seleccionartodo();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, de gestión de tramites.
        </div>
    </div>
</div>
<!--<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UI; ?>">Inicio</a></li>
                <li class="active"><?php echo $modulo ?></li>
                <li class="active"><?php echo $opcion ?></li>
            </ol>
        </div>
    </div>
</div>-->

<div class="container-fluid" >
    <!--<iframe width="853" height="480" src="https://www.youtube.com/embed/8XeSGc_s8Mc" title="Certificación de bienes culturales No patrimoniales para su salida el exterior" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
    <form class="form-inline" role="search" id="buscar">
        <!--        <div class="form-group">
                    <input type="text" name="s" class="form-control" placeholder="Buscar">
                </div>-->
                <!--<button type="submit" class="btn btn-default">&nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;</button>-->
        <a data-toggle="modal" href="#newModal" class="btn btn-default">Agregar</a>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar Item</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" id="agregar">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class = "group-material">
                                    <span>Zonal <span class = "sp-requerido">*</span></span>
                                    <select name = "id_zonal" id = "id_zonal" class = "tooltips-general material-control" required = "" data-toggle = "tooltip" data-placement = "top" title = "Elija la zonal">
                                        <option value = "" disabled = "" selected = "">Selecciona la regional</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($regionales)) {
                                            ?>
                                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] . " - " . $row[2] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class = "group-material">
                                    <span>Dirección/Unidad <span class = "sp-requerido">*</span></span>
                                    <select name = "id_area" id = "id_area" class = "tooltips-general material-control" required = "" data-toggle = "tooltip" data-placement = "top" title = "Elija la Dirección/Unidad">
                                        <option value = "" disabled = "" selected = "">Selecciona la Dirección/Unidad</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($areas)) {
                                            ?>
                                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                            <!--<option value="<?php echo $row["nac_codigo"]; ?>"><?php echo $row["nac_nombre"]; ?></option>-->
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class = "group-material">
                                    <span>Catálogo de Trámites <span class = "sp-requerido">*</span></span>
                                    <select name = "id_tramite" id = "id_tramite" class = "tooltips-general material-control" required = "" data-toggle = "tooltip" data-placement = "top" title = "Elija el tramite">
                                        <option value = "" disabled = "" selected = "">Selecciona el trámite</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($catalogo_tramite)) {
                                            ?>
                                            <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
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
                                    <input id="tecnico" name="tecnico" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> 
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Técnico Encargado<span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; <b> Información Usuario Solicitante </b></legend>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="group-material">
                                    <span>Tipo de identificación <span class="sp-requerido">*</span></span>
                                    <select name="usu_id_tipo_identificacion" id="usu_id_tipo_identificacion" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el tipo de identificación">
                                        <option value="" disabled="" selected="">Selecciona el tipo identificación</option>
                                        <?php
                                        while ($row = mysqli_fetch_array($rsTipoIdentificacion)) {
                                            ?>
                                            <option value="<?php echo $row["ti_id"]; ?>"><?php echo $row["ti_nombre"]; ?></option>
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
                                    <input id="usu_identificacion" name="usu_identificacion" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: 0603487656" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Identificación <span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="group-material">
                                    <input id="usu_nombres" name="usu_nombres" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel"  maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Nombres Completo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="group-material">
                                    <input id="usu_email" name="usu_email" type="text" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Correo Electrónico <span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <div class="group-material">
                                    <input id="usu_celular" name="usu_celular" type="text" class="material-control tooltips-general" required="" placeholder="Por ejemplo: abc@gmail.com"  data-toggle="tooltip" data-placement="top" title="Escriba un correo personal al cual recibir el email de activación de su cuenta">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Celular <span class="sp-requerido">*</span></label>
                                </div>
                            </div>
                        </div>

                        <!--                        <div class="form-group">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">Apellido</label>
                                                    <input type="text" class="form-control" name="lastname" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Domicilio</label>
                                                    <input type="text" class="form-control" name="address" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Telefono</label>
                                                    <input type="text" class="form-control" name="phone" >
                                                </div>-->

                        <button type="submit" class="btn btn-default">Agregar</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="tabla">
    </div>
</div>
</div>
</div>
</div>
<?php include_once("./includes/footer.php"); ?>

<?php include_once("./modal/loading.php"); ?>
<script>

    var datos_tramite = [];
    loadTabla();
    function loadTabla() {
        var loading = $('#processing-modal');
        $('#editModal').modal('hide');
        loading.modal('show');
        $.get("./tablaGestionTramite.php", "", function (data) {
            $("#tabla").html(data);
            loading.modal('hide');

        })
    }

    $("#agregar").submit(function (e) {
        e.preventDefault();
        var loading = $('#processing-modal');
        isBool = validarCampos();
        if (isBool === true) {
            var json_datos_tramite = JSON.stringify(datos_tramite);

            $.ajax({
                type: "POST",
                url: "controller/registrar_gestion_tramite.php",
                data: {"json_datos_tramite": json_datos_tramite},
                beforeSend: function ()
                {
                    loading.modal('show');
                },
                success: function (result) {
                    loading.modal('hide');
                    $("#agregar")[0].reset();
                    $('#newModal').modal('hide');
                    loadTabla();
                }
            });
        }
    });

    function validarCampos() {
        let date = new Date();
        var fecha_sistema = (date.toISOString().split('T')[0]);
        var hora_sistema = date.getHours() + ':' + date.getMinutes();
        var id_zonal = document.querySelector('#id_zonal').value;
        var id_area = document.querySelector('#id_area').value;
        var id_tramite = document.querySelector('#id_tramite').value;
        var tecnico = document.querySelector('#tecnico').value;
        var tipo_identificacion = document.querySelector('#usu_id_tipo_identificacion').value;
        var identificacion = document.querySelector('#usu_identificacion').value;
        var nombres = document.querySelector('#usu_nombres').value;
        var email = document.querySelector('#usu_email').value;
        var celular = document.querySelector('#usu_celular').value;
        datos_tramite.push(
                {"id_zonal": id_zonal,
                    "id_area": id_area,
                    "id_tramite": id_tramite,
                    "tecnico": tecnico,
                    "tipo_identificacion": tipo_identificacion,
                    "identificacion": identificacion,
                    "nombres": nombres,
                    "email": email,
                    "celular": celular}
        );
        return true;
    }
</script>
