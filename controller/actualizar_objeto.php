<?php

include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once '../modelo/clstramite4objeto.php';
include_once '../modelo/clstramite4contenedor.php';
?>
<?php

$id_condicion = $_POST["id_condicion"];
$contenedor = new clstramite4contenedor();
$contenedor->setTu_id($_POST["tu_id"]);
$contenedor->setObj_id($_POST["obj_id"]);
$contenedor = $contenedor->con_seleccionar_por_objeto();
$contenedor = mysqli_fetch_array($contenedor);

$con_id = $contenedor["con_id"];
$tu_id = $contenedor["tu_id"];
$obj_id = $contenedor["obj_id"];

if (!empty($_POST)) {
    if ($id_condicion == "2") {

//        $registros = mysqli_num_rows($contenedor);
        if ($con_id > 0) {
            $clstramite4contenedor = new clstramite4contenedor();
            $clstramite4contenedor->setCon_id($con_id);
            $clstramite4contenedor->setTu_id($tu_id);
            $clstramite4contenedor->setObj_id($obj_id);
            $clstramite4contenedor->setTc_id($_POST["id_tipo_contenedor"]);
            $clstramite4contenedor->setCon_numero($_POST["numero_contenedor"]);
            $clstramite4contenedor->setCon_seguridad($_POST["numero_seguridad"]);

            $clstramite4contenedor->con_actualizar();
        }
    }

    //actualizar objeto
    $clstramite4objeto = new clstramite4objeto;
    $clstramite4objeto->setObj_id($_POST["obj_id"]); // cargo en la clase
    $clstramite4objeto->setTu_id($_POST["tu_id"]);
    $clstramite4objeto->setTbc_id($_POST["tbc_id"]);

    if ($id_condicion == "2") {
        $clstramite4objeto->setEob_id($_POST["id_condicion"]);
        $clstramite4objeto->setCon_id($con_id);
    } else {
        $clstramite4objeto->setEob_id($id_condicion);
        $clstramite4objeto->setCon_id(6); //ninguno

        $clstramite4contenedor = new clstramite4contenedor();
        $clstramite4contenedor->setCon_id($con_id);
        $clstramite4contenedor->setTu_id($tu_id);
        $clstramite4contenedor->setObj_id($obj_id);
        $clstramite4contenedor->setTc_id(6);
        $clstramite4contenedor->setCon_numero(0);
        $clstramite4contenedor->setCon_seguridad(0);

        $clstramite4contenedor->con_actualizar();
    }

    $clstramite4objeto->setObj_cantidad($_POST["cantidad"]);
    $clstramite4objeto->setObj_tema($_POST["tema"]);
    $clstramite4objeto->setObj_autor($_POST["autor"]);
    $clstramite4objeto->setObj_tecnica($_POST["tecnica"]);
    $clstramite4objeto->setObj_largo($_POST["largo"]);
    $clstramite4objeto->setObj_ancho($_POST["ancho"]);
    $clstramite4objeto->setObj_profundidad($_POST["profundidad"]);
    $clstramite4objeto->obj_actualizar();

    //actualizar contenedor sea tipo no patrimonial
}
?>
