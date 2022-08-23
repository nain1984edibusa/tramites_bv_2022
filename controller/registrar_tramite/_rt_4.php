<?php

//CAMPOS ESPECÍFICOS DEL TRÁMITE 4
require_once '../modelo/clstramite4.php';
//require_once '../modelo/clstramiterequisitos.php';
//require_once '../modelo/clsturequisitos.php';
require_once '../modelo/clstramiteanexos.php';
require_once '../modelo/clstuanexos.php';

$te_provincia=$_POST["id_provincia"];
$te_canton=$_POST["id_canton"];
$te_parroquia=$_POST["id_parroquia"];
$te_regional=$_POST["id_regional"];
$te_direccion=$_POST["direccion"];


$te_nacionalidad = $_POST["id_nacionalidad"];
$te_fecha_envio = $_POST["fecha_envio"];
$te_direccion_envio = $_POST["direccion_envio"];
$te_pais_envio = $_POST["id_pais_envio"];
$te_ciudad_envio = $_POST["ciudad_envio"];
$te_regional = $_POST["id_regional"];
$te_fecha_atencion = $_POST["fecha_atencion"];
$te_hora = $_POST["id_hora"];

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

$clstut->setTe_pais_origen($te_nacionalidad);
$clstut->setTe_fecha_envio($te_fecha_envio);
$clstut->setTe_direccion_envio($te_direccion_envio);
$clstut->setTe_codigo_pais_evio($te_pais_envio);

$clstut->setTe_ciudad_envio($te_ciudad_envio);
$clstut->setTe_regional($te_regional);
$clstut->setTe_fecha_envio($te_fecha_atencion);
$clstut->setTe_hora($te_hora);

//
$tu4_id=$clstut->tu_insertar();
if($tu4_id_id!=0){
    /*REGISTRAR LOS ANEXOS BASE-VACIOS*/
    $anexos=new clstramiteanexos();
    $anexos->setTra_id($tramite);
    $nanexos=$anexos->obtener_tramiteanexos();
    $anexoe=new clstuanexos();
    while($ranexo=mysqli_fetch_array($nanexos)){
        //echo $tu8_id."ID<br/>";
        $anexoe->setTu_id($tu4_id);
        $anexoe->setTra_id($tramite);
        $anexoe->setTua_codigoe("");
        $anexoe->setTua_rutaarchivo("");
        $anexoe->setAnx_id($ranexo["anx_id"]);
        $anexoe->tua_insertar();
    }
    $band=1;
}else{
    $band=0;
}