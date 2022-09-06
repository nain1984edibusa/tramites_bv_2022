<?php

/* incluir modelo(s) */
//if (isset($_GET['term'])){
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clsTipoAnalisis.php");

if (isset($_POST["accion"])) {
    $tipoAnalisis = new clsTipoAnalisis();
    $catalogoTipoAnalisis = $tipoAnalisis->tipoAnalisisSeleccionarTodo();

    $return_arr = array();
    if (mysqli_num_rows($catalogoTipoAnalisis) > 0) {
        $row = mysqli_fetch_array($catalogoTipoAnalisis);
        $row_array['valor_unitario'] = $row['ta_costo'];
        $row_array['concepto'] = $row['ta_concepto'];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
}

