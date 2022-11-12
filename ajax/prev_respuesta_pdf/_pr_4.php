<?php

//$date = echo date("Y-m-d");
//$fecha_sistema = ($date . toISOString() . split('T')[0]);
//$hora_sistema = $date . getHours() + ':' + $date . getMinutes();

$contenido_respuesta = "<h4>" . mb_strtoupper($ttramite["tra_resultado"]) . "</h4>"; //TIPO DE DOCUMENTO
//$contenido_respuesta .=  "<h2>" . $tespecifico["reg_ciudad"] . "</h2>" ;

$contenido_respuesta .= "<p>El Instituto Nacional de Patromonio Cultural del Ecuador, una vez revisados los objetos y realizada la "
        . "inspección de los mismos, determina que los bienes detallados en el presente certificado, NO presentan características "
        . "descritas en los Art. 54 y 62 de la Ley Orgánica de Cultura; por lo tanto y en concordancia a lo estipulado en el Art. 76, "
        . "literal a) del Reglamento a la Ley Orgánica de Cultura, se descarta su condición de bienes perteneciantes al patrimonio "
        . "cultural nacional.</p>";

$contenido_respuesta .= "<br/><h5>DATOS GENERALES</h5><table>"
        . "<tr><th>Identificación:</th><td>" . $tusuario["usu_identificador"] . "</td><th>CUT:</th><td>" . $tra_codigo . "</td></tr>"
        . "<tr><th>Solicitante:</th><td>" . $ttramite["usu_apellido"] . " " . $ttramite["usu_nombre"] . "</td><th>Teléfono:</th><td>" . $tusuario["usu_telefono"] . "</td></tr>"
        . "<tr><th>e-mail:</th><td>" . $tusuario["usu_correo"] . "</td><th>Fecha ingreso solicitud:</th><td>" . $ttramite["tu_fecha_ingreso"] . "</td></tr>"
        . "<tr><th>Dirección:</th><td>" . $tusuario["usu_direccion"] . "</td><th>País de origen:</th><td>" . $tespecifico["nac_nombre"] . "</td></tr>"
        . "</table>"; //DATOS GENERALES


$contenido_respuesta .= "<br/><h5>DATOS DESTINO</h5><table>"
        . "<tr><th>Lugar de emisión:</th><td>" . $tespecifico["reg_ciudad"] . "</td></tr>"
        . "<tr><th>País de destino:</th><td>" . $tespecifico["pai_nombre"] . "</td><th>Ciudad de destino:</th><td>" . $tespecifico["te_ciudad_envio"] . "</td></tr>"
        . "<tr><th>Dirección de destino:</th><td>" . $tespecifico["te_direccion_envio"] . "</td><th>Fecha de salida:</th><td>" . $tespecifico["te_fecha_envio"] . "</td></tr>"
        . "</table>"; //DATOS GENERALES


/* Armar la tabla proforma */
$tabla = "<h5>DETALLE DE LOS OBJETOS/BIENES CULTURALES CERTIFICADOS:</h5>"
        . "<table class='tableGrid'>"
        . "<tr class='trGrid'; bgcolor='#DBE5F1'>"
        . "<th>Cant.</th>"
//        . "<th>Tipo de <br> bien cultural</th>"
        . "<th>Temática/ <br> Título</th>"
        . "<th>Autor</th>"
        . "<th>Técnica</th>"
        . "<th>Dimensiones</th>"
        . "<th>Contenedor</th>"
        . "<th>Nro de <br> Seguridad</th>"
        . "<th>Condición</th>"
        . "</tr>";
foreach ($noPatrimoniales as $row) {
    $cuerpo .= "<tr>"
            . "<td class='tdGrid'>" . $row["obj_cantidad"] . "</td>"
//            . "<td>" . $row["tbc_nombre"] . "</td>"
            . "<td>" . $row["obj_tema"] . "</td>"
            . "<td>" . $row["obj_autor"] . "</td>"
            . "<td>" . $row["obj_tecnica"] . "</td>"
            . "<td class='tdGrid'>" . $row["obj_largo"] . "*" . $row["obj_ancho"] . "*" . $row["obj_profundidad"] . "</td>"
            . "<td>" . $row["tc_nombre"] . "</td>"
            . "<td class='tdGrid'>" . $row["con_seguridad"] . "</td>"
            . "<td>" . $row["eob_nombre"] . "</td>"
            . "</tr>";
}
$tabla = $tabla . $cuerpo .
        "</table>";
$contenido_respuesta .= $tabla;

$contenido_respuesta .= "<br/><br/><br/><br/><br/><table>"
        . "<tr><td>" . $usuario_ejecutor["usu_nombre"] . " " . $usuario_ejecutor["usu_apellido"] . "</td></tr>"
        . "<tr><th>RESPONSABLE DE LA INSPECCION</th></tr>"
        . "<tr><th>INSTITUTO NACIONAL DE PATRIMONIO CULTURAL</th></tr>"
        . "<tr><td> Documento generado el: " . $fecha_sistema . "</td></tr>"
        . "</table><br/>"; //DATOS GENERALES


if ($respuesta["tuc_tipocontestacion"] == "AFIRMATIVO") {
    $contenido_respuesta .= "<br/><div>";
} 