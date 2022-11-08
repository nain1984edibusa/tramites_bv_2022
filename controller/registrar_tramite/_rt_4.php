<?php

//CAMPOS ESPECÍFICOS DEL TRÁMITE 4
require_once '../modelo/clstramite4.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
require_once '../modelo/clstramite4objeto.php';
require_once '../modelo/clstramite4contenedor.php';
require_once '../modelo/clstramiteusuarioturno.php';

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
    $te_codigo_pais_envio = $item['id_pais_envio'];
    $te_ciudad_envio = $item['ciudad_envio'];
    $te_viaja_con_paquete = $item['viaja_con_paquete'];
    $te_modo_envio = $item['id_metodo_envio'];
    $tut_zonal_id = $item['id_zonal'];
    $tut_fecha_atencion = $item['fecha_atencion'];
    $tut_hora = $item['id_hora'];
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
$clstut->setTe_codigo_pais_envio($te_codigo_pais_envio);
$clstut->setTe_ciudad_envio($te_ciudad_envio);
$clstut->setTe_viaja_con_paquete($te_viaja_con_paquete);
$clstut->setTe_modo_envio($te_modo_envio);

//Inserta datos del tramite 4
$tu4_id = $clstut->tu_insertar();

if ($tu4_id > 0) {
    /* Registrar turno */
    $clsTramiteUsuarioTurno = new clstramiteusuarioturno();
    $clsTramiteUsuarioTurno->setTut_fecha($tut_fecha_atencion);
    $clsTramiteUsuarioTurno->setTut_hora($tut_hora);
    $clsTramiteUsuarioTurno->setTut_zonal_id($tut_zonal_id);
    $clsTramiteUsuarioTurno->setTu_id($tu4_id);

    $clsTramiteUsuarioTurno->tut_insertar();

    /* Registrar objetos */
    $objetos = json_decode($_POST['json_datos_objeto'], true);
    foreach ($objetos as $item) {

        $clsTramite4Objeto = new clstramite4objeto();
        $clsTramite4Objeto->setTu_id($tu4_id);
        $clsTramite4Objeto->setTbc_id($item['tipo_bien_cultural']);
        $clsTramite4Objeto->setEob_id(1);
        $clsTramite4Objeto->setCon_id(0);

        $clsTramite4Objeto->setObj_cantidad($item['cantidad']);
        $clsTramite4Objeto->setObj_tema($item['tema']);
        $clsTramite4Objeto->setObj_autor($item['autor']);
        $clsTramite4Objeto->setObj_tecnica($item['tecnica']);
        $clsTramite4Objeto->setObj_largo($item['largo']);
        $clsTramite4Objeto->setObj_ancho($item['ancho']);
        $clsTramite4Objeto->setObj_profundidad($item['profundidad']);

        $obj_id = $clsTramite4Objeto->obj_insertar();

        /* Registrar contenedor */
        if ($obj_id > 0) {
            $clstramite4contenedor = new clstramite4contenedor();
            $clstramite4contenedor->setTu_id($tu4_id);
            $clstramite4contenedor->setObj_id($obj_id);
            $clstramite4contenedor->setTc_id(6); /*tipo 6 ninguno*/
            $clstramite4contenedor->setCon_numero(null);
            $clstramite4contenedor->setCon_seguridad(null);

            $clstramite4contenedor->con_insertar();
        }
    }
    $band = 1;
} else {
    $band = 0;
}