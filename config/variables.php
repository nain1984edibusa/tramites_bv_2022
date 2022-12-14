<?php
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
/*VARIABLES GENERALES*/
//define("URL_SIS","http://tramites.patrimoniocultural.gob.ec");
//define("URL_SIS","http://190.152.16.183/");
//define("URL_SIS","http://172.16.1.21/");
define("URL_SIS","http://localhost");
define("DIRSERVIDOR",$_SERVER['DOCUMENT_ROOT']);
define("DIRDOWNLOAD","/tramites_bv");
//define("RUTA_REQUISITOS","/upload/");
//define("RUTA_ANEXOS","/upload/");
define("RUTA_ARCHIVOSTRAMITES","/upload/");
define("LONG_TEXT_BC",50);
define("DIAS_AGENDAS",15);
define("DIAS_COLCHON",2); // BD??? O UN VALOR ESTÁTICO
define("REG_PPAGINA",10);
define("ADJACENTS",4);
/*PERFILES USUARIOS*/
define("ASIGNADOR",3);
define("EJECUTOR",5);
define("APROBADOR",2);
define("CIUDADANO",4);
define("SECRETARIA",8);
/*ESTADOS DEL TRAMITE*/
define("BORRADOR",0);
define("VALIDACION_REQUISITOS",1);
define("ANALISIS_SOLICITUD",2);
define("CONVALIDACIÓN_REQUISITOS1",3);
define("CONVALIDACIÓN_REQUISITOS2",4);
define("CONTESTADO_REVISION",5);
define("CONTESTADO_DESPACHADO",6);
/*REASIGNACION MATRIZ*/
define("MATRIZ",8);
/*TITULOS Y CONTENIDOS MÁS USADOS*/
define("NOMSISTEMA","Trámites ciudadanos");
define("NOMSISCORTO","INPC");
define("BIENVENIDA","Bienvenido al Portal de Trámites en Línea del Instituto Nacional de Patrimonio Cultural.");
define("BIENVENIDAADMIN","Bienvenido al Portal de Trámites en Línea del Instituto Nacional de Patrimonio Cultural. Pagina de Administrador.");
/*RUTAS RÁPIDAS (breadcrumbs)*/
define("RUTA_CATALOGO_TRAMITES","ue_catalogo_tramites.php");
define("RUTA_BANDEJAS_UE","ue_home.php");
define("RUTA_BANDEJAS_UI","ui_home.php");
/*CONEXION BASE DE DATOS*/
define("HOST","localhost");
define("PUERTO","3306");
define("USUARIO","tramitesp");
define("CLAVE","Patrimoni02019");
define("BD","tramites_bv");
define("ACUERDO_RESPONSABILIDAD","<p>El solicitante, declara bajo juramento que se hace responsable de toda la información ingresada, reportada o cargada en el formulario del Sistema de Gestión de Atención a Trámites Ciudadanos del Instituto Nacional de Patrimonio, a través de las credenciales electrónicas de seguridad, siendo su uso y cuidado también de su exclusiva responsabilidad.</p>  
<p>El solicitante asume la responsabilidad total del uso del sistema y sus herramientas con el nombre de usuario y contraseña registrados durante la inscripción en el Sistema de Gestión de Atención a Trámites Ciudadanos del Instituto Nacional de Patrimonio Cultural, así como de los usuarios habilitados por la Entidad.</p> 
<p>En todo momento, el solicitante será responsable de la veracidad, exactitud, consistencia, coherencia y vigencia de la información ingresada y documentos adjuntos en el Sistema de Gestión de Atención a Trámites Ciudadanos del Instituto Nacional de Patrimonio Cultural.</p> 
<p>El solicitante, no podrá ceder o comunicar en ninguna circunstancia su clave y nombre de usuario a terceras personas; y, evitará establecer claves evidentes o simples; por lo tanto, será el responsable de mantener en secreto el número de sus cuentas, contraseñas personales, claves de acceso y números confidenciales con los cuales tenga acceso a los servicios y trámites.</p> 
<p>Toda información institucional incluida la digital y física es de propiedad del Instituto Nacional de Patrimonio Cultural, por lo que el solicitante es consciente que la información que reciba, conozca, acceda, maneje o haga uso, será mantenida y protegida como confidencial, incluyendo información relativa a derechos de autor, investigaciones técnicas, programas, modelos, estrategias, conocimientos técnicos; y, en general toda clase de datos e información institucional que el Instituto Nacional de Patrimonio Cultural utiliza para cumplir con su objeto y funciones.</p> 
<p>El Instituto Nacional de Patrimonio Cultural se libera de responsabilidad total sobre la información ingresada o cargada por el solicitante.</p>  
<p>El solicitante es responsable del correcto uso de la SOLICITUD DE TRÁMITES CIUDADANOS y de la información consignada o cargada sobre la cual declara bajo juramento su veracidad, y conoce plenamente y acepta que, en caso de comprobarse que la información falte de alguna manera a la verdad, el Instituto Nacional de Patrimonio Cultural se reserva el derecho de rechazar la solicitud, sin perjuicio de las acciones judiciales, en los ámbitos civil como penal.</p> 
<p>El Instituto Nacional de Patrimonio cultural, por su parte, declara que la recopilación y uso de datos personales está sujeta a los derechos de privacidad, intimidad y confidencialidad garantizados por la Constitución Política de la República y la Ley de Comercio Electrónico, Firmas z Mensajes de Datos, los cuales podrán ser utilizados o transferidos únicamente con autorización del titular u orden de autoridad competente.</p> 
<p>El solicitante conoce y acepta íntegramente el contenido del presente Acuerdo de Confidencialidad y Responsabilidad, lo cual ratifica a través de “ACEPTAR”, mensaje electrónico que tendrá igual valor jurídico que los documentos escritos, de conformidad a lo señalado en la Ley de Comercio Electrónico, Firmas y Mensajes de Datos.</p>");
date_default_timezone_set('America/Guayaquil');
/*setlocale(LC_TIME, 'es_ES');*/
define("SENDEREMAIL_USER","tramites.ciudadanos@patrimoniocultural.gob.ec");
define("SENDEREMAIL_PASS","Tramites.2020*");
/*ADD1/1*/
define("CONVALIDACION",10);
define("COA",30);
/*add*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
error_reporting(0);
?>


