<div class="col-xs-12 col-sm-12 col-md-12">
    <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
    <input type="hidden" id="tra_id" name="tra_id" value="<?php echo $tra_id; ?>" />
    <input type="hidden" id="tra_codigo" name="tra_codigo" value="<?php echo $tra_codigo; ?>" />
    <div id="tablaObjetos"></div>

    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">
                <button type="button" id="certificado"   value="certificado" class="btn btn-primary" onclick="generarCertificado();"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Emitir Certificado</button>
                <button type="button" id="informe"   value="informe" class="btn btn-primary" onclick="generarInforme();"> <i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Emitir Informe</button>
            </p>
        </div>
    </div>
    Resultado: <span id="resultado">0</span>
</div>
<script>
    cargarTablaObjetos();

    function generarCertificado() {
        var generar = "";
        var id_tu_r = document.querySelector('#tu_id').value; //id del trámite usuario
        var id_tra = document.querySelector('#tra_id').value; //id del trámite
        var cod_tra = document.querySelector('#tra_codigo').value; //código del trámite
        var cert = document.querySelector('#certificado').value; //código del trámite
        var inf = document.querySelector('#informe').value; //código del trámite
        if (cert != "") {
            generar = cert;
        } else if (inf != "") {
            generar = inf;
        }
        $.ajax({
            type: "POST",
            url: 'controller/reasignar_tramite.php',
            cache: false,
            data: {id_tu_r: id_tu_r, id_tra: id_tra, cod_tra: cod_tra, generar: generar},
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                debugger
                $("#resultado").html(response);
            }
        });
    }

function generarInforme() {
        var generar = "";
        var id_tu_r = document.querySelector('#tu_id').value; //id del trámite usuario
        var id_tra = document.querySelector('#tra_id').value; //id del trámite
        var cod_tra = document.querySelector('#tra_codigo').value; //código del trámite
        var generar = document.querySelector('#informe').value; //código del trámite
        $.ajax({
            type: "POST",
            url: 'controller/reasignar_tramite.php',
            cache: false,
            data: {id_tu_r: id_tu_r, id_tra: id_tra, cod_tra: cod_tra, generar: generar},
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado").html(response);
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




