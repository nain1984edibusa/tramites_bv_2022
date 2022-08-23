<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
?>
<div class="container-fluid">
     <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Formulario de Información</div>
        
        <form enctype="multipart/form-data" method="post" class="form-padding" action="controller/registrar_tramite.php" autocomplete="off"">
            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"];?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial;?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo;?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">


            <?php while($requisito= mysqli_fetch_array($trequisitos)){ ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input name="<?php echo $requisito["req_slug"];?>" id="<?php echo $requisito["req_slug"];?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $requisito["req_nombre"];?> <span class="sp-requerido">*</span></label>
                        
                        
                    </div>
                    <input type="hidden" name="<?php echo $requisito["req_slug"]."_id";?>" value="<?php echo $requisito["req_id"];?>"/>
                </div>
            <?php } ?> 
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 checkbox">
                    <div class="group-material">
                        <input id="checkbox1" required="" type="checkbox" name="remember" kl_vkbd_parsed="true">
                        <label for="checkbox1">Acepto el presente <a href="#" data-toggle="modal" data-target="#ModalAcuerdoConfidencialidad">Acuerdo de Confidencialidad y Responsabilidad</a></label> 
                    </div>
                </div>            
            </div>
<!--            <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="group-material">
                        <input type="file" class="tooltips-general material-control" placeholder="Ingrese la extensión del predio en ha" pattern="[0-9]{1,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Suba una fotografía del predio que facilite su ubicación">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Foto del Predio (PDF)<span class="sp-requerido">*</span></label>
                    </div>
                </div>-->
            <div class="row">
               <div class="col-xs-12">
                    <p class="text-center">
                        <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> &nbsp;&nbsp; Enviar</button>
                        <!--<a href="ue_bandeja_enviados.php?proc=regtra&est=1" class="enlace_especial">Completado</a>-->
                    </p>
               </div>
            </div>
       </form>
    </div>
</div>
<?php include_once("./modal/acuerdo_conf.php"); ?>
<?php include_once("./includes/footer.php"); ?>
<script type="text/javascript">
$( document ).ready(function() {
    cargar_turnos();
});  
//FUNCION QUE OBTENGA LAS HORAS EN LA FECHA SELECCIONADA QUE ESTEN EN LA TABLA DE TURNOS DEL TRAMITE PERO NO EN LA DE TRAMITES TURNO USUARIO (TURNOS DISPONIBLES)
function cargar_turnos(){
    $.ajax({
        type: "POST",
        url: "./ajax/obtener_turnos_disponibles.php",
        data: 'fecha='+$("#fecha").val()+'&tramite='+<?php echo $_GET["idt"]?>,
        success: function(datos){
            //alert(datos);
            if(datos.length>0){
                $("#horario").html(datos);
                $("#horario").attr("disabled",false);
            }else{
                alert("No existen turnos disponibles en la fecha seleccionada");
            }
        }
    });
}
$("#fecha" ).on( "change", function( event ) {
    cargar_turnos();
});
</script>