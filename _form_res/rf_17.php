<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("./modelo/cls17AnalisisQuimico.php");
include_once("./modelo/clsTipoAnalisis.php");

$analisisQuimico = new cls17AnalisisQuimico();
$analisisQuimico->setTu_id($tespecifico["tu_id"]);
$analisisQuimico17 = $analisisQuimico->analisisQuimicoPorTramite();

$tipoAnalisis = new clsTipoAnalisis();
$catalogoTipoAnalisis = $tipoAnalisis->tipoAnalisisSeleccionarTodo();
?>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="group-material">
        <span>Marco Legal <span class="sp-requerido">*</span></span>
        <?php
        $marco_legal = "";
        if (isset($trespuesta)) {
            $marco_legal = $trespuesta["tuc_marcolegal"];
        }
        ?>
        <textarea id="marcolegal" name="marcolegal" rows="4" class="tooltips-general material-control" placeholder="" required="" data-toggle="tooltip" data-placement="top" title="Escriba el marco legal"><?php echo str_replace('<br />', '\n', $marco_legal); ?></textarea>

        <table class="table table-bordered">
            <thead class="btn-primary">
                <tr>
                    <th>Seleccionado</th>
                    <th>Ensayo/Parámetro</th>
                    <th>Nro. Items <br/> de ensayo</th>
                    <th>Precio por <br/>ítem de ensayo US$</th>
                    <th>Total <br/> a Pagar</th>
                </tr>
            </thead>
            <tbody style="background-color:#fff;">
                <?php foreach ($catalogoTipoAnalisis as $dato): ?>

                    <tr>

                        <td><input type="checkbox" name="asistencia[]" value="<?php echo $dato["id"] ?>"></td>
                        <td><?php echo $dato["ta_concepto"] ?></td>
                        <td><input type="number" name="numero_items" id="numero_items" value="<?php echo $dato["id"] ?>"></td>
                        <!--<input id="cantidad" name="cantidad" type="number" class="tooltips-general material-control" placeholder="Por ejemplo: 10" required="" maxlength="70" data-toggle="tooltip" data-placement="top"  onKeyUp="this.value = this.value.toUpperCase();">title="Escriba su número de identificación"-->
                        <td><?php echo $dato["ta_costo"] ?></td>
                        <!--<td><?php echo $dato["ta_total_a_pagar"] ?></td>-->
                        <td><input type="number" name="ta_total_a_pagar" id="ta_total_a_pagar" value="<?php echo $dato["id"] ?>"></td>

                    </tr>

                <?php endforeach ?>  
            </tbody>
        </table>
    </div>
</div>



