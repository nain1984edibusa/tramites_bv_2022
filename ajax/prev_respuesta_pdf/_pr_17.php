<?php
//include_once("../modelo/cls17AnalisisQuimico.php");
include_once("../modelo/clstramite17DetalleProforma.php");
include_once("../modelo/clsusuarios.php");

//$analisisQuimico = new cls17AnalisisQuimico();
//$analisisQuimico->setTu_id($tespecifico["tu_id"]);
//$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();
$detalleProforma = new clstramite17DetalleProforma();
$detalleProforma->setTu_id($tespecifico["tu_id"]);
$detalleProforma = $detalleProforma->detalleProformaPorTramite();

$rstra = $detalleProforma;
$detalleProformaCalculos = $detalleProforma;
$subtotal = 0;

$usuarioProforma = new clsusuarios();
$usuarioProforma->setUsu_id($ttramite["usu_extid"]);
$tusuarioProforma = $usuarioProforma->usu_email_byid();
$tusuarioProforma = mysqli_fetch_array($tusuarioProforma);

$contenido_respuesta = "<h4>" . mb_strtoupper($ttramite["tra_resultado"]) . "</h4>"; //TIPO DE DOCUMENTO
//if ($respuesta["tu_id"]) {
//    $contenido_respuesta .= "<h4>" . mb_strtoupper("Nº " . $respuesta["tuc_num_serie_autorizacion"]) . "</h4>"; //Nro DE DOCUMENTO
//}
$contenido_respuesta .= "<br/><h5>DATOS GENERALES</h5><table>"
        . "<tr><th>CUT:</th><td>" . $tra_codigo . "</td></tr>"
        . "<tr><th>Solicitante:</th><td>" . $ttramite["usu_apellido"] . " " . $ttramite["usu_nombre"] . "</td><th>Teléfono:</th><td>" . $tusuarioProforma["usu_telefono"] . "</td></tr>"
        . "<tr><th>e-mail:</th><td>" . $tusuarioProforma["usu_correo"] . "</td><th>Fecha:</th><td>" . $res_fecha . "</td></tr>"
        . "<tr><th>Dirección:</th><td>" . $tusuarioProforma["usu_direccion"] . "</td></tr>"
        . "</table><br/>"; //DATOS GENERALES

/* Armar la tabla proforma */
$tabla = "<h5>OFERTA</h5>"
        . "<table border=1>"
        . "<tr>"
        . "<th>Código</th>"
        . "<th>Ensayo/Parámetro</th>"
        . "<th>Nro. Items <br> de ensayo</th>"
        . "<th>Precio por <br> item de ensayo<br> US$</th>"
        . "<th>Total a <br> Pagar</th>"
        . "</tr>";

while ($row = mysqli_fetch_array($rstra)) {
    $cuerpo .= "<tr>"
            . "<td>" . $row["ta_id"] . "</td>"
            . "<td>" . $row["ta_concepto"] . "</td>"
            . "<td>" . $row["ta_cantidad"] . "</td>"
            . "<td>" . $row["ta_valor_unitario"] . "</td>"
            . "<td>" . $row["ta_valor_total"] . "</td>"
            . "</tr>";

    $subtotal += $row[5];
}

$iva = ($subtotal * 12) / 100;
$total = $subtotal + $iva;
$tabla = $tabla . $cuerpo . "<tr><td colspan=4 align=right>SUBTOTAL:</td><td>" . $subtotal . "</td>" . "</tr>" . "<tr><td colspan=4 align=right>12% IVA:</td><td>" . $iva . "</td>" . "</tr>" . "<tr><td colspan=4 align=right>TOTAL:</td><td>" . $total . "</td>" . "</tr>" .
        "</table>";

$contenido_respuesta .= $tabla;

//$contenido_respuesta .= "<br/><table>"
//        . "<tr><th> </th><td>   </td><th>SubTotal:</th><td>" . $subtotal . "</td></tr>"
//        . "<tr><th> </th><td>   </td><th>12% IVA:</th><td>" . $iva . "</td></tr>"
//        . "<tr><th> </th><td>   </td><th>Total:</th><td>" . $total . "</td></tr>"
//        . "</table><br/>"; //DATOS GENERALES
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