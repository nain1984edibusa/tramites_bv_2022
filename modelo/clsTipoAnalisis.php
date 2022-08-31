<?php

Class clsTipoAnalisis {

    //    definio los campos de la tabla 
    private $ta_id;
    private $ta_concepto;
    private $ta_estado;
    private $ta_costo;
    private $ta_seleccionado;
    private $ta_numero_ensayos;
    private $ta_total_a_pagar;

    //////////////////////////////   funciones //////////////////////

    public function getTa_id() {
        return $this->ta_id;
    }

    public function getTa_concepto() {
        return $this->ta_concepto;
    }

    public function getTa_estado() {
        return $this->ta_estado;
    }

    public function getTa_costo() {
        return $this->ta_costo;
    }

    public function setTa_id($ta_id): void {
        $this->ta_id = $ta_id;
    }

    public function setTa_concepto($ta_concepto): void {
        $this->ta_concepto = $ta_concepto;
    }

    public function setTa_estado($ta_estado): void {
        $this->ta_estado = $ta_estado;
    }

    public function setTa_costo($ta_costo): void {
        $this->ta_costo = $ta_costo;
    }

    public function getTa_seleccionado() {
        return $this->ta_seleccionado;
    }

    public function getTa_numero_ensayos() {
        return $this->ta_numero_ensayos;
    }

    public function setTa_seleccionado($ta_seleccionado): void {
        $this->ta_seleccionado = $ta_seleccionado;
    }

    public function setTa_numero_ensayos($ta_numero_ensayos): void {
        $this->ta_numero_ensayos = $ta_numero_ensayos;
    }

    public function getTa_total_a_pagar() {
        return $this->ta_total_a_pagar;
    }

    public function setTa_total_a_pagar($ta_total_a_pagar): void {
        $this->ta_total_a_pagar = $ta_total_a_pagar;
    }

    //////   seleccionar tipo bien cultural    ///////////////////
    public function tipoAnalisisSeleccionarTodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select ta_id, ta_concepto, ta_costo FROM _ct_tramite17_tipo_analisis';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function tipoAnalisisPorId($item_seleccionado) {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
//        $sql = "select ta_id, ta_concepto, ta_costo FROM _ct_tramite17_tipo_analisis WHERE ta_id='" . $item_seleccionado . "' ";
         $sql = "select ta_id, ta_concepto, ta_costo FROM _ct_tramite17_tipo_analisis WHERE ta_id='" . $item_seleccionado . "'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    /////////////////////////////    fin de provicnias      ///////////////////////
}

?>