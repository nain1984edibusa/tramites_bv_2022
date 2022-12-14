<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
include_once("./modelo/clstramite17.php");
include_once("./modelo/clsturequisitos.php");
include_once("./modelo/clstramiterespuestas.php");
include_once("./modelo/clstu17respuestas.php");
include_once("./modelo/clstuanexos.php");
include_once("./modelo/cls17AnalisisQuimico.php");
//OBTENER CAMPOS ESPECÍFICOS DEL TRÁMITE
$tramitee = new clstramite17();
$tramitee->setTu_codigo($tra_codigo);
$tespecifico = $tramitee->tra_seleccionar_bycodigo();
$tespecifico = mysqli_fetch_array($tespecifico);

//OBTENER PEDIDO DE ANALISIS
$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();

//OBTENER REQUISITOS
$requisitose = new clsturequisitos();
$requisitose->setTu_id($tespecifico["tu_id"]);
$requisitose->setTra_id($tra_id);
$requisitos17 = $requisitose->tur_seleccionar_byte();
//OBTENER ANEXOS
$anexose = new clstuanexos();
$anexose->setTu_id($tespecifico["tu_id"]);
$anexose->setTra_id($tra_id);
$anexos17 = $anexose->tua_seleccionar_byte();
//OBTENER RESPUESTA
$respuestae = new clstu17respuestas();
$respuestae->setTu_id($tespecifico["tu_id"]);
$respuestae->setTra_id($tra_id);
$respuesta17 = $respuestae->obtener_tramiterespuestas();

$bandera_convalidar = "";
$bandera_convanxres = "";
?>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Requisitos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<?php while ($requisito = mysqli_fetch_array($requisitos17)) { ?>
    <tr class="<?php echo "tr_" . strtolower($requisito["tur_cumple"]); ?>">
        <td colspan="2"><a href="" onclick="VentanaCentrada('<?php echo DIRDOWNLOAD . $requisito["tur_rutaarchivo"] ?>', 'Requisito', '', '1024', '768', 'true');return false;"><?php echo $requisito["req_nombre"] ?></a> <a href="<?php echo DIRDOWNLOAD . $requisito["req_rutaformato"] ?>" target="_blank"><i class="zmdi zmdi-info-outline"></i></a></td>
        <td class="tr_validacion"><?php echo $requisito["tur_cumple"]; ?></td>
        <td class="tr_validacion" colspan="2"><?php echo ($requisito["tur_observaciones"] == "") ? "<span>Sin observaciones</span>" : "<span class='sp-requerido'>" . $requisito["tur_observaciones"] . "</span>"; ?></td>
        <td class="tr_validacion">
            <?php if ((($_SESSION["codperfil"] == ASIGNADOR) || ($_SESSION["codperfil"] == EJECUTOR)) && ($ttramite["et_id"] != CONVALIDACIÓN_REQUISITOS1) && ($ttramite["et_id"] != CONVALIDACIÓN_REQUISITOS2) && ($ttramite["tu_band_respuesta"] == 0)): ?>
                <button href="#" class='btn btn-default'  title='Validar Requisito' data-toggle="modal" data-target="#ValidarRequisito" onclick="cargar_datos_vr('<?php echo $tra_id ?>', '<?php echo $requisito["tur_id"]; ?>', '<?php echo $_GET["idtu"]; ?>', '<?php echo $tespecifico["tu_codigo"]; ?>')"><i class="zmdi zmdi-check-all"></i> Validar Requisito</button>
            <?php endif; ?>
            <?php /* if(($_SESSION["codperfil"]==CIUDADANO)&&($requisito["tur_cumple"]=="INCORRECTO")):?>
              <button href="#" class='btn btn-default'  title='Convalidar Requisito' data-toggle="modal" data-target="#ConvalidarRequisito" onclick="cargar_datos_vr('<?php echo $tra_id ?>','<?php echo $requisito["tur_id"];?>','<?php echo $_GET["idtu"];?>','<?php echo $tespecifico["tu_codigo"];?>')"><i class="zmdi zmdi-check-all"></i> Convalidar Requisito</button>
              <?php endif; */ ?>  
        </td>
        <?php
        if ($requisito["tur_cumple"] == "INCORRECTO") {
            $bandera_convalidar .= "0/";
        } else {
            $bandera_convalidar .= "1/";
        }
        ?>
    </tr>
<?php } ?>

<!--SI EL ESTADO DEL TRAMITE ES 5 NO PERMITIR QUE VE AL CIUDADANO, Y MOSTRARLE EN UN FORMATO SIN VALIDACIÓN-->
<tr class="info">
    <th colspan="12">Análisis químico solicitado</th>
</tr>
<tr>
    <?php
    $rstra = $analisisQuimico17;
    while ($row = mysqli_fetch_array($analisisQuimico17)) {
        ?>
    <tr>
        <!--<td><?php echo $row[0] ?></td>-->
        <td><?php echo $row[1] ?></td>
    </tr>
<?php } //fin while  ?> 

</tr>
<tr class="info">
    <th colspan="6">Respuesta</th>	
</tr>
<tr class="row-light">
    <th colspan='2'><i class="zmdi zmdi-collection-item"></i> Anexos</th>
    <th colspan='4'><i class="zmdi zmdi-check"></i> Validación</th>
</tr>
<?php
while ($anexo = mysqli_fetch_array($anexos17)) {
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
    <?php
    if ($requisito["tua_cumple"] == "INCORRECTO") {
        $bandera_convanxres .= "0/";
    } else {
        $bandera_convanxres .= "1/";
    }
    ?>
<?php }
?>
<?php
$respuesta = mysqli_fetch_array($respuesta17);
?>
<tr class="row-light">
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

</tr>
<?php
if ($requisito["tuc_cumple"] != "CORRECTO") {
    $bandera_convanxres .= "0";
} else {
    $bandera_convanxres .= "1";
}
?>
























