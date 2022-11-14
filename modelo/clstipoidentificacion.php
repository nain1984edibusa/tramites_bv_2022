<?php

Class clstipoidentificacion {

    //    definio los campos de la tabla 
    private $ti_id;
    private $ti_nombre;
    private $ti_estado;

    //////////////////////////////   funciones //////////////////////

    public function getTi_id() {
        return $this->ti_id;
    }

    public function getTi_nombre() {
        return $this->ti_nombre;
    }

    public function getTi_estado() {
        return $this->ti_estado;
    }

    public function setTi_id($ti_id): void {
        $this->ti_id = $ti_id;
    }

    public function setTi_nombre($ti_nombre): void {
        $this->ti_nombre = $ti_nombre;
    }

    public function setTi_estado($ti_estado): void {
        $this->ti_estado = $ti_estado;
    }

        //////   seleccionar tipo bien cultural    ///////////////////
    public function tipo_identificacion_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'SELECT * FROM ct_tipo_identificacion ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
}

?>