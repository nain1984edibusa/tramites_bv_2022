<?php

require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once "../modelo/util.php";
require_once '../includes/functions.php';
require_once "../modelo/clsTramite4Objeto.php";

$objetos = json_decode($_POST['json'], true);

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

//if (isset($_POST["cantidad"]) && isset($_POST["tipobiencultural"])) { //SI SE RECIBIERON DATOS DEL FORMULARIO DE LOGIN
//    $clsObjeto = new clsTramite4Objeto;
//    $clsObjeto->setTu_id(20);
//    $clsObjeto->setTbc_codigo($_POST["tipobiencultural"]);
//    $clsObjeto->setEob_codigo(2);
//    $clsObjeto->setCon_codigo(3);
//    $clsObjeto->setObj_cantidad($_POST["cantidad"]);
//    $clsObjeto->setObj_tema($_POST["tema"]);
//    $clsObjeto->setObj_autor($_POST["autor"]);
//    $clsObjeto->setObj_tecnica($_POST["tecnica"]);
//    $clsObjeto->setObj_largo($_POST["largo"]);
//    $clsObjeto->setObj_ancho($_POST["ancho"]);
//    $clsObjeto->setObj_profundidad($_POST["profundidad"]);
//
//    $lista_objetos[] = $clsObjeto;
//
//    array_push($lista_objetos, $clsObjeto);
//}
?>