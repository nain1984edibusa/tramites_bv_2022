<?php
$contenido_respuesta="<h4>".mb_strtoupper($ttramite["tra_resultado"])."</h4>";//TIPO DE DOCUMENTO
if($respuesta["tu_id"]){
    $contenido_respuesta.="<h4>".mb_strtoupper("Nº ".$respuesta["tuc_num_serie_autorizacion"])."</h4>";//Nro DE DOCUMENTO
}

$contenido_respuesta.="<br/><h5>INFORMACIÓN GENERAL</h5><table>"
                    . "<tr><th>Fecha de emisión:</th><td>".$res_fecha."</td></tr>"
                    . "<tr><th>CUT:</th><td>".$tra_codigo."</td></tr>"
                    . "<tr><th>Solicitante:</th><td>".$ttramite["usu_apellido"]." ".$ttramite["usu_nombre"]." (".$ttramite["usu_identificador"].")"."</td></tr>"
                    . "</table><br/>";//DATOS GENERALES

//$direccion=$tespecifico["te_direccion"];
//if(strlen($tespecifico["te_codigo_inventario"])>0){
//    $codinv=" (Código Inventario: ".$tespecifico["te_codigo_inventario"].")";
//}else{
//    $codinv="";
//}
$contenido_respuesta.="";
$observaciones=nl2br($respuesta["tuc_marcolegal"]);
if($respuesta["tuc_tipocontestacion"]=="AFIRMATIVO"){
    //$tresp=" <b>SI</b> cumple con los criterios de valoración patrimonial, por lo cual se realizará su incorporación al inventario nacional mueble.";
    $tipoAutorizacion = "AUTORIZA";
    $contenido_respuesta.="<p>El Instituto Nacional de Patrimonio Cultural <b>AUTORIZA</b> que la propuesta de Investigación referido el presente trámite <b>SI</b> cumple con los criterios de valoración técnica, por lo cual se realizará su incorporación al Registro Único de Proyectos de investigación arqueológica y paleontológica del Ecuador.</p>";
    $contenido_respuesta.="<br/><div class='bloque_especifico'><p><br/>".$observaciones."</p>";
    //$contenido_respuesta.="<p>".$observaciones."</p>";
    $contenido_respuesta.="<p>El investigador/a, deberá cumplir a cabalidad con las disposiciones del Art. 44 literal a), Art, 85 literal e) de la Ley de Orgánica de Cultura; y entregar:</p>";
    $contenido_respuesta.="<p><ul>";
    $contenido_respuesta.="<li> Un informe técnico final escrito y en CD en formato digital; deberá contener todos los parámetros técnicos de investigación arqueológica, así como los mapas con la ubicación de los sectores investigados.</li>";
    $contenido_respuesta.="<li> El material cultural diagnóstico debidamente inventariado y analizado debe entregarse en gavetas plásticas con tapa, con sus etiquetas respectivas a las Reservas técnicas de Investigación. El material no diagnóstico, previo registro se procederá a enterrarlo en uno de los sitios donde fue extraído según la reglamentación vigente.</li>";
    $contenido_respuesta.="</ul></p>";
    $contenido_respuesta.="<p>Si el investigador/a incumpliere con la entrega del informe final y con lo establecido en la presente autorización, dentro de los respectivos plazos solicitados, el Instituto Nacional de Patrimonio Cultural, aplicará todo el rigor de la Ley y se reserva el derecho de exigir a la compañía el cambio inmediato de profesional para la investigación de dicho sector, siempre y cuando no afecte a la integridad del bien cultural.</p>";
    
}else{
    //$tresp=" <b>NO</b> cumple con los criterios de valoración patrimonial, por lo que no amerita su incorporación al inventario nacional mueble.";
        //$tipoAutorizacion = "RECHAZA";
        $contenido_respuesta.="<p>El Instituto Nacional de  Patrimonio Cultural <b>NO AUTORIZA</b>, la propuesta de Investigación referido el presente trámite por <b>NO</b> cumplir con los criterios de valoración técnica</p>";
        $contenido_respuesta.="<br/><div class='bloque_especifico'><p><b>Observaciones:</b><br/>".$observaciones."</p>";
}

//$contenido_respuesta.="<br/><div class='bloque_especifico'><p><small><b>Observaciones:</b><br/></small></p>";



