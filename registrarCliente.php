<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2022
 */
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");
include_once("./modelo/clsTipoBienCultural.php");
?>
<form name="form-data" action="recibCliente.php" method="POST">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="cantidad" name="cantidad" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();"><!--title="Escriba su número de identificación"-->
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Cantidad<span class="sp-requerido">*</span></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <span>País de bien cultural <span class="sp-requerido">*</span></span>
                <select name="nacionalidad" id="nacionalidad" class="tooltips-general material-control" required="" data-toggle="tooltip" data-placement="top" title="Elija el bien cultural">
                    <option value="" disabled="" selected="">Selecciona el tipo de bien cultural</option>
                    <?php
                    $tipoBienCultural = new clsTipoBienCultural();
                    $rsTipoBienCultural = $tipoBienCultural->tipoBienCulturalSeleccionarActivos();
                    while ($row = mysqli_fetch_array($rsTipoBienCultural)) {
                        ?>
                        <option value="<?php echo $row["tbc_codigo"]; ?>"><?php echo $row["tbc_nombre"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="tema" name="tema" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Abstracto" required="" maxlength="70" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus nombres completos"--> 
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Tema <span class="sp-requerido">*</span></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="apellidos" name="apellidos" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Silva Cuadrado" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();"> <!--title="Escriba sus apellidos completos"--> 
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Autor <span class="sp-requerido">*</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="tecnica" name="tecnica" type="text" class="tooltips-general material-control" placeholder="Por ejemplo: Oleo" required="" maxlength="50" data-toggle="tooltip" data-placement="top" onKeyUp="this.value = this.value.toUpperCase();">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Técnica <span class="sp-requerido">*</span></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <div class="group-material">
                    <input id="largo" name="largo" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Largo (cm)<span class="sp-requerido">*</span></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="ancho" name="ancho" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Ancho (cm)<span class="sp-requerido">*</span></label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="group-material">
                <input id="profundidad" name="profundidad" type="number" class="material-control tooltips-general" placeholder="Por ejemplo: 10" required="" maxlength="100" data-toggle="tooltip" data-placement="top";"> 
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Profundidad (cm)<span class="sp-requerido">*</span></label>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-start text-center mt-5">
        <div class="col-12">
            <button class="btn btn-primary btn-block" id="btnEnviar">
                Registrar Objeto
            </button>
        </div>
    </div>
</form>



