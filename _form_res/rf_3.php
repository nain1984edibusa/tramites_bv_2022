<div class="col-xs-12 col-sm-12 col-md-12">
    <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
    <div id="tablaObjetos"></div>
</div>
<script>
    cargarTablaObjetos();
    
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




