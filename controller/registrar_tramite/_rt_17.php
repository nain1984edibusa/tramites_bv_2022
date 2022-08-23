<?php

//CAMPOS ESPECÍFICOS DEL TRÁMITE 17
require_once '../modelo/clstramite17.php';
require_once '../modelo/clstramiterequisitos.php';
require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';
//CREANDO EL TRÁMITE
$clstut = new clstramite17();
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
$tu17_id = $clstut->tu_insertar();

//OBTENIENDO REQUISITOS
$fileTmpPath_carta = $_FILES['rpdffotos']['tmp_name'];
$fileName_carta = $_FILES['rpdffotos']['name'];
$id_rcarta = $_POST['rpdffotos_id'];

$ruta_subirarchivo = RUTA_ARCHIVOSTRAMITES . $clstramiteusuario->getTu_codigo() . "/";
$carta = subir_archivo($fileTmpPath_carta, $fileName_carta, $ruta_subirarchivo);
if ((isset($_FILES['rpdffotos']) && $_FILES['rpdffotos']['type'] == 'application/pdf')) {
//REGISTRANDO REQUISITOS EN LA BASE DE DATOS
    $regreq = new clsturequisitos();
    $regreq->setTra_id($tramite);
    $regreq->setTur_rutaarchivo($ruta_subirarchivo . $carta);
    $regreq->setTu_id($tu17_id);
    $regreq->setReq_id($id_rcarta);
    if ($regreq->tur_insertar() == 1) {
        /* REGISTRAR LOS ANEXOS BASE-VACIOS */
        $anexos = new clstramiteanexos();
        $anexos->setTra_id($tramite);
        $nanexos = $anexos->obtener_tramiteanexos();
        $anexoe = new clstuanexos();
        while ($ranexo = mysqli_fetch_array($nanexos)) {
//echo $tu8_id."ID<br/>";
            $anexoe->setTu_id($tu17_id);
            $anexoe->setTra_id($tramite);
            $anexoe->setTua_codigoe("");
            $anexoe->setTua_rutaarchivo("");
            $anexoe->setAnx_id($ranexo["anx_id"]);
            $anexoe->tua_insertar();
        }
        $band = 1;
    } else {
//SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
        $band = 0;
        $clstut->setTu_estado("INACTIVO");
        $clstut->tu_cambiar_estado();
    }
} else {
    //SI NO SE INSERTARON LOS ARCHIVOS PONER EL TRAMITE INACTIVO
    $band = 0;
    $clstut->setTu_estado("INACTIVO");
    $clstut->tu_cambiar_estado();
}