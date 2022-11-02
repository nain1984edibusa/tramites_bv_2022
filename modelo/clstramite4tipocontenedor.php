<?php

Class clstramite4tipocontenedor {

    //    definio los campos de la tabla 
    private $tc_id;
    private $tc_nombre;
    private $tc_estado;

    //////////////////////////////   funciones //////////////////////

    public function getTc_id() {
        return $this->tc_id;
    }

    public function setTc_id($tc_id): void {
        $this->tc_id = $tc_id;
    }

    public function getTc_nombre() {
        return $this->tc_nombre;
    }

    public function getTc_estado() {
        return $this->tc_estado;
    }

    public function setTc_nombre($tc_nombre): void {
        $this->tc_nombre = $tc_nombre;
    }

    public function setTc_estado($tc_estado): void {
        $this->tc_estado = $tc_estado;
    }

    //////   seleccionar tipo bien cultural    ///////////////////
    public function tipoContenedorSeleccionarTodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'SELECT * FROM _ct_tramite4_tipo_contenedor ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function tc_seleccionarActivos() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM _ct_tramite4_tipo_contenedor WHERE tc_estado = 'ACT'";
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }
}

?>