<?php 
/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
$modulo="Administracion";
$opcion="Fechas / Feriados";
include_once("./config/variables.php");
include_once("./includes/header.php");
include_once("./includes/navbar.php");
include_once("./includes/top.php");
include_once './modelo/clsferiados.php';

$objFeriado = new clsferiado();
$totalFeriados = mysqli_num_rows($objFeriado->fer_seleccionartodo());
$feriados = $objFeriado->fer_seleccionartodo();

//$listado_feriados = mysqli_fetch_array($objFeriado);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-justify lead">
            Administracion de <strong> Fechas</strong>.
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li><a href="<?php echo RUTA_BANDEJAS_UI;?>">Inicio</a></li>
                <li class="active"><?php echo $modulo?></li>
                <li class="active"><?php echo $opcion?></li>
            </ol>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php include_once './includes/errores.php'; ?>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 lead">
            <ol class="breadcrumb">
                <li>Nuevo Registro</li>
                <a href="ui_registro_feriado.php" class='btn btn-default' title='Nuevo Feriado'><i class="zmdi zmdi-collection-plus"></i></a>
                
            </ol>
        </div>
    </div>
</div>

<div class="outer_div">			
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="info">
                    <th style="width: 5%">Cod.</th>
                    <th style="width: 30%">Nombre</th>                    
                    <th style="width: 20%">Tipo</th>
                    <th style="width: 10%">Regional</th>
                    <th style="width: 15%">Conmemoración </th>
                    <th style="width: 30%;" class="text-right">Acciones</th>	
                </tr>
            </thead>
            <tbody>
                <?php if($totalFeriados!=0){?>
                    <?php while($feriado = mysqli_fetch_array($feriados)): 
                        
                        ?>
                        <tr>
                            
                            <td><?php echo $feriado["fer_id"]?></td>
                            <td><?php echo $feriado["fer_nombre"]?></td>
                            <td><?php echo $feriado["fer_tipo"]?></td>
                            <td><?php if ($feriado["reg_id"] != 8) echo "Zona " .$feriado["reg_id"]; else echo "MATRIZ" ?></td>
                            <td><?php echo $feriado["fer_fecha_dia"]. " / ". $feriado["fer_fecha_mes"]?></td>
                            <td class="text-right">
                                <a href="ui_visualizacion_feriado.php?id_fer=<?php echo $feriado["fer_id"]?>&descFeriado=<?php echo $feriado["fer_nombre"]?>&fechaDia=<?php echo $feriado["fer_fecha_dia"]?>&fechaMes=<?php echo $feriado["fer_fecha_mes"]?>&tipoFeriado=<?php echo $feriado["fer_tipo"]?>&feriadoRegional=<?php echo $feriado["reg_id"]?>" class='btn btn-default' title='Ver Detalle'><i class="zmdi zmdi-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target= "#eliminaFeriado" class='btn btn-default' title='Eliminar'><i class="zmdi zmdi-delete"></i></a>
                                
                                <!--<a href="#" class='btn btn-default' title='Ver Requisitos' data-toggle="modal" data-target="#InformacionRequisitos"><i class="zmdi zmdi-file-text"></i></a>-->
                       
                            </td>
                        </tr>
                    <?php endwhile;
                }else{
                    echo "<tr><td colspan='6'>Ningún registro en el sistema</td></tr>";
                }
                ?>
            </tbody>
        </table>       
    </div>
</div>

<?php 
include_once("./includes/footer.php"); 
include_once('./modal/auditoria.php'); 
include_once('./modal/reasignar_tramite.php'); 
include_once('./modal/convalidar_tramite.php'); 
?>
<script type="text/javascript" src="js/_ui_bandeja_recibidos.js"></script>
<script type="text/javascript" src="js/funciones_generales.js"></script>
