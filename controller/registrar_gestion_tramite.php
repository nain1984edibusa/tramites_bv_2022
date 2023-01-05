<?php

/* REGISTRAR TRÁMITE */
/* Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
require_once "../modelo/clsgestiontramite.php";

$datos_tramite = json_decode($_POST['json_datos_tramite'], true);
//recorrer el arreglo


foreach ($datos_tramite as $item) {
    $reg_id = $item['id_zonal'];
    $agt_id = $item['id_area'];
    $tra_id = $item['id_tramite'];
    $gt_tecnico_responsable = $item['tecnico'];
    $ti_id = $item['tipo_identificacion'];
    $gt_identificacion = $item['identificacion'];
    $gt_nombre = $item['nombres'];
    $gt_email = $item['email'];
    $usu_int_id = $item['usuario'];
    $gt_numero_celular = $item['celular'];
    $gt_numero_quipux = $item['numero_quipux'];
   
}

//$clstut->setTe_provincia($te_provincia);
$clsgestiontramite = new clsgestiontramite();
$clsgestiontramite->setReg_id($reg_id);
$clsgestiontramite->setAgt_id($agt_id);

$clsgestiontramite->setTra_id($tra_id);
$clsgestiontramite->setGt_fecha_recepcion(date("Y-m-d H:i:s"));
$clsgestiontramite->setGt_tecnico_responsable($gt_tecnico_responsable);
$clsgestiontramite->setTi_id($ti_id);
$clsgestiontramite->setGt_identificacion($gt_identificacion);
$clsgestiontramite->setGt_nombre($gt_nombre);
$clsgestiontramite->setGt_email($gt_email);
$clsgestiontramite->setUsu_int_id($usu_int_id);
$clsgestiontramite->setGt_numero_celular($gt_numero_celular);
$clsgestiontramite->setGt_numero_quipux($gt_numero_quipux);

$id_gestion_tramite = $clsgestiontramite->gt_insertar();

//if ($id_gestion_tramite > 0) {
//    echo json_encode(array('success' => 1));
//} else {
//    echo json_encode(array('error' => 0));
//}
?>