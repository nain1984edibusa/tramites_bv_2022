<?php
session_start();
include_once("./config/variables.php");
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clsgestiontramite.php");

/* Listado de todos los trámites ordenados por el campo ct_orden */
$usu_int_id = $_SESSION["codusuario"]; //código usuario
$perfil_id = $_SESSION["codperfil"];

if ($perfil_id != SECRETARIA) {
    $listado_tramites = new clsgestiontramite();
    $listado_tramites->setUsu_int_id($usu_int_id);
    $tramites = $listado_tramites->gt_seleccionar_por_usuario();
} else {
    $listado_tramites = new clsgestiontramite();
    $tramites = $listado_tramites->gt_seleccionartodo();
}
?>

<table id="example" class="table table-hover">
    <thead>
        <?php if ($_SESSION["codperfil"] != SECRETARIA) { ?>
            <tr class="info">
                <td colspan="3" class="nuevo">Nuevo registro <a data-toggle="modal" href="#newModal"><img src="img/plus1.png" alt="Nuevo" width="20" height="20" /></a></td>
            </tr>
        <?php } ?> 
        <tr class="info">
            <td>Id</td>
            <td style="width:50%">Nro de  Quipux <br> de Ingreso </td>
            <td>Fecha de <br> Recepción </td>
            <td>Fecha de <br> Respuesta</td>
            <td>Estado Tramite</td>
            <td>Zonal</td>
            <td>Dirección / Unidad</td>
            <td style="width:80%"><b>Tramite</b></td>
            <td>Técnico <br> Responsable</td>
            <td>Tipo de <br> Iden. <br> del Usuario</td>
            <td>Identificación <br> del Usuario</td>
            <td>Nombre Completo <br> del Usuario</td>
            <td>E-mail</td>
            <td>Nro. Celular</td>
            <td style="width: 10%"><b>Acciones</b></td>
        </tr>
    </thead>
    <?php while ($r = $tramites->fetch_array()): ?>
        <tr>
            <td><?php echo $r["gt_id"]; ?></td>
            <td><?php echo $r["gt_numero_quipux"]; ?></td>
            <td><?php echo $r["gt_fecha_recepcion"]; ?></td>
            <td><?php echo $r["gt_fecha_respuesta"]; ?></td>
            <td><?php echo $r["egt_nombre"]; ?></td>
            <td><?php echo $r["reg_nombre"] . " - " . $r["reg_ciudad"]; ?></td>
            <td><?php echo $r["agt_nombre"]; ?></td>
            <td><?php echo $r["tra_nombre"]; ?></td>
            <td><?php echo $r["gt_tecnico_responsable"]; ?></td>
            <td><?php echo $r["ti_nombre"]; ?></td>
            <td><?php echo $r["gt_identificacion"]; ?></td>
            <td><?php echo $r["gt_nombre"]; ?></td>
            <td><?php echo $r["gt_email"]; ?></td>
            <td><?php echo $r["gt_numero_celular"]; ?></td>
            <td style="width:50px;">
                <!--<a data-id="<?php echo $row["gt_id"]; ?>" class='btn-edit btn btn-default' title='Finalizar tramite'><i class="zmdi zmdi-edit"></i></a>-->
                <a href="#" id="del-<?php echo $r["gt_id"]; ?>" class="edit btn btn-default"title='Finalizar tramite'><i class="zmdi zmdi-flash"></i></a>
                <script>
                    $("#del-" +<?php echo $r["gt_id"]; ?>).click(function (e) {
                        debugger;
                        e.preventDefault();
                        p = confirm("Estás seguro de finalizar el tramite?");
                        if (p) {
                            $.get("controller/actualizar_estado_gestion_tramite.php", "gt_id=" +<?php echo $r["gt_id"]; ?>, function (data) {
                                loadTabla();
                            });
                        }

                    });
                </script>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<!-- Modal -->
<script>
    $(".btn-edit").click(function () {
        id = $(this).data("id");
        $.get("./php/formulario.php", "id=" + id, function (data) {
            $("#form-edit").html(data);
        });
        $('#editModal').modal('show');
    });
</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar</h4>
            </div>
            <div class="modal-body">
                <div id="form-edit"></div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->