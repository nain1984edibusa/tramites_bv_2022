<?php

include_once("../modelo/cls17AnalisisQuimico.php");

$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();

$contenido_respuesta = "<h4>" . mb_strtoupper($ttramite["tra_resultado"]) . "</h4>"; //TIPO DE DOCUMENTO
if ($respuesta["tu_id"]) {
    $contenido_respuesta .= "<h4>" . mb_strtoupper("Nº " . $respuesta["tuc_num_serie_autorizacion"]) . "</h4>"; //Nro DE DOCUMENTO
}

$contenido_respuesta .= "<br/><h5>INFORMACIÓN GENERAL</h5><table>"
        . "<tr><th>Fecha de emisión:</th><td>" . $res_fecha . "</td></tr>"
        . "<tr><th>CUT:</th><td>" . $tra_codigo . "</td></tr>"
        . "<tr><th>Solicitante:</th><td>" . $ttramite["usu_apellido"] . " " . $ttramite["usu_nombre"] . " (" . $ttramite["usu_identificador"] . ")" . "</td></tr>"
        . "</table><br/>"; //DATOS GENERALES

/* Armar la tabla proforma */
$tabla = "<h5>TABLA PROFORMA</h5>"
        . "<table border=1>"
        . "<tr>"
        . "<th>Codigo</th>"
        . "<th>Descripcion</th>"
        . "</tr>";

$rstra = $analisisQuimico17;
while ($anexo = mysqli_fetch_array($rstra)) {
    $cuerpo .= "<tr>"
            . "<td>" . $anexo["ta_id"] . "</td>"
            . "<td>" . $anexo["ta_concepto"] . "</td>"
            . "</tr>";
}
$tabla = $tabla . $cuerpo . "</table>";



$contenido_respuesta .= $tabla;


//$contenido_respuesta .= "<br/><b>Anexos:</b><br/>";
//while ($anexo = mysqli_fetch_array($rstra)) {
//    $contenido_respuesta .= "<tr><td>" . $anexo["ta_id"] . "</td></tr>";
//}
//

if ($respuesta["tuc_tipocontestacion"] == "AFIRMATIVO") {
    $contenido_respuesta .= "<br/><div class='bloque_especifico'><p><br/>" . $observaciones . "</p>";
    $contenido_respuesta .= "<h5>NOTAS</h5>";
    $contenido_respuesta .= "<p>Los precios no incluyen IVA.</p>";
    $contenido_respuesta .= "<p>El Laboratorio del INPC trabaja con un Sistema de Aseguramiento de la Calidad basado en la Norma ISO/IEC 17025:2018. No obstante, no cuenta con la acreditación del SAE.</p>";
    $contenido_respuesta .= "<p>Tabla de costos con base al el Registro Oficial No. 208 del 9 de noviembre del 2007.</p>";
    $contenido_respuesta .= "<p>Tiempo de entrega: 15 días laborables.</p>";
} else {
    
}





