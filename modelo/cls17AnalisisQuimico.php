<?php

Class cls17AnalisisQuimico {

    //    definio los campos de la tabla 
    private $aq_id;
    private $tu_id;
    private $ta_id;

    //////////////////////////////   funciones //////////////////////

    public function getAq_id() {
        return $this->aq_id;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function getTa_id() {
        return $this->ta_id;
    }

    public function setAq_id($aq_id): void {
        $this->aq_id = $aq_id;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function setTa_id($ta_id): void {
        $this->ta_id = $ta_id;
    }

    ////////   insertar analisis quimico   //////////////////
    public function analisisQuimicoInsertar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $this->setAq_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
        $bd->carga_valores($this->tu_id . ",'" . $this->ta_id . "'"); // valores a insertae
        $bd->carga_campos("tu_id,ta_id"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite17_analisis_quimico")) // insertar
            return 1;  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function analisisQuimicoPorTramite() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select aq.ta_id, ta.ta_concepto FROM _ct_tramite17_analisis_quimico aq INNER JOIN _ct_tramite17_tipo_analisis ta ON aq.ta_id = ta.ta_id WHERE tu_id = " . $this->tu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

//
}

?>