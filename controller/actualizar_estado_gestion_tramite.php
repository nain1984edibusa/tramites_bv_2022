<?php

require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
require_once "../modelo/clsgestiontramite.php";

if (!empty($_GET)) {

    $clsgestiontramite = new clsgestiontramite;
    $clsgestiontramite->setGt_id($_GET["gt_id"]);
    $clsgestiontramite->setEgt_id("1");
    $clsgestiontramite->setGt_fecha_respuesta(date("Y-m-d H:i:s"));
    $clsgestiontramite->gt_cambiar_estado();
}
?>