<?php

/* REGISTRAR TRÁMITE */
/* Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';
require_once '../includes/functions.php';
require_once "../modelo/util.php";
require_once "../modelo/clstramite17DetalleProforma.php";

$productos = json_decode($_POST['json'], true);
//recorrer el arreglo
foreach ($productos as $producto) {

    $clstramite17DetalleProforma = new clstramite17DetalleProforma();
    $clstramite17DetalleProforma->setTu_id($producto['tramite_especifico']);
    $clstramite17DetalleProforma->setTa_id($producto['id_analisis_quimico']);
    $clstramite17DetalleProforma->setTa_concepto($producto['descripcion']);
    $clstramite17DetalleProforma->setTa_cantidad($producto['cantidad']);
    $clstramite17DetalleProforma->setTa_valor_unitario($producto['precio']);
    $clstramite17DetalleProforma->setTa_valor_total($producto['total']);

    $clstramite17DetalleProforma->tu_insertar();
}

$clstramiteer = new clstu17respuestas();
?>