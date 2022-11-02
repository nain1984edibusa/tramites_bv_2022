<?php

Class clstipobiencultural {

    //    definio los campos de la tabla 
    private $tbc_id;
    private $tbc_nombre;
    private $tbc_estado;

    //////////////////////////////   funciones //////////////////////
    public function getTbc_id() {
        return $this->tbc_id;
    }

    public function getTbc_nombre() {
        return $this->tbc_nombre;
    }

    public function getTbc_estado() {
        return $this->tbc_estado;
    }

    public function setTbc_id($tbc_id): void {
        $this->tbc_id = $tbc_id;
    }

    public function setTbc_nombre($tbc_nombre): void {
        $this->tbc_nombre = $tbc_nombre;
    }

    public function setTbc_estado($tbc_estado): void {
        $this->tbc_estado = $tbc_estado;
    }

    //////   seleccionar tipo bien cultural    ///////////////////
    public function tbc_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = new Db();
        $sql = 'select tbc_id, tbc_nombre FROM _ct_tramite4_tipo_bien_cultural ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function tbc_seleccionaractivos() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM _ct_tramite4_tipo_bien_cultural WHERE tbc_estado = 'ACT'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function tbc_seleccionarPorId($item_seleccionado) {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
//        $sql = "select ta_id, ta_concepto, ta_costo FROM _ct_tramite17_tipo_analisis WHERE ta_id='" . $item_seleccionado . "' ";
        $sql = "select tbc_id, tbc_nombre FROM _ct_tramite4_tipo_bien_cultural WHERE tbc_id='" . $item_seleccionado . "'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}

?>