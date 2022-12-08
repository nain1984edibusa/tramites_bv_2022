<?php

//CAMPOS ESPECÍFICOS DEL TRÁMITE 4
require_once '../modelo/clstramite7.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
require_once '../modelo/clstramiteusuarioturno.php';

$tramite_especifico = json_decode($_POST['json_datos_tramite_especifico'], true);

foreach ($tramite_especifico as $item) {
    $tr_propietario = $item['id_regional'];
    $tr_objeto_solicitud = $item['objeto_solicitud'];
    
    $tr_provincia = $item['id_provincia'];
    $tr_canton = $item['id_canton'];
    $tr_parroquia = $item['id_parroquia'];
    $tr_regional = $item['id_regional'];
    $tr_sector = $item['sector'];
    $tr_via_principal = $item['via_principal'];
    $tr_via_secundaria = $item['via_secundaria'];
    $tr_numero_predio = $item['numero_predio'];
    $tr_numero_catastro = $item['numero_catastro'];
    
}

//CREANDO EL TRÁMITE
$clstut = new clstramite7();
$clstut->setTu_codigo($clstramiteusuario->getTu_codigo());
$clstut->setUsu_eid($clstramiteusuario->getUsu_eid());
$clstut->setTra_id($clstramiteusuario->getTra_id());
$clstut->setTu_fecha_ingreso($clstramiteusuario->getTu_fecha_ingreso());
$clstut->setTu_fecha_aprocont($clstramiteusuario->getTu_fecha_aprocont());
$clstut->setTu_fecha_contcont($clstramiteusuario->getTu_fecha_contcont());
/* ADD1/1 */
$clstut->setTu_fecha_iniciocoa($fecha_ingreso);
$clstut->setTu_fecha_concoa($fecha_control_coa);

/* add */
$clstut->setReg_id($clstramiteusuario->getReg_id());
$clstut->setEt_id($clstramiteusuario->getEt_id());
$clstut->setUsu_iid($clstramiteusuario->getUsu_iid());

$clstut->setTr_propietario($tr_propietario);
$clstut->setTr_objeto_solicitud($tr_objeto_solicitud);
$clstut->setTr_provincia($tr_provincia);
$clstut->setTr_canton($tr_canton);
$clstut->setTr_parroquia($tr_parroquia);
$clstut->setTr_regional($tr_regional);

$clstut->setTr_sector($tr_sector);
$clstut->setTr_via_principal($tr_via_principal);
$clstut->setTr_via_secundaria($tr_via_secundaria);
$clstut->setTr_numero_predio($tr_numero_predio);
$clstut->setTr_numero_catastro($tr_numero_catastro);

//Inserta datos del tramite 4
$tu7_id = $clstut->tu_insertar();

if ($tu7_id > 0) {
    
    $band = 1;
} else {
    $band = 0;
}