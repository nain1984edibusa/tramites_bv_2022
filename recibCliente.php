<?php

include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once("./modelo/util.php");

$nombre = $_REQUEST['nombre'];
$correo = $_REQUEST['correo'];
$celular = $_REQUEST['celular'];

$QueryInsert = ("INSERT INTO clientes(
    nombre,
    correo,
    celular
)
VALUES (
    '" . $nombre . "',
    '" . $correo . "',
    '" . $celular . "'
)");



$inserInmueble = mysqli_query($con, $QueryInsert);

header("location:index.php");
?>
