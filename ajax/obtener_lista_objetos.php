<?php

/* incluir modelo(s) */
//if (isset($_GET['term'])){
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramite4objeto.php");

if (isset($_POST["tu_id"])) {

//OBTENER OBJETOS
    $clstramite4objeto = new clstramite4objeto();
    $clstramite4objeto->setTu_id($_POST["tu_id"]);
    $clstramite4objeto = $clstramite4objeto->obj_seleccionar_objeto_por_tramite();
}

