<?php
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteusuario.php");
include_once ("../modelo/clstramite17DetalleProforma.php");

/* detalle proforma */
$subTotal = 0;
$iva = 0;
$total = 0;
if (isset($_POST["tramite_especifico"])) {
    $tramite_especifico = $_POST["tramite_especifico"];

    $detalleProforma = new clstramite17DetalleProforma();
    $detalleProforma->setTu_id($tramite_especifico);
    $detalleProforma = $detalleProforma->detalleProformaPorTramite();
}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="row">
        <div class="group-material">
            <table class="table table-bordered">
                <thead class="btn-primary">
                    <tr>
                        <td>Ensayo/Parámetro</td>
                        <td>Nro. Items <br> de ensayo</td>
                        <td>Precio por <br> ítem de ensayo US$</td> 
                        <td>Total a pagar</td>
                        <td style="width: 5%">Acciones</td>
                    </tr>
                </thead>
                <tbody style="background-color:#fff;">
                    <?php
                    $detalles = $detalleProforma;

                    while ($row = mysqli_fetch_array($detalles)) {
                        ?>
                        <tr>
                            <td><?php echo $row[3] ?></td>
                            <td><?php echo $row[2] ?></td>
                            <td><?php echo $row[4] ?></td>
                            <td><?php echo $row[5] ?></td>
                            <td style="width:150px;">
                                <!--<a data-id="<?php echo $r["id"]; ?>" class="btn btn-edit btn-sm btn-warning">Editar</a>-->
                                <a href="#" id="del-<?php echo $r["id"]; ?>" class='btn btn-default' title='Eliminar Detalle'><i class="zmdi zmdi-delete"></i></a>
                                <!--<a href="ui_visualizacion_tramite.php?idtu=<?php echo $row["tu_id"] ?>" class='btn btn-default' title='Ver Detalle'><i class="zmdi zmdi-file-text"></i></a>-->
                                <script>
                                    $("#del-" +<?php echo $r["id"]; ?>).click(function (e) {
                                        e.preventDefault();
                                        p = confirm("Estas seguro?");
                                        if (p) {
                                            $.get("./php/eliminar.php", "id=" +<?php echo $r["id"]; ?>, function (data) {
                                                loadTabla();
                                            });
                                        }
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <?php
                            $subTotal += $row[5];
                            $iva = ($subTotal * 12) / 100;
                            $total = $subTotal + $iva;
                            ?>
                        </tr>
                    <?php } //fin while
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="group-material">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3 text-right">
                <label text-align:left >SubTotal:</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="subtotal" placeholder="0.00" readonly="ReadOnly" class="form-control" value= "<?php echo $subTotal ?>" >
            </div> 
        </div> 
    </div>
    <br/>
    <div class="row">
        <div class="group-material">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3 text-right">
                <label text-align:left >12 % IVA:</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="iva" placeholder="0.00" readonly="ReadOnly" class="form-control" value= "<?php echo $iva ?>" >
            </div> 
        </div> 
    </div>
    <br/>
    <div class="row">
        <div class="group-material">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3 text-right">
                <label text-align:left >Total:</label>
            </div>
            <div class="col-md-3">
                <input type="number" id="total" placeholder="0.00" readonly="ReadOnly" class="form-control" value= "<?php echo $total ?>" >
            </div> 
        </div> 
    </div>
    <br/>
</div>

