<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite4.php");
include_once("./modelo/clsturequisitos.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu4respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/clsTramiteUsuarioTurno.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee = new clstramite4();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico = $tramitee->tra_seleccionar_bycodigo();
$tespecifico = mysqli_fetch_array($tespecifico);

//OBTENER DATOS TURNO
$tramiteturno = new clsTramiteUsuarioTurno();
$tramiteturno->setTu_id($tespecifico["tu_id"]);
$tturno = $tramiteturno->tut_turno();
$tturno = mysqli_fetch_array($tturno);

//OBTENER REQUISITOS
$requisitose = new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos8 = $requisitose->tur_seleccionar_byte();
//OBTENER ANEXOS
$anexose = new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos4 = $anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae = new clstu4respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta4 = $respuestae->obtener_tramiterespuestas();

//s$bandera_convalidar="";
?>
<table class="table">
    <tr class="info">
        <th colspan="6">Detalles del Trámite</th>	
    </tr>
    <tr class="row-light">
        <th colspan='6'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    </tr>
    <tr>
         <td colspan="6">NA</td>      
       <!--  <td colspan="6" class="col-xs-12 col-sm-12 col-md-12 text-justify lead alert alert-success">            
           <p> <h5> <b>Los objetos/bienes culturales motivo de la inspección, deberán ser llevados al lugar agendado en la 
                    cita pre-embalado (sin sellar los contenedores), el técnico del INPC realizará una revisión física y 
                    colocará cintas y sellos de seguridad sobre los contenedores (cajas, tubos, maletas, entre otros). 
            </b></h5></p>
            <p> <h5> <b>La información ingresada en la solicitud relacionada con el detalle de los objetos/bienes culturales 
                    está sujeta a verificación y podrá ser modificada por el técnico designado para el trámite si esta 
                    tuviere algún error. 
            </b></h5></p>
        </td> --> 
    </tr>
    <tr class="row-light">
        <th colspan='6'><i class="zmdi zmdi-assignment-o"></i> Datos destino</th>
    </tr>

    <tr>
        <th class="text-right">País:</th><td colspan="3"><?php echo $tespecifico["pai_nombre"] ?></td>
        <th class="text-right">Ciudad:</th><td><?php echo $tespecifico["te_ciudad_envio"] ?></td>
    </tr>
    <tr>
        <th class="text-right">Dirección:</th><td colspan="3"><?php echo $tespecifico["te_direccion_envio"] ?></td>
        <th class="text-right">Fecha envió:</th><td><?php echo $tespecifico["te_fecha_envio"] ?></td>
    </tr>
    <tr class="row-light">
        <th colspan='6'><i class="zmdi zmdi-assignment-o"></i> Lugar, fecha y hora de la cita</th>
    </tr>
    <tr>
        <th class="text-right">Lugar:</th><td colspan="3"><?php echo $tturno["reg_ciudad"] ?></td>
    </tr>
    <tr>
        <th class="text-right">Fecha:</th><td colspan="3"><?php echo $tturno["tut_fecha"] ?></td>
        <th class="text-right">Hora:</th><td><?php echo $tturno["ho_hora"] ?></td>
    </tr>
    <tr class="tr_validacion <?php echo "tr_" . strtolower($tespecifico["te_cumple"]); ?>">
        <th class="text-right"><i class="zmdi zmdi-check"></i> Validación</th>
        <td><?php echo $tespecifico["te_cumple"]; ?></td>
        <td colspan="4"><?php echo ($tespecifico["te_observaciones"] == "") ? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>" . $tespecifico["te_observaciones"] . "</span>"; ?></td>
    </tr>
    <!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
    <?php if (($_SESSION["codperfil"] == CIUDADANO && $ttramite["et_id"] == CONTESTADO_DESPACHADO) || ($_SESSION["codperfil"] != CIUDADANO)) { ?>
        <tr class="info">
            <th colspan="6">Respuesta</th>	
        </tr>
        <tr>
            <td colspan="4" style="padding:0px">
                <table class="table">
                    <tr class="row-light">
                        <th colspan='3'><i class="zmdi zmdi-collection-item"></i> Anexos</th>
                    </tr>
                    <?php
                    while ($anexo = mysqli_fetch_array($anexos8)) {
                        ?>
                        <tr>
                            <td><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD . $anexo["tua_rutaarchivo"] ?>', 'Requisito', '', '1024', '768', 'true');return false;"><?php echo $anexo["anx_nombre"]; ?></a></td>
                            <td><?php echo $anexo["tua_codigoe"] ?></td>
                            <td><a href="<?php echo DIRDOWNLOAD . $anexo["tua_rutaarchivo"] ?>" download="<?php echo $anexo["anx_nombre"] . $tra_codigo ?>"><i class="zmdi zmdi-download"></i>&nbsp;&nbsp;Descargar Archivo</a></td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </td>

            <td colspan="2" style="padding:0px">
                <table class="table">
                    <?php
                    $respuesta = mysqli_fetch_array($respuesta4);
                    ?>
                    <tr class="row-light">
                        <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Respuesta</th>
                    </tr>
                    <tr>
                        <td><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD . $respuesta["tuc_rutaarchivo"] ?>', 'Requisito', '', '1024', '768', 'true');return false;"><?php echo "Respuesta"; ?></a></td>
                        <td><a href="<?php echo DIRDOWNLOAD . $respuesta["tuc_rutaarchivo"] ?>" download="<?php echo "respuesta" . $tra_codigo ?>"><i class="zmdi zmdi-download"></i>&nbsp;&nbsp;Descargar Archivo</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    <?php } ?>
</table>

