<?php

Class clstramite17DetalleProforma {

    private $dp_id;
    private $tu_id;
    private $ta_id;
    private $ta_cantidad;
    private $ta_concepto;
    private $ta_valor_unitario;
    private $ta_valor_total1;

    public function getDp_id() {
        return $this->dp_id;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function getTa_id() {
        return $this->ta_id;
    }

    public function getTa_cantidad() {
        return $this->ta_cantidad;
    }

    public function getTa_concepto() {
        return $this->ta_concepto;
    }

    public function getTa_valor_unitario() {
        return $this->ta_valor_unitario;
    }

    public function getTa_valor_total() {
        return $this->ta_valor_total;
    }

    public function setDp_id($dp_id): void {
        $this->dp_id = $dp_id;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function setTa_id($ta_id): void {
        $this->ta_id = $ta_id;
    }

    public function setTa_cantidad($ta_cantidad): void {
        $this->ta_cantidad = $ta_cantidad;
    }

    public function setTa_concepto($ta_concepto): void {
        $this->ta_concepto = $ta_concepto;
    }

    public function setTa_valor_unitario($ta_valor_unitario): void {
        $this->ta_valor_unitario = $ta_valor_unitario;
    }

    public function setTa_valor_total($ta_valor_total): void {
        $this->ta_valor_total = $ta_valor_total;
    }

    public function tu_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->getDp_id() . "', "
                . "'" . $this->getTu_id() . "', "
                . "'" . $this->getTa_id() . "', "
                . "'" . $this->getTa_cantidad() . "', "
                . "'" . $this->getTa_concepto() . "', "
                . "'" . $this->getTa_valor_unitario() . "',"
                . "'" . $this->getTa_valor_total() . "'");

        $bd->carga_campos("dp_id, "
                . "tu_id, "
                . "ta_id, "
                . "ta_cantidad, "
                . "ta_concepto, "
                . "ta_valor_unitario, "
                . "ta_valot_total");

        if ($bd->insertar("_ct_tramite17_detalle_proforma")) // insertar
            return $bd->lastID();
        else
            return 0;
        $bd->cerrar();  // cerrar coneccion
    }
}
