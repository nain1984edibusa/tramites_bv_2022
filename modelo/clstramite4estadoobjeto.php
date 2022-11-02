<?php

Class clstramite4estadoobjeto {

//    definio los campos de la tabla 
    private $eob_id;
    private $eob_nombre;
    private $eob_estado;

//////////////////////////////   funciones //////////////////////

    public function getEob_id() {
        return $this->eob_id;
    }

    public function getEob_nombre() {
        return $this->eob_nombre;
    }

    public function getEob_estado() {
        return $this->eob_estado;
    }

    public function setEob_id($eob_id): void {
        $this->eob_id = $eob_id;
    }

    public function setEob_nombre($eob_nombre): void {
        $this->eob_nombre = $eob_nombre;
    }

    public function setEob_estado($eob_estado): void {
        $this->eob_estado = $eob_estado;
    }

    //////   seleccionar tipo bien cultural    ///////////////////
    public function eo_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = new Db;
        $sql = "select * FROM _ct_tramite4_estado_objeto";
        $rsprv = $bd->ejecutar($sql);
//        $bd->cerrar();
        return $rsprv;
    }

}

?>