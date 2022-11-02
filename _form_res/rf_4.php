<div class="col-xs-12 col-sm-12 col-md-12">
    <input type="hidden" id="tu_id" name="tu_id" value="<?php echo $tu_id; ?>" />
    <div id="tabla"></div>
</div>
<script>
    cargarTabla();
//    location.reload();
    function cargarTabla() {
        var tramite_especifico = document.querySelector('#tu_id').value;
        $.ajax({
            type: "POST",
            url: "_form_res/rf_4_tabla_objetos.php",
            cache: false,
            data: {tramite_especifico: tramite_especifico},
            success: function (data) {
                debugger;
                $("#tabla").html(data);
            }
        });
    }
</script>




