<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
session_start();
$modulo = "Responder";
$opcion = "Trámite Recibido";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./includes/functions.php");
/* incluir modelo(s) */
include_once("./modelo/Config.class.php");
include_once("./modelo/Db.class.php");
include_once("./modelo/clstramites.php");
include_once("./modelo/clstuanexos.php");
//include_once("./modelo/clstramiteanexos.php");
include_once("./modelo/clstramiteusuario.php");
include_once("modelo/clstipobiencultural.php");

/* generar instancias */
if ((isset($_GET["idtu"]) && (!empty($_GET["idtu"])))) { //SI SE RECIBE EL ID DEL TRÁMITE, PROCEDE
    $tramiteusuario = new clstramiteusuario();
    $tramiteusuario->setTu_id($_GET["idtu"]);
    $ttramite = $tramiteusuario->tra_seleccionar_byid();
    $ttramite = mysqli_fetch_array($ttramite);
    $tra_id = $ttramite["tra_id"];
    $tra_codigo = $ttramite["tu_codigo"];
    $regionalId = $ttramite["reg_id"]; // Para Tramite 5
    include_once("./modelo/clstramite" . $tra_id . ".php");
    include_once("./modelo/clstramiterespuestas.php");
    switch ($tra_id) {
        case "4":
            $tramitee = new clstramite4();
//            $clstipobiencultural = new clstipobiencultural();
//            $clstipobiencultural = $clstipobiencultural->tbc_seleccionaractivos();
//            
//            $clstipobiencultural = mysqli_fetch_object($clstipobiencultural);
//            $_SESSION["catalogoTipoBienCultural"] = $clstipobiencultural;
            break;
        case "5":
            $tramitee = new clstramite5();
            break;
        case "8":
            $tramitee = new clstramite8();
            break;
        case "12":
            $tramitee = new clstramite12();
            break;
        case "13":
            $tramitee = new clstramite13();
            break;
        case "16":
            $tramitee = new clstramite16();
            break;
        case "17":
            $tramitee = new clstramite17();
            break;
        case "18":
            $tramitee = new clstramite18();
            break;
    }
    $tramitee->setTu_codigo($tra_codigo);
    $tespecifico = $tramitee->tra_seleccionar_bycodigo();
    $tespecifico = mysqli_fetch_array($tespecifico);
    $tra_id = $_GET["idt"];
    $tu_id = $tespecifico["tu_id"];
    /* $tramite = new cl_tramites();
      $tramite->setTra_id($_GET["idt"]);
      $ntramite = $tramite->tra_seleccionar_byid();
      $ntramite = mysqli_fetch_array($ntramite); */
    /* $anexos =  new clstramiteanexos();
      $anexos->setTra_id($_GET["idt"]);
      $tanexos=$anexos->obtener_tramiteanexos(); */
    $anexos = new clstuanexos();
    $anexos->setTra_id($_GET["idt"]);
    $anexos->setTu_id($tu_id);
    $tanexos = $anexos->tua_seleccionar_byte();
    $respuestas = new clstramiterespuestas();
    $respuestas->setTra_id($tra_id);
    $respuestas->setTu_id($tu_id);
    $trespuestas = $respuestas->obtener_tramiterespuestas();
    ?>
    <!--<div class="container-fluid descripcion-container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
    <?php /* echo $ntramite["tra_descripcion"]?>
      </div>
      </div>
      </div>
      <div class="container-fluid">
      <div class="row">
      <div class="col-xs-12 lead">
      <ol class="breadcrumb">
      <li><a href="ui_bandeja_revision.php">Bandeja Trámites en Revisión</a></li>
      <li class="active"><?php echo $modulo?></li>
      <li class="active"><?php echo recortar_texto_bc($opcion); */ ?></li>
                </ol>
            </div>
        </div>
    </div>-->
    <?php
    $redireccion = "";
    switch ($_SESSION["codperfil"]) {
        case ASIGNADOR: $redireccion = "ui_bandeja_recibidos.php";
            break;
        case EJECUTOR: $redireccion = "ui_bandeja_revision.php";
            break;
        case APROBADOR: $redireccion = "ui_bandeja_revision.php";
            break;
    }
    ?>
    <div class="container-fluid">
        <div class="row msuperior">
            <div class="col-xs-3">
                <a class="btn btn-info btnanchocompleto" href="<?php echo $redireccion ?>"><i class="zmdi zmdi-arrow-left"></i> Regresar</a></li>
            </div>
            <?php
            switch ($ttramite["tu_band_respuesta"]) {
                case 0:
                    ?>
                    <div class="col-xs-3">
                        <a href="#" class="btn btn-secondary "><i class="zmdi zmdi-border-color btn-desactivado" title="Acción no permitida"></i> Firmar y Contestar </a>
                    </div>
                    <?php
                    break;
                case 1:
                    if ($_SESSION["codperfil"] == APROBADOR):
                        ?>
                        <div class="col-xs-3">
                            <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-secondary btnanchocompleto' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>', '<?php echo $_GET["idtu"] ?>', '<?php echo $tra_codigo; ?>', '<?php echo $ttramite["reg_id"] ?>', '<?php echo $ttramite["tra_respuesta"] ?>', '<?php echo $tra_id; ?>', '2');"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar tramite 2</a>
                        </div>
                        <?php
                    endif;
                    if ($_SESSION["codperfil"] == EJECUTOR):
                        ?>
                        <?php if (($ttramite["tu_band_convanxres"] == 1)) { ?>
                            <div class="col-xs-3">
                                <a href="#" class="btn btn-secondary  "><i class="zmdi zmdi-border-color"></i> Firmar y Reasignar 1</a>
                            </div>
                            <?php
                        }
                        if ($ttramite["tu_band_convanxres"] == -1) {
                            ?>
                            <?php if ($tra_id == 4) { ?>
                                <div class="col-xs-3">
                                    <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-secondary btnanchocompleto' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>', '<?php echo $_GET["idtu"] ?>', '<?php echo $tra_codigo; ?>', '<?php echo $ttramite["reg_id"] ?>', '<?php echo $ttramite["tra_respuesta"] ?>', '<?php echo $tra_id; ?>', '2');"><i class="zmdi zmdi-border-color"></i> Firmar y Contestar </a>
                                </div>
                                <?php
                            } else
                                
                                ?>
<!--                            <div class = "col-xs-3">
                                <a href="#" class="btn btn-secondary btn-desactivado" ><i class="zmdi zmdi-border-color"></i> Firmar y Reasignar 1</a>
                            </div>-->
                            <?php
                        }
                        ?>
                    <?php endif ?>
                    <?php
                    break;
            }
            ?>
        </div>
    </div>
    <div class="container-fluid">
        <?php include_once './includes/errores.php'; ?>
    </div>
    <?php include_once './includes/_visualizar_tramite.php'; ?>
    <div class="container-fluid">
        <div class="container-flat-form formularios_ct">
            <div class="title-flat-form title-flat-blue">Generación de respuesta al trámite </div>
            <div class="col-xs-12">
                <legend><i class="zmdi zmdi-border-color"></i> &nbsp; Respuesta</legend>
            </div>
            <form class="form-padding">
                
                <div class="row">
                    <?php include_once '_form_res/rf_' . $tra_id . ".php"; ?>
                    <?php if ($tra_id == 17) { ?>
                        <?php include_once '_form_res/rf_17_detalle_proforma.php'; ?>
                    <?php } ?>

                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("./includes/footer.php");
    include_once('./modal/auditoria.php');
    include_once('./modal/reasignar_tramite.php');
} else { //SI NO RECIBE EL ID DEL TRÁMITE, REDIRIGE AL CATÁLOGO DE TRÁMITES
    header("Location:" . RUTA_BANDEJAS_UI);
}
?>
<script type="text/javascript" src="js/funciones_generales.js"></script>
<script type="text/javascript" src="js/_ui_respuestas_tramites.js"></script>
<script type="text/javascript" src="js/VentanaCentrada.js"></script>


