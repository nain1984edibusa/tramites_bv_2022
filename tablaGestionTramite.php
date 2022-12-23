<?php
include_once("./config/variables.php");
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clsgestiontramite.php");

/* Listado de todos los trámites ordenados por el campo ct_orden */
$listado_tramites = new clsgestiontramite();
$tramites = $listado_tramites->gt_seleccionartodo();
?>

<?php if ($tramites->num_rows > 0): ?>
    <table class="table table-bordered table-hover">
        <thead>
        <th>Id</th>
        <th>Fecha de <br> Recepción <br> Trámite</th>
        <th>Fecha de <br> Respuesta</th>
        <th>Estado Tramite</th>
        <th>Zonal</th>
        <th>Dirección / Unidad</th>
        <th>Tramite</th>
        <th>Tecnico <br> Responsable</th>
        <th>Tipo de <br> identificación <br> del Usuario</th>
        <th>Identificación <br> del Usuario</th>
        <th>Nombre Completo <br> del Usuario</th>
        <th>email</th>
        <th>Celular</th>
        <th>Acciones</th>
    </thead>
    <?php while ($r = $tramites->fetch_array()): ?>
        <tr>
            <td><?php echo $r["gt_id"]; ?></td>
            <td><?php echo $r["gt_fecha_recepcion"]; ?></td>
            <td><?php echo $r["gt_fecha_respuesta"]; ?></td>
            <td><?php echo $r["egt_nombre"]; ?></td>
            <td><?php echo $r["reg_nombre"] . $r["reg_ciudad"]; ?></td>
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
                <a href="#" id="del-<?php echo $r["gt_id"]; ?>" class="edit btn btn-default"title='Finalizar tramite'><i class="zmdi zmdi-edit"></i></a>
                <script>
                    $("#del-" +<?php echo $r["gt_id"]; ?>).click(function (e) {
                        e.preventDefault();
                        p = confirm("Estas seguro de finalizar el tramite?");
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
<?php else: ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
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