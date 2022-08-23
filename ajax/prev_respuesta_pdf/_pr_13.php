<?php
$contenido_respuesta="<h4>".mb_strtoupper($ttramite["tra_resultado"])."</h4>";//TIPO DE DOCUMENTO
$contenido_respuesta.="<br/><h5>INFORMACIÓN GENERAL</h5><table>"
                    . "<tr><th>Fecha de emisión:</th><td>".$res_fecha."</td></tr>"
                    . "<tr><th>CUT:</th><td>".$tra_codigo."</td></tr>"
                    . "<tr><th>Solicitante:</th><td>".$ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]." (".$ttramite["usu_identificador"].")"."</td></tr>"
        . "</table><br/>";//DATOS GENERALES

$direccion=$tespecifico["te_direccion"];
if(strlen($tespecifico["te_codigo_inventario"])>0){
    $codinv=" (Código Inventario: ".$tespecifico["te_codigo_inventario"].")";
}else{
    $codinv="";
}
$contenido_respuesta.="<p>En atención al trámite ciudadano Nro." .$tra_codigo.", una vez que la Dirección de Control Técnico, Conservación y Salvaguardia del Patrimonio Cultural, a través del área de Gestión de Inventario ha realizado el análisis respectivo de la documentación relacionada al bien inmueble, se informa que: </p>";

if($respuesta["tuc_tipocontestacion"]=="AFIRMATIVO"){
    //$tresp=" <b>SI</b> cumple con los criterios de valoración patrimonial, por lo cual se realizará su incorporación al inventario nacional mueble.";
    $tipoAutorizacion = "AUTORIZA";
    $contenido_respuesta.="<p>El Instituto Nacional de  Patrimonio Cultural <b>Registra la Transferencia de Dominio</b>, del  bien inmueble inventariado con código: ".$tespecifico["te_codigo_inventario"].", ubicado en ".$tespecifico["te_direccion"]. "parroquia ".$tespecifico["par_nombre"].", cantón ".$tespecifico["can_nombre"].", provincia ".$tespecifico["pro_nombre"].", perteneciente al Sr/Sra. ".$tespecifico["tur_dueno_nom"]."</p>";
}else{
    //$tresp=" <b>NO</b> cumple con los criterios de valoración patrimonial, por lo que no amerita su incorporación al inventario nacional mueble.";
        //$tipoAutorizacion = "RECHAZA";
        $contenido_respuesta.="<p>El Instituto Nacional de  Patrimonio Cultural <b>NO</b>, procede con el Registro de Transferencia de Dominio del bien inmueble inventariado con código: ".$tespecifico["te_codigo_inventario"].", ubicado en ".$tespecifico["te_direccion"]. "parroquia ".$tespecifico["par_nombre"].", cantón ".$tespecifico["can_nombre"].", provincia ".$tespecifico["pro_nombre"].", perteneciente al Sr/Sra. ".$tespecifico["tur_dueno_nom"]."</p>";
}

$contenido_respuesta.="<br/><div class='bloque_especifico'><p><small><b>Observaciones:</b><br/>".nl2br($respuesta["tuc_marcolegal"])."</small></p>";
