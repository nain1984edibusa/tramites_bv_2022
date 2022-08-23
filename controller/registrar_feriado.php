<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*REGISTRAR TRÁMITE*/
/*Recibe las variables del formulario de registro del trámite, registra su información básica, e
 * incluye otros archivos sobre el tratamiento de cada trámite según sus características específicas */
session_start();
require_once '../config/variables.php';
require_once '../modelo/Db.class.php';
require_once '../modelo/Config.class.php';

require_once '../modelo/clsusuarios.php';

require_once '../modelo/clsauditoria.php';

require_once '../modelo/clsferiados.php';
require_once '../modelo/clsferiadosanio.php';

require_once '../includes/functions.php';
require_once "../modelo/util.php";
/*OBTENCIÓN DE DATOS DE LA SESION Y DEL FORMULARIO*/
$usuario = $_SESSION["codusuario"]; //código usuario
//$feriado = $_POST["idf"]; //id del feriado
$descripcion_feriado = $_POST['nombre_feriado'];
$tipo_feriado = $_POST['tipo_feriado'];
$dia_conmemora = $_POST['dia_conmemoracion'];
$mes_conmemora = $_POST['mes_conmemoracion'];

$feriado_inicio = $_POST["feriado_inicio"];
$feriado_fin = $_POST["feriado_fin"];
$regional = $_POST["sel_regional"]; //regional // LA REGIONAL DEL TRAMITE VA A DEPENDER DONDE ESTÁ EL DOCUMENTO

$diasFeriado = diferencia_fechas($feriado_inicio, $feriado_fin);
$diasHabiles = array();
$diasHabiles = getDiasHabiles($feriado_inicio, $feriado_fin);

$objFeriado = new clsferiado();
$objFeriado->setFer_nombre($descripcion_feriado);

$objFeriado->setFer_tipo($tipo_feriado);
$objFeriado->setFer_fecha_dia($dia_conmemora);
$objFeriado->setFer_fecha_mes($mes_conmemora);
if($tipo_feriado == 'NACIONAL'){
    $objFeriado->setRed_id (0);
}
else{ 
    $objFeriado->setRed_id($regional);
}

$idFeriado = $objFeriado->fer_insertar();
if( $idFeriado != 0) {
    //Eliminamos los registros de feriado previos para ingresar los nuevos validos
    $objFeriadoA = new clsferiadosanio();
    $objFeriadoA->setFer_id($idFeriado);
    
    
    if (mysqli_num_rows($objFeriadoA->seleccion_todo()) != 0 ){
        $objFeriadoA->fea_eliminar();
    }
    
        for ($i=0; $i<count($diasHabiles); $i++){
            //echo "dia laborable :".$i ." ". $diasHabiles[$i] ."</br>";
            //echo "anio :".$i ." ". date('Y', strtotime($diasHabiles[$i])) ."</br>";
            $objFeriadoAnio = new clsferiadosanio();
            $objFeriadoAnio->setFer_id($idFeriado);
            $objFeriadoAnio->setFea_fecha($diasHabiles[$i]);
            $objFeriadoAnio->setFea_anio(date('Y', strtotime($diasHabiles[$i])));
            $objFeriadoAnio->fea_insertar();
            
        }
         
        
    
    
    
    
   //redireccionar("../ue_formularios_tramites.php?idt=$tramite&proc=regtra&est=0");
   redireccionar("../ui_adm_fechas.php"); 
 }


//
//if($duracion_tramite<=DIAS_COLCHON){
//    $fecha_control=$fecha_ingreso;
//}else{
//    $fecha_control=sumar_ndias_fecha($fecha_ingreso, DIAS_COLCHON);
//}
//$fecha_fin=sumar_ndias_fecha($fecha_ingreso,$duracion_tramite);
//$codigo_tramite=generar_codigo_tramite($tramite,$fecha_ingreso,$usuario);
//$carpeta=DIRSERVIDOR.RUTA_ARCHIVOSTRAMITES.$codigo_tramite;
//if(!file_exists($carpeta)){
//    mkdir($carpeta,0777,true);
//}
////echo $codigo_tramite;
///*CREACIÓN DE REGISTRO E INFORMACIÓN PARA EL INSERTADO DEL TRÁMITE*/
//$clstramiteusuario = new clstramiteusuario;
//$clstramiteusuario->setTu_codigo($codigo_tramite);
//$clstramiteusuario->setUsu_eid($usuario);
//$clstramiteusuario->setTra_id($tramite);
//$clstramiteusuario->setTu_fecha_ingreso($fecha_ingreso);
//$clstramiteusuario->setTu_fecha_aprocont($fecha_aprox);
//$clstramiteusuario->setTu_fecha_contcont($fecha_control);
//$clstramiteusuario->setReg_id($regional);
//$clstramiteusuario->setEt_id($estado_tramite);
//$clsusuario = new clsusuarios();
//$asignador=$clsusuario->get_usuario_by_zonal_perfil($regional, ASIGNADOR);
//$asignador= mysqli_fetch_array($asignador);
////echo $asignador["usu_id"];
//$clstramiteusuario->setUsu_iid($asignador["usu_id"]);
//$id_tramite=$clstramiteusuario->tu_insertar();
//$clstramiteusuario->setTu_id($id_tramite);
//if($id_tramite==0){
//    //echo $id_tramite;
//    //exit();
//    redireccionar("../ue_formularios_tramites.php?idt=$tramite&proc=regtra&est=0");
//}else{
//    include("registrar_tramite/_rt_".$tramite.".php"); //AQUI SE INSERTAN LOS PARÁMETROS ESPECÍFICOS DEL TRAMITE
//    //exit();
//    if($band==0){
//        //INACTIVAR TRÁMITE
//        $clstramiteusuario->setTu_estado("INACTIVO");
//        $clstramiteusuario->tu_cambiar_estado();
//        //exit();
//        //REDIRECCIONAR
//      redireccionar("../ue_formularios_tramites.php?idt=$tramite&proc=regtra&est=0");
//    }else{
//        /*REGISTRAR PROCESO EN AUDITORIA*/
//        $clsaud = new clsauditoria();
//        $clsaud->setAud_fechahora_proceso($fecha_ingreso);
//        $clsaud->setAud_objeto("TRAMITE");
//        $clsaud->setAud_proceso("REGISTRO");
//        $clsaud->setTu_id($id_tramite);
//        $clsaud->setUsu_id($usuario);
//        $clsaud->auditoria_insertar();
//        //ENVIAR_EMAILS
//        $ttipot=new cl_tramites();
//        $ttipot->setTra_id($tramite);
//        $tipot=$ttipot->tra_seleccionar_byid();
//        $tipot= mysqli_fetch_array($tipot);
//        $tipo_mensaje="registro_tra";
//        $clsusuario->setUsu_id($_SESSION["codusuario"]);
//        $ddestinatario=$clsusuario->usu_email_byid();
//        $ddestinatario= mysqli_fetch_array($ddestinatario);
//        $destinatario=$ddestinatario["usu_correo"];
//        $dcc=$clsusuario->setUsu_id($asignador["usu_id"]);
//        $dcc=$clsusuario->usu_email_byid();
//        $dcc= mysqli_fetch_array($dcc);
//        $cc=$dcc["usu_correo"];
//        $namecc=$dcc["usu_nombre"]." ".$dcc["usu_apellido"];
//        $mensaje_especifico="<p>Estimad@ <b>".$_SESSION["nombre"]."</b>, haz uso de la siguiente información para el seguimiento de tu trámite:</p>";
//        $mensaje_especifico.="<div class='bloque_especifico'><p><b>Tipo de trámite:</b> ".$tipot["tra_nombre"]."</p>";
//        $mensaje_especifico.="<p><b>CUT:</b> ".$codigo_tramite."</p>";
//        $mensaje_especifico.="<p><b>Fecha de ingreso:</b> ".$fecha_ingreso."</p>";
//        $mensaje_especifico.="<p><b>Fecha estimada de respuesta:</b> ".$fecha_aprox."</p></div>";
//        include_once "enviar_correo.php";
//        //exit();
//        //REDIRECCIONAR
//        //exit();
//        redireccionar("../ue_bandeja_enviados.php?proc=regtra&est=1");
//    }
//}
?>
