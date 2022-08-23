<?php

/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/* REGISTRAR TRÁMITE */
/* Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../modelo/clstramiterespuestas.php';
require_once '../modelo/clstramiteusuario.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
/* OBTENCIÓN DE DATOS DE LA SESION Y DEL FORMULARIO */
$id_tramite = $_POST["tra_id"]; //id del trámite
$tu_id = $_POST["tu_id"]; //id tu tabla trámite específico
$tu_idg = $_POST["tu_idg"]; //id tu tabla tabla general
$proceso = $_POST["proceso"]; //proceso a realizar
$tuc_id = $_POST["tuc_id"]; //id tuc
$tipo_contestacion = $_POST["tipo_contestacion"];
$codigo_tu = $_POST["tu_codigo"];
$regionalId = $_POST["regId"];
//INCLUIR TRAMITE ESPECÍFICO
require_once '../modelo/clstu' . $id_tramite . 'respuestas.php';
/* GENERAR EL ARCHIVO, GUARDAR Y OBTENER RUTA */
$ruta_archivo = NULL; //"PENDIENTERUTA";
/* REGISTRAR RESPUESTA DEL TRÁMITE ESPECÍFICO */
switch ($id_tramite) {

    case "5":
        $clstramiteer = new clstu5respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $marco_legal = $_POST["marcolegal"];
        $clstramiteer->setMarco_legal($marco_legal);
        $lastAutorizacion = mysqli_fetch_array($clstramiteer->obtener_lastAutorizacion($regionalId));
        if ($lastAutorizacion["tuc_num_autorizacion"] != null) {
            $nuevaAut = $lastAutorizacion["tuc_num_autorizacion"] + 1;
        } else {
            $nuevaAut = 1;
        }
//	$serieAutorizacion = "AUT-INPC-Z".$regionalId."-".$nuevaAut."-".date("Y");         
        if ($regionalId != 8) {
            $serieAutorizacion = "AUT-INPC-Z" . $regionalId . "-" . $nuevaAut . "-" . date("Y");
        } else {
            $serieAutorizacion = "AUT-INPC-" . $nuevaAut . "-" . date("Y");
        }
        $clstramiteer->setTuc_num_serie_autorizacion($serieAutorizacion);
        $clstramiteer->setTuc_num_autorizacion($nuevaAut);
        break;

    case "8":
        $clstramiteer = new clstu8respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $marco_legal = $_POST["marcolegal"];
        $clstramiteer->setMarco_legal($marco_legal);
        break;
    case "12":
        $clstramiteer = new clstu12respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $infoadicional = $_POST["infoadicional"];
        $fichas_nvalidadas = intval($_POST["fichas_nvalidadas"]);
        $total_fichas = intval($_POST["total_fichas"]);
        //echo $fichas_nvalidadas.$total_fichas;
        if ($fichas_nvalidadas == 0) {
            $tipo_contestacion = "AFIRMATIVO";
        } elseif ($fichas_nvalidadas == $total_fichas) {
            $tipo_contestacion = "NEGATIVO";
        } else {
            $tipo_contestacion = "PARCIAL";
        }
        $clstramiteer->setInfo_adicional($infoadicional);
        $clstramiteer->setFichas_nvalidadas($fichas_nvalidadas);
        break;
    case "13":
        $clstramiteer = new clstu13respuestas();
        $marco_legal = $_POST["marcolegal"];
        $clstramiteer->setMarco_legal($marco_legal);
        break;
    case "16":
        $clstramiteer = new clstu16respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $infoadicional = $_POST["infoadicional"];
        $clstramiteer->setInfo_adicional($infoadicional);
        break;
    case "17":
        $clstramiteer = new clstu17respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $marco_legal = $_POST["marcolegal"];
        $clstramiteer->setMarco_legal($marco_legal);
        $lastAutorizacion = mysqli_fetch_array($clstramiteer->obtener_lastAutorizacion($regionalId));
        if ($lastAutorizacion["tuc_num_autorizacion"] != null) {
            $nuevaAut = $lastAutorizacion["tuc_num_autorizacion"] + 1;
        } else {
            $nuevaAut = 1;
        }
//	$serieAutorizacion = "AUT-INPC-Z".$regionalId."-".$nuevaAut."-".date("Y");         
        if ($regionalId != 8) {
            $serieAutorizacion = "AUT-INPC-Z" . $regionalId . "-" . $nuevaAut . "-" . date("Y");
        } else {
            $serieAutorizacion = "AUT-INPC-" . $nuevaAut . "-" . date("Y");
        }
        $clstramiteer->setTuc_num_serie_autorizacion($serieAutorizacion);
        $clstramiteer->setTuc_num_autorizacion($nuevaAut);
        break;
        break;
    case "18":
        $clstramiteer = new clstu18respuestas();
        //$marco_legal=nl2br($_POST["marcolegal"]);
        $infoadicional = $_POST["infoadicional"];
        $clstramiteer->setInfo_adicional($infoadicional);
        break;
}
$clstramiteer->setTra_id($id_tramite);
$clstramiteer->setTu_id($tu_id);
$clstramiteer->setTuc_cumple("PENDIENTE");
$clstramiteer->setTuc_rutaarchivo('/upload/172022080911170472/fc2bb8553c9ac50519946a2af97b5be6.pdf');
$clstramiteer->setTuc_tipo_contestacion($tipo_contestacion);
$responsable_proceso = "";
switch ($_SESSION["codperfil"]) {
    case EJECUTOR: $responsable_proceso = "ejecutor";
        $clstramiteer->setUsu_ejecutor($_SESSION["codusuario"]);
        break;
    case APROBADOR: $responsable_proceso = "aprobador";
        $clstramiteer->setUsu_aprobador($_SESSION["codusuario"]);
        break;
}
if ($proceso == "editar") {
    $clstramiteer->setTuc_id($tuc_id);
    $reg_respuesta = $clstramiteer->tuc_actualizar_respuesta($responsable_proceso);
} elseif ($proceso == "registrar") {
    $reg_respuesta = $clstramiteer->tuc_insertar();
}
//exit();
if ($reg_respuesta > 0) {
    //ACTUALIZAR BANDERA DE RESPUESTA EN TRAMITE USUARIO Y TRAMITE ESPECIFICO
    $clstramiteusuario = new clstramiteusuario();
    $clstramiteusuario->setTu_id($tu_idg);
    $clstramiteusuario->setTu_codigo($codigo_tu);
    $clstramiteusuario->setTu_band_respuesta("1");
    $clstramiteusuario->tra_cambiar_bandrespuesta("ct_tramite_usuario");
    $clstramiteusuario->setTu_id($tu_id);
    $clstramiteusuario->tra_cambiar_bandrespuesta("_ct_tramite" . $id_tramite);

    //VERIFICAR QUE TODOS LOS ANEXOS Y RESPUESTAS ESTÁN COMO PENDIENTE O CUMPLIDO, PARA PONER -1
    require_once '../modelo/clstuanexos.php';
    $clstuanexo = new clstuanexos();
    $clsturespuesta = new clstramiterespuestas();
    include("verificar_estado_anxres.php");
    if (($anx_incorrecto == 0) && ($respuesta["tuc_cumple"] != "INCORRECTO")) {
        //echo "si cambio";
        $clstramiteusuario->setTu_band_convanxres("-1");
        $clstramiteusuario->tra_cambiar_bandanxres("ct_tramite_usuario");
        $clstramiteusuario->tra_cambiar_bandanxres("_ct_tramite" . $id_tramite);
    }
    //exit();
    //REDIRECCIONAR
    redireccionar("../ui_respuestas_tramites.php?idt=" . $id_tramite . "&idtu=" . $tu_idg . "&proc=regres&est=1");
} else {
    //REDIRECCIONAR
    redireccionar("../ui_respuestas_tramites.php?idt=" . $id_tramite . "&idtu=" . $tu_idg . "&proc=regres&est=0");
}
?>
