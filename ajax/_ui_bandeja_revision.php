<?php
/*
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */

/* incluir modelo(s) */
session_start();
include_once("../config/variables.php");
include_once("../modelo/Config.class.php");
include_once("../modelo/Db.class.php");
include_once("../modelo/clstramiteusuario.php");
include_once("../includes/functions.php");
/* Listado de todos los trámites ordenados por el campo ct_orden */
$listado_tramites_br = new clstramiteusuario();
$estado = array(ANALISIS_SOLICITUD, CONTESTADO_REVISION);
//CONDICIONES DE BÚSQUEDA
$aColumns = array('ct_tramite_usuario.tu_codigo');
$sWhere = "";
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    if ($_GET['q'] != "") {
        $q = $_GET['q'];
        $sWhere = "and (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
}
/* variables_paginacion */
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$offset = ($page - 1) * REG_PPAGINA;
$count_query = $listado_tramites_br->tra_contar_all_byusu_ve($_SESSION["codusuario"], $estado, $_SESSION["codperfil"], $sWhere); // total registros
$row = mysqli_fetch_array($count_query);
$numrows = $row['total'];
$total_pages = ceil($numrows / REG_PPAGINA);
$reload = "/ue_bandeja_enviados.php";
$tramites = $listado_tramites_br->tra_seleccionar_all_byusu_ve($_SESSION["codusuario"], $estado, $_SESSION["codperfil"], $offset, REG_PPAGINA, $sWhere);
?>
<div class="outer_div">			
    <div class="table-responsive">
        <table class="table table-hover">
            <thead <?php
            if ($sWhere != "") {
                echo "class='tr_filtro'";
            }
            ?>>
                <tr class="info">
                    <th style="width: 5%">Cod</th>
                    <th style="width: 45%">Trámite</th>
                    <th style="width: 10%">Fecha de <br> Ingreso</th>
                    <th style="width: 10%">Fecha Máxima <br> de Trámite</th>
                    <th style="width: 5%">Días <br> restantes</th>
                    <th style="width: 25%;" class="text-right">Acciones</th>	
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($tramites) != 0) { ?>
                    <?php
                    while ($row = mysqli_fetch_array($tramites)):
                        $hoy = date("Y-m-d");
                        $clase = "";
                        //echo $row["TU_CODIGO"]." ".strtotime($hoy)." ".strtotime(substr($row["TU_FECHA_CONTCONT"],0,10))." ".strtotime(substr($row["TU_FECHA_APROCONT"],0,10))."</br>";
                        if (strtotime($hoy) <= strtotime(substr($row["tu_fecha_contcont"], 0, 10))) { //SI LA FECHA DE HOY ES MENOR O IGUAL A LA DE CONTROL, ESTAMOS EN VERDE
                            $clase = "";
                        } elseif ((strtotime($hoy) > strtotime(substr($row["tu_fecha_contcont"], 0, 10))) && (strtotime($hoy) <= strtotime(substr($row["tu_fecha_aprocont"], 0, 10)))) {//SI LA FECHA DE HOY ES MAYOR A LA DE CONTROL PERO MENOR O IGUAL A LA DE APROX_CONTESTACION ESTAMOS EN AMARILLO
                            $clase = ' class="warning"';
                        } elseif (strtotime($hoy) > strtotime(substr($row["tu_fecha_aprocont"], 0, 10))) {//SI LA FECHA DE HOY ES MAYOR A LA DE APROX_CONTESTACION ESTAMOS EN ROJO
                            $clase = ' class="danger"';
                        }
                        ?>
                        <tr <?php echo $clase; ?>>
                            <td><a href="#" onclick="obtener_auditoria(<?php echo $row["tu_id"] ?>)" data-toggle="modal" data-target="#AuditoriaTramite"><span class="small"><?php echo $row["tu_codigo"] ?></span></a></td>
                            <td><?php echo $row["tra_nombre"] ?></td>
                            <td><?php echo $row["tu_fecha_ingreso"] ?></td>
                            <td><?php echo $row["tu_fecha_aprocont"] ?><br/><?php
                                if ($row["tu_fecha_concoa"] != NULL) {
                                    if (diferencia_fechas($hoy, $row["tu_fecha_concoa"]) < 14) {
                                        echo '<span class="small label label-warning" title="Fecha máxima de contestación del trámite, según el COA">COA: ' . $row["tu_fecha_concoa"] . '</span>';
                                    }
                                };
                                ?></td>
                            <td><?php echo diferencia_fechas($hoy, substr($row["tu_fecha_aprocont"], 0, 10)); ?></td>
                            <td class="text-right">
                                <!--<a href="#" class='btn btn-default' title='Ver Requisitos' onclick="reimprimir('');"><i class="zmdi zmdi-file-text"></i></a>-->
                                <a href="ui_visualizacion_tramite.php?idtu=<?php echo $row["tu_id"] ?>" class='btn btn-default' title='Ver Detalle'><i class="zmdi zmdi-file-text"></i></a>
                                <?php if ($_SESSION["codperfil"] == EJECUTOR): ?>
                                    <?php
                                    switch ($row["tu_band_convalidar"]) {
                                        case 1:
                                            ?>
                                            <a href="#" data-toggle="modal" data-target="#ConvalidarTramite" class='btn btn-default' title='Convalidar' onclick="convalidar_tramite('<?php echo $row["tu_id"] ?>', '<?php echo $row["tu_codigo"] ?>', '<?php echo $row["tra_id"] ?>', '<?php echo $row["reg_id"] ?>');"><i class="zmdi zmdi-rotate-ccw"></i></a>
                                            <i class="zmdi zmdi-attachment-alt btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <?php
                                            break;
                                        case 0:
                                            ?>
                                            <?php if ($row["tu_band_respuesta"] == 0) { ?>
                                                <i class="zmdi zmdi-rotate-ccw btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                                <a href="ui_respuestas_tramites_ajax.php?idt=<?php echo $row["tra_id"] ?>&idtu=<?php echo $row["tu_id"] ?>" class='btn btn-default' title='Añadir respuesta prueba'><i class="zmdi zmdi-attachment-alt"></i></a>
                                                <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <?php } else { /* EXISTE RESPUESTA, PERO SE DEBE VERIFICAR QUE NO EXISTA CONVALIDACIÓN DEL APROBADOR = 1 */ ?>
                                                <i class="zmdi zmdi-rotate-ccw btn btn-default btn-desactivado" title="Acción no permitida"></i> 
                                                <a href="ui_respuestas_tramites_ajax.php?idt=<?php echo $row["tra_id"] ?>&idtu=<?php echo $row["tu_id"] ?>" class='btn btn-default' title='Añadir respuesta prueba'><i class="zmdi zmdi-attachment-alt"></i></a>
                                                <?php if ($row["tu_band_convanxres"] == 1) { ?>
                                                    <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                                <?php } else { ?>
                                                    <!--<a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Firmar y Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>', '<?php echo $row["tu_id"] ?>', '<?php echo $row["tu_codigo"] ?>', '<?php echo $row["reg_id"] ?>', '<?php echo $row["tra_respuesta"] ?>', '<?php echo $row["tra_id"] ?>', '1');"><i class="zmdi zmdi-border-color"></i></a>-->
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            break;
                                    }
                                    ?>
                                <?php endif; ?>
                                <?php if ($_SESSION["codperfil"] == APROBADOR): ?>
                                    <?php
                                    switch ($row["tu_band_convanxres"]) {
                                        case -1:
                                            ?>
                                            <i class="zmdi zmdi-swap btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <?php
                                            break;
                                        case 0:
                                            ?>
                                            <i class="zmdi zmdi-swap btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Firmar y Contestar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>', '<?php echo $row["tu_id"] ?>', '<?php echo $row["tu_codigo"] ?>', '<?php echo $row["reg_id"] ?>', '<?php echo $row["tra_respuesta"] ?>', '<?php echo $row["tra_id"] ?>', '2');"><i class="zmdi zmdi-border-color"></i></a>
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>', '<?php echo $row["tu_id"] ?>', '<?php echo $row["tu_codigo"] ?>', '<?php echo $row["reg_id"] ?>', '<?php echo $row["tra_respuesta"] ?>', '<?php echo $row["tra_id"] ?>');"><i class="zmdi zmdi-swap"></i></a>
                                            <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                            <?php
                                            break;
                                    }
                                    ?>
                                <?php endif; ?>
                                <?php /* if(($row["tu_band_respuesta"]==0)||(($row["tu_band_respuesta"]==1)&&($row["tu_band_convanxres"]==1))){ ?>
                                  <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $row["tu_id"]?>','<?php echo $row["tu_codigo"]?>','<?php echo $row["reg_id"]?>','<?php echo $row["tra_respuesta"]?>','<?php echo $row["tra_id"]?>');"><i class="zmdi zmdi-swap"></i></a>
                                  <?php }else{
                                  ?>
                                  <i class="zmdi zmdi-swap btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                  <?php
                                  }
                                  ?>
                                  <?php if ($_SESSION["codperfil"]==EJECUTOR):?>
                                  <a href="ui_respuestas_tramites.php?idt=<?php echo $row["tra_id"]?>&idtu=<?php echo $row["tu_id"]?>" class='btn btn-default' title='Añadir respuesta'><i class="zmdi zmdi-attachment-alt"></i></a>
                                  <?php switch($row["tu_band_respuesta"]){
                                  case 0: ?>
                                  <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                  <?php
                                  break;
                                  case 1: ?>
                                  <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Firmar y Reasignar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $row["tu_id"]?>','<?php echo $row["tu_codigo"]?>','<?php echo $row["reg_id"]?>','<?php echo $row["tra_respuesta"]?>','<?php echo $row["tra_id"]?>','1');"><i class="zmdi zmdi-border-color"></i></a>
                                  <?php
                                  break;
                                  }
                                  ?>
                                  <?php endif;?>
                                  <?php if ($_SESSION["codperfil"]==APROBADOR):
                                  if(($row["tu_band_respuesta"]==0)||(($row["tu_band_respuesta"]==1)&&($row["tu_band_convanxres"]==1))){
                                  ?>
                                  <i class="zmdi zmdi-border-color btn btn-default btn-desactivado" title="Acción no permitida"></i>
                                  <?php
                                  }else{
                                  ?>
                                  <a href="#" data-toggle="modal" data-target="#ReasignarTramite" class='btn btn-default' title='Firmar y Contestar' onclick="reasignar_tramite('<?php echo $_SESSION["codperfil"] ?>','<?php echo $row["tu_id"]?>','<?php echo $row["tu_codigo"]?>','<?php echo $row["reg_id"]?>','<?php echo $row["tra_respuesta"]?>','<?php echo $row["tra_id"]?>','2');"><i class="zmdi zmdi-border-color"></i></a>
                                  <?php  }
                                  endif; */ ?>
                            </td>
                        </tr>
                        <?php
                    endwhile;
                } else {
                    echo "<tr><td colspan='6'>Ningún registro en el sistema</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php include_once("../includes/paginador.php"); ?>
    </div>
</div>