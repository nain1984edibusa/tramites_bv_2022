<?php
    include("includes/_visualizar_tramite.php");
?>
<div class="container-fluid">
    <?php
    include("./_view_res/rt_" . $tra_id . ".php");
//echo URL_SIS.DIRDOWNLOAD.$documento_visualizar;
    ?>
</div>
<?php if (($_SESSION["codperfil"] == CIUDADANO && $ttramite["et_id"] == CONTESTADO_DESPACHADO)) { ?>
    <div class="container-fluid">
        <?php
        include("includes/_informacion_pago.php");
        ?>
    </div>
    <?php
}
?>
<?php if (($_SESSION["codperfil"] == CIUDADANO && $ttramite["et_id"] == CONTESTADO_DESPACHADO) || ($_SESSION["codperfil"] != CIUDADANO)) { ?>
    <div class="container-fluid">
        <!--<iframe src="https://docs.google.com/viewer?url=<?php //echo URL_SIS.DIRDOWNLOAD.$_GET["ruta"]   ?>&embedded=true" width="100%" height="780" style="border: none;"></iframe>-->
        <embed src="<?php echo URL_SIS . DIRDOWNLOAD . $documento_visualizar ?>" type="application/pdf" width="100%" height="600px" />
    </div>
    <?php
}
?>
