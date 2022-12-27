<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
session_start();

//$modulo = "Administrador";
$opcion = "Gestón de Trámites";
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

$usuario = $_SESSION["codusuario"]; //código usuario
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Hoja de estilos Toastr--> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head> 

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Bienvenido a esta sección, de gestión de tramites.
        </div>
    </div>
</div>
<div class="container-fluid" >
    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">Registro Gestión de Trámites</h4>
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
                                    <input id="usu_nombres" name="usu_nombres" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Carlos Manuel"  required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Nombres Completo<span class="sp-requerido">*</span></label>
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
                        <input type="hidden" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
                        <!--<button type="submit" class="btn btn-default">Agregar</button>-->
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-xs-6 text-center">
                                    <button type="submit" class="btn btn-secondary" data-dismiss="modal"><i class="zmdi zmdi-close"></i> &nbsp; Cancelar</button>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Guardar</button>
                                </div>
                            </div>
                        </div>
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
            $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Mostrar Todo"]],
                "language": idioma
            });
            
            loading.modal('hide');
        })
    }

    let idioma = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
    };

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
        var usuario = document.querySelector('#usuario').value;
        datos_tramite.push(
                {"id_zonal": id_zonal,
                    "id_area": id_area,
                    "id_tramite": id_tramite,
                    "tecnico": tecnico,
                    "tipo_identificacion": tipo_identificacion,
                    "identificacion": identificacion,
                    "nombres": nombres,
                    "email": email,
                    "usuario": usuario,
                    "celular": celular}
        );
        return true;
    }
</script>
