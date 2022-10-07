<div class="container-fluid">
    <!--    <div class="table-responsive">
            <h6>Informacion Pago</h6>
        </div>-->
    <div class="row">
        <div class="col-xs-12">
            <legend><i class="zmdi zmdi-file-text"></i> &nbsp;  <b>Objetos a certificar</b></legend></legend>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr class="success">
            <button type="button" id="registrarse" class="btn btn-info" data-toggle="modal" data-target="#ModalRegistroObjeto"> Nuevo &nbsp;&nbsp; <i class="zmdi zmdi-plus-circle"></i></button>       
            </tr>
            <tr class="info">
                <td style="width: 8%"><b>Cantidad</b></td>
                <td><b>Tipo de Bien Cultural</b></td>
                <td><b>Tema</b></td> 
                <td><b>Autor</b></td>
                <td><b>Técnica</b></td> 
                <td><b>Dimensiones</b></td> 
                <td style="width: 5%"><b>Acciones</b></td>
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
                <?php } //fin while
                ?>
            </tbody>
        </table>
    </div>
    <br>
</div>
<div>
    <?php
    include_once('./modal/registro_objeto_no_patrimonial.php');
    ?>
</div>
