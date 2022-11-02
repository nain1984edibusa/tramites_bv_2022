<?php

Class clstramite4modoenvio {

    //    definio los campos de la tabla 
    private $me_id;
    private $me_nombre;
    private $me_estado;

    //////////////////////////////   funciones //////////////////////

    public function getMe_id() {
        return $this->me_id;
    }

    public function setMe_id($me_id): void {
        $this->me_id = $me_id;
    }

    public function getMe_nombre() {
        return $this->me_nombre;
    }

    public function getMe_estado() {
        return $this->me_estado;
    }

    public function setMe_nombre($me_nombre): void {
        $this->me_nombre = $me_nombre;
    }

    public function setMe_estado($me_estado): void {
        $this->me_estado = $me_estado;
    }

    //////   seleccionar tipo bien cultural    ///////////////////
    public function modo_envio_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'SELECT * FROM _ct_tramite4_modo_envio ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function modo_envio_seleccionarActivos() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM _ct_tramite4_modo_envio WHERE me_estado = 'ACT'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}

?>