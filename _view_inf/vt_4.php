<?php
include_once("./modelo/clstramite4.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu4respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/clstramiteusuarioturno.php");

//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee = new clstramite4();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico = $tramitee->tra_seleccionar_bycodigo();
$tespecifico = mysqli_fetch_array($tespecifico);

//OBTENER DATOS TURNO
$tramiteturno = new clstramiteusuarioturno();
$tramiteturno->setTu_id($tespecifico["tu_id"]);
$tturno = $tramiteturno->tut_turno();
$tturno = mysqli_fetch_array($tturno);

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

$bandera_convalidar = "";
$bandera_convanxres = "";
?>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<tr>
    <td colspan="6">NA</td>        
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
    <th class="text-right"><i class="zmdi zmdi-check"></i> Disponibilidad técnico</th>
    <td><?php echo $tespecifico["te_cumple"]; ?></td>
    <td colspan="3"><?php echo ($tespecifico["te_observaciones"] == "") ? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>" . $tespecifico["te_observaciones"] . "</span>"; ?></td>
    <td>
        <?php if ((($_SESSION["codperfil"] == ASIGNADOR) || ($_SESSION["codperfil"] == EJECUTOR)) && ($ttramite["et_id"] != CONVALIDACIÓN_REQUISITOS1) && ($ttramite["et_id"] != CONVALIDACIÓN_REQUISITOS2) && ($ttramite["tu_band_respuesta"] == 0)): ?>
            <button href="#" class='btn btn-default'  title='Validar Requisito' data-toggle="modal" data-target="#ValidarRequisito" onclick="cargar_datos_vrte('<?php echo $tra_id ?>', '<?php echo $_GET["idtu"]; ?>', '<?php echo $tespecifico["tu_codigo"]; ?>')"><i class="zmdi zmdi-check-all"></i> Disponibilidad de Técnicos</button>
        <?php endif; ?>
    </td>
</tr>

<!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
<!--<tr class="info">
    <th colspan="6">Respuesta</th>	
</tr>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Anexos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>-->
<?php
while ($anexo = mysqli_fetch_array($anexos4)) {
    ?>
    <tr class="<?php echo "tr_" . strtolower($anexo["tua_cumple"]); ?>">
        <td colspan="2">
            <?php if (($anexo["tu_id"] == $tespecifico["tu_id"]) && ($anexo["tua_rutaarchivo"] != NULL)) { ?>
                <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD . $anexo["tua_rutaarchivo"] ?>', 'Requisito', '', '1024', '768', 'true');return false;"><?php echo $anexo["anx_nombre"]; ?></a>
            <?php } else { ?>
                <?php echo $anexo["anx_nombre"]; ?>
            <?php } ?>
        </td>
        <td class="tr_validacion">
            <?php echo ($anexo["tua_cumple"] == "") ? "NO INGRESADO" : $anexo["tua_cumple"]; ?>
        </td>
        <td class="tr_validacion" colspan="2"><?php echo ($anexo["tua_observaciones"] == "") ? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>" . $anexo["tua_observaciones"] . "</span>"; ?></td>
        <td class="tr_validacion">
            <?php if (($_SESSION["codperfil"] == APROBADOR) && ($anexo["tua_rutaarchivo"] != NULL)): ?>
                <button href="#" class='btn btn-default'  title='Validar Anexo' data-toggle="modal" data-target="#ValidarAnexo" onclick="cargar_datos_va('<?php echo $tra_id ?>', '<?php echo $anexo["tua_id"]; ?>', '<?php echo $_GET["idtu"]; ?>', '<?php echo $tespecifico["tu_codigo"]; ?>')"><i class="zmdi zmdi-check-all"></i> Validar Anexo</button>
            <?php endif; ?>
            <?php ?>  
        </td>
    </tr>
<?php }
?>
<?php
$respuesta = mysqli_fetch_array($respuesta4);
?>
<!--<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Respuesta</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<tr class="<?php echo "tr_" . strtolower($respuesta["tuc_cumple"]); ?>">
    <td colspan="2">
        <?php if (($respuesta["tu_id"] == $tespecifico["tu_id"]) && ($respuesta["tuc_rutaarchivo"] != NULL)) { ?>
            <a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD . $respuesta["tuc_rutaarchivo"] ?>', 'Requisito', '', '1024', '768', 'true');return false;"><?php echo "Respuesta"; ?></a>
        <?php } else { ?>
            <?php echo "Respuesta"; ?>
        <?php } ?>
    </td>
    <td class="tr_validacion">
        <?php echo ($respuesta["tuc_cumple"] == "") ? "NO INGRESADO" : $respuesta["tuc_cumple"]; ?>
    </td>
    <td class="tr_validacion" colspan="2"><?php echo ($respuesta["tuc_observaciones"] == "") ? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>" . $respuesta["tuc_observaciones"] . "</span>"; ?></td>
    <td class="tr_validacion">
        <?php if (($_SESSION["codperfil"] == APROBADOR) && ($respuesta["tuc_rutaarchivo"] != NULL)): ?>
            <button href="#" class='btn btn-default'  title='Validar Respuesta' data-toggle="modal" data-target="#ValidarRespuesta" onclick="cargar_datos_vres('<?php echo $tra_id ?>', '<?php echo $respuesta["tuc_id"]; ?>', '<?php echo $_GET["idtu"]; ?>', '<?php echo $tespecifico["tu_codigo"]; ?>')"><i class="zmdi zmdi-check-all"></i> Validar Respuesta</button>
        <?php endif; ?>
        <?php ?>  
    </td>
</tr>-->