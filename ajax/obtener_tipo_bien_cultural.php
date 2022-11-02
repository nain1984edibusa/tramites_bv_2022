<?php
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstipobiencultural.php");

if (isset($_POST["itemSeleccionado"])) {
    $itemSeleccionado = $_POST["itemSeleccionado"];

    $tipoBien = new clstipobiencultural();
    $catalogoTipoBienCultural = $tipoBien->tbc_seleccionarPorId($itemSeleccionado);

    $return_arr = array();
    if (mysqli_num_rows($catalogoTipoBienCultural) == 1) {
        $row = mysqli_fetch_array($catalogoTipoBienCultural);
        $row_array['tipobiencultural'] = $row['tbc_id'];
        $row_array['nombre'] = $row['tbc_nombre'];
        array_push($return_arr, $row_array);
    }
    echo json_encode($return_arr);
}


