<?php

session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once "../modelo/clsTramite4Objeto.php";
require_once "../modelo/util.php";
require_once '../includes/functions.php';

if (isset($_POST["cantidad"]) && isset($_POST["tipobiencultural"])) { //SI SE RECIBIERON DATOS DEL FORMULARIO DE LOGIN
    $clsObjeto = new clsTramite4Objeto;
    $clsObjeto->setObj_cantidad($_POST["cantidad"]);
    $clsObjeto->setTbc_codigo($_POST["tipobiencultural"]);
    $clsObjeto->setObj_tema($_POST["tema"]);
//    $clsusu->setUsu_nombre($_POST["nombres"]);
//    $clsusu->setUsu_apellido($_POST["apellidos"]);
//    $clsusu->setPro_id($_POST["id_provincia"]);
//    $clsusu->setCan_id($_POST["id_canton"]);
//    $clsusu->setPar_id($_POST["id_parroquia"]);
//    $clsusu->setReg_id($_POST["id_regional"]);
//    $clsusu->setUsu_telefono($_POST["telefono"]);
//    $clsusu->setUsu_direccion($_POST["direccion"]);
//    $clsusu->setUsu_correo($_POST["email"]);
//    $clsusu->setUsu_contrasena(password_hash($_POST["clave"], PASSWORD_BCRYPT));
//    $clsusu->setRol_id(CIUDADANO); //ciudadano
//    $clsusu->setUsu_fechcreacion(date('Y-m-d H:i:s'));
//    $clsusu->setUsu_estado("INACTIVO"); //CAMBIAR A INACTIVO
    $clsObjeto->obj_insertar();
}
?>

