<div class="col-xs-12 col-sm-12 col-md-12">
    <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
    <input type="hidden" id="tra_id" name="tra_id" value="<?php echo $tra_id; ?>" />
    <input type="hidden" id="tra_codigo" name="tra_codigo" value="<?php echo $tra_codigo; ?>" />
    <div id="tablaObjetos"></div>

    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">
                <button type="button" id="btnCertificado"  value="certificado" class="btn btn-primary" onclick="generarCertificado();"><i class="zmdi zmdi-file-text"></i> &nbsp;&nbsp; Emitir Certificado</button>
                <button type="button" id="btnInforme"   value="informe" class="btn btn-primary" onclick="generarInforme();"> <i class="zmdi zmdi-file-text"></i> &nbsp;&nbsp; Emitir Informe</button>
            </p>
        </div>
    </div>
    <span id="resultado"></span>
</div>

<?php include_once("./modal/loading.php"); ?>
<script>
    cargarTablaObjetos();

    function generarCertificado() {
        var generar = "";
        var loading = $('#processing-modal');
        var id_tu_r = document.querySelector('#tu_id').value; //id del trámite usuario
        var id_tra = document.querySelector('#tra_id').value; //id del trámite
        var cod_tra = document.querySelector('#tra_codigo').value; //código del trámite
        var generar = document.querySelector('#btnCertificado').value; //código del trámite



        $.ajax({
            type: "POST",
            url: 'controller/reasignar_tramite.php',
            cache: false,
            data: {id_tu_r: id_tu_r, id_tra: id_tra, cod_tra: cod_tra, generar: generar},
            beforeSend: function () {
//                $("#resultado").html("Procesando, espere por favor...");
                loading.modal('show');
            },
            success: function (response) {
                $("#resultado").html(response);
                loading.modal('hide');

            }
        });
    }

    function generarInforme() {
        var generar = "";
        var loading = $('#processing-modal');
        var id_tu_r = document.querySelector('#tu_id').value; //id del trámite usuario
        var id_tra = document.querySelector('#tra_id').value; //id del trámite
        var cod_tra = document.querySelector('#tra_codigo').value; //código del trámite
        var generar = document.querySelector('#btnInforme').value; //código del trámite
        $.ajax({
            type: "POST",
            url: 'controller/reasignar_tramite.php',
            cache: false,
            data: {id_tu_r: id_tu_r, id_tra: id_tra, cod_tra: cod_tra, generar: generar},
            beforeSend: function () {
//                $("#resultado").html("Procesando, espere por favor...");
                loading.modal('show');
            },
            success: function (response) {
                $("#resultado").html(response);
                loading.modal('hide');
            }
        });
    }

    function cargarTablaObjetos() {
        var tramite_especifico = document.querySelector('#tu_id').value;
        $.ajax({
            type: "POST",
            url: "_form_res/rf_4_tabla_objetos.php",
            cache: false,
            data: {tramite_especifico: tramite_especifico},
            success: function (data) {
                $("#tablaObjetos").html(data);
            }
        });
    }
</script>


