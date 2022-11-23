<?php
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramite4objeto.php");

if (isset($_POST["tramite_especifico"])) {
    $tramite_especifico = $_POST["tramite_especifico"];
    //Obtener el objetos
    $objeto = new clstramite4objeto();
    $objeto->setTu_id($tramite_especifico);
    $oespecifico = $objeto->obj_seleccionar_objeto_por_tramite();
        }
?>
<script>

</script>
<div class="col-xs-12">
    <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead alert alert-success">
        <h4><b>INFORMACIÓN</b></h4>
        <b>Estimad@s técnicos se le recuerda que antes de emitir el certificado debe validar todos los objetos en estado PENDIENTE</b> 
    </div>
</div>
<div class="col-xs-12">
    <legend><i class="zmdi zmdi-check-all"></i> &nbsp; <b>Certificar Solicitud </b></legend>
</div>
<div class="col-xs-12">
    <table class="table table-striped">
        <tr>
            <!--<td><b>Id</b></td> --> 
            <td style="width: 10%"><b>Condición <br> del objeto</b></td>
            <td style="width: 10%"><b>Contenedor</b></td> 
            <td style="width: 5%"><b>Cantidad</b></td>
            <td style="width: 10%"><b>Tipo de <br> bien cultural</b></td> 
            <td style="width: 10%"><b>Temática/Título</b></td>
            <td style="width: 10%"><b>Autor</b></td>
            <td style="width: 10%"><b>Técnica</b></td>
            <td style="width: 5%"><b>Dimensiones</b></td>
            <td style="width: 10%"><b>Acciones</b></td>
        </tr>
        <tbody style="background-color:#fff;">
            <?php
            while ($row = mysqli_fetch_array($oespecifico)) {
                ?>
                <tr>
                    <!--<td><?php echo $row[0] ?></td>-->
                    <td><?php echo $row[16] ?></td>
                    <td><?php echo $row[25] ?> <?php echo " - " ?><?php echo $row[22] ?><?php echo " - " ?><?php echo $row[23] ?></td>
                    <td><?php echo $row[5] ?></td>
                    <td><?php echo $row[13] ?></td>
                    <td><?php echo $row[6] ?></td>
                    <td><?php echo $row[7] ?></td>
                    <td><?php echo $row[8] ?></td>
                    <td><?php echo $row[9] ?><?php echo " * " ?><?php echo $row[10] ?><?php echo " * " ?><?php echo $row[11] ?></td>
                    <td style="width:150px;">
                        <a data-id="<?php echo $row["obj_id"]; ?>" class='btn-edit btn btn-default' title='Editar objeto'><i class="zmdi zmdi-edit"></i></a>
                                               <!--<a data-id="<?php echo $row["id"]; ?>" class="btn btn-edit btn-sm btn-warning">Editar1</a>-->
                    </td>
                </tr>
            <?php } //fin while
            ?>
        </tbody>
    </table>
</div>

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
        </div>  
    </div>
</div>
<script>
    $(".btn-edit").click(function () {
        id = $(this).data("id");
        $.get("./modal/actualizar_objeto.php", "id=" + id, function (data) {
            $("#form-edit").html(data);
        });
        $('#editModal').modal('show');
    });
</script>







