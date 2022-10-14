<?php

//CAMPOS ESPECÍFICOS DEL TRÁMITE 4
require_once '../modelo/clstramite4.php';
//require_once '../modelo/clstramiterequisitos.php';
//require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';

$tramite_especifico = json_decode($_POST['json_datos_tramite_especifico'], true);

foreach ($tramite_especifico as $item) {
    $te_provincia = $item['id_provincia'];
    $te_canton = $item['id_canton'];
    $te_parroquia = $item['id_parroquia'];
    $te_regional = $item['id_regional'];
    $te_direccion = $item['direccion'];

    $te_pais_origen = $item['id_pais_origen'];
    $te_fecha_envio = $item['fecha_envio'];
    $te_direccion_envio = $item['direccion_envio'];
    $te_pais_envio = $item['id_pais_envio'];
    $te_ciudad_envio = $item['ciudad_envio'];
    $te_zonal = $item['id_zonal'];
    $te_fecha_atencion = $item['fecha_atencion'];
    $te_hora = $item['id_hora'];
}

//CREANDO EL TRÁMITE
$clstut = new clstramite4();
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

$clstut->setTe_provincia($te_provincia);
$clstut->setTe_canton($te_canton);
$clstut->setTe_parroquia($te_parroquia);
$clstut->setTe_regional($te_regional);
$clstut->setTe_direccion($te_direccion);

$clstut->setTe_pais_origen($te_pais_origen);
$clstut->setTe_fecha_envio($te_fecha_envio);
$clstut->setTe_direccion_envio($te_direccion_envio);
$clstut->setTe_codigo_pais_evio($te_pais_envio);
$clstut->setTe_ciudad_envio($te_ciudad_envio);

$clstut->setTe_fecha_envio($te_fecha_atencion);
$clstut->setTe_hora($te_hora);

//Inserta datos del tramite 4
$tu4_id = $clstut->tu_insertar();

if ($tu4_id_id != 0) {
    /* REGISTRAR LOS ANEXOS BASE-VACIOS */
    foreach ($objetos as $objeto) {

        $clsTramite4Objeto = new clsTramite4Objeto();
        $clsTramite4Objeto->setTu_id($objeto['tramite_especifico']);
        $clsTramite4Objeto->setTbc_codigo($objeto['tipo_bien_cultural']);
        $clsTramite4Objeto->setEob_codigo($objeto['descripcion']);
        $clsTramite4Objeto->setCon_codigo($objeto['descripcion']);

        $clsTramite4Objeto->setObj_cantidad($objeto['cantidad']);
        $clsTramite4Objeto->setObj_tema($objeto['tema']);
        $clsTramite4Objeto->setObj_autor($objeto['autor']);
        $clsTramite4Objeto->setObj_tecnica($objeto['tecnica']);
        $clsTramite4Objeto->setObj_largo($objeto['largo']);
        $clsTramite4Objeto->setObj_ancho($objeto['ancho']);
        $clsTramite4Objeto->setObj_profundidad($objeto['profundidad']);

        $clsTramite4Objeto->obj_insertar();
    }
    $band = 1;
} else {
    $band = 0;
}