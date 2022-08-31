<?php

/* incluir modelo(s) */
//if (isset($_GET['term'])){
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clsTipoAnalisis.php");

if (isset($_POST["itemSeleccionado"])) {
    $descripcion = $_POST["descripcion"];
    $itemSeleccionado = $_POST["itemSeleccionado"];
}

$tipoAnalisis = new clsTipoAnalisis();
$catalogoTipoAnalisis = $tipoAnalisis->tipoAnalisisPorId($itemSeleccionado);

$return_arr = array();
if (mysqli_num_rows($catalogoTipoAnalisis) == 1) {
    $row = mysqli_fetch_array($catalogoTipoAnalisis);
    $row_array['valor_unitario'] = $row['ta_costo'];
    $row_array['concepto'] = $row['ta_concepto'];

//    $row_array['id_provincia'] = $row['pro_id'];
//    $row_array['provincia'] = $row['pro_nombre'];
//    $row_array['id_canton']=$row['can_id'];
//    $row_array['canton'] = $row['can_nombre'];
//    $row_array['id_parroquia'] = $row['par_id'];
//    $row_array['parroquia'] = $row['par_nombre'];
//    $row_array['id_regional'] = $row['reg_id'];
//    $row_array['direccion'] = $row['usu_direccion'];
    array_push($return_arr, $row_array);
}
echo json_encode($return_arr);

