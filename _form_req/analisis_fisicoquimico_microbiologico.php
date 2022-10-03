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
            <input type="hidden" name="idt" id="idt" value="<?php echo $_GET["idt"]; ?>">
            <input type="hidden" name="estadot" id="estadot" value="<?php echo $estado_inicial; ?>">
            <input type="hidden" name="duraciont" id="duraciont" value="<?php echo $tramite_tiempo; ?>">
            <input type="hidden" name="iniciat" id="iniciat" value="<?php echo $inicia_tramite; ?>">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="group-material">
                    <input id="caracteristicasBien" name="caracteristicasBien" type="text" class="material-control tooltips-general" placeholder="Por ejemplo: Escultura, Pintura" required="" maxlength="100" data-toggle="tooltip" data-placement="top" title="Escriba la dirección" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba la dirección de su domicilio" -->
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Tipo de bien <span class="sp-requerido">*</span></label>
                </div>
            </div> 
            <div class="col-xs-12">
                <legend><i class="zmdi zmdi-gps-dot"></i> &nbsp; Pedido de Análisis Químico</legend>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="card-body">
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="1" > Identificación de fibras textiles (papel) y tejidos</label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="2" > Análisis petrográfico (tipo madera)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="3" > Análisis químico-mineralógico</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="4" > Pruebas de solubilidad </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="5" > Análisis suelos completo</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="6" > Análisis microbiológico</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>

                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="7" > Pérdida por calcinación </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="8" > Observación al microscopio</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="9" > Microfoto-rafia</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="10" > Fotografía digital </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="11" > Análisis estratigráfico (por muestra o por objeto)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="12" > Análisis de aglutinantes</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="13" > Análisis por disfracción de rayos X </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="14" > Identificación de sales (cualitativo)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="15" > Análisis de morteros (granulometría y composición)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="16" > Determinación de humedad </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="17" > Identificación de maderas</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="18" > Análisis por espectrofotometría infrarroja</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="19" > Análisis por absorción atómica </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="20" > Medición de PH</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="21" > Confección de bandas de extensión por metro lineal</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="22" > Reintegración de color regatino por decimetro cuadrado </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="23" > Conservación directa por metro cuadrado</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="24" > Restauración por metro cuadrado</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="25" > Diseño y confección de bastidores técnicos por metro lineal </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="26" > Fumigación e higienización por metro cuadrado</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="27" > Análisis por cromatografí de gases</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                    <div class="row">
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="28" > Identificación de pigmentos </label>
                            </div>
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="29" > Análisis de textiles (tejidos)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                        <!-- checkbox -->
                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <label><input type="checkbox" name="opciones_analisis[]" value="30" > Determinación de propiedades hídricas en piedra c/u (Absorción, desorción de agua, succión capilar)</label>
                            </div>      
                        </div>
                        <!-- End: checkbox -->
                    </div>
                </div>
            </div>  
            <br>
            <?php while ($requisito = mysqli_fetch_array($trequisitos)) { ?>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="group-material">
                        <input name="<?php echo $requisito["req_slug"]; ?>" id="<?php echo $requisito["req_slug"]; ?>" type="file" class="tooltips-general material-control" data-toggle="tooltip" data-placement="top" required='' accept="application/pdf"> 
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label><?php echo $requisito["req_nombre"]; ?> <span class="sp-requerido">*</span></label>


                    </div>
                    <input type="hidden" name="<?php echo $requisito["req_slug"] . "_id"; ?>" value="<?php echo $requisito["req_id"]; ?>"/>
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
    $(document).ready(function () {
        cargar_turnos();
    });
//FUNCION QUE OBTENGA LAS HORAS EN LA FECHA SELECCIONADA QUE ESTEN EN LA TABLA DE TURNOS DEL TRAMITE PERO NO EN LA DE TRAMITES TURNO USUARIO (TURNOS DISPONIBLES)
    function cargar_turnos() {
        $.ajax({
            type: "POST",
            url: "./ajax/obtener_turnos_disponibles.php",
            data: 'fecha=' + $("#fecha").val() + '&tramite=' +<?php echo $_GET["idt"] ?>,
            success: function (datos) {
                //alert(datos);
                if (datos.length > 0) {
                    $("#horario").html(datos);
                    $("#horario").attr("disabled", false);
                } else {
                    alert("No existen turnos disponibles en la fecha seleccionada");
                }
            }
        });
    }
    $("#fecha").on("change", function (event) {
        cargar_turnos();
    });
</script>