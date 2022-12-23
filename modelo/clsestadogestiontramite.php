<?php

Class clsestadogestiontramite {
    //    definio los campos de la tabla 
    private $egt_id;
    private $egt_nombre;
    private $egt_estado;

    //////////////////////////////   funciones //////////////////////
    public function getEgt_id() {
        return $this->egt_id;
    }

    public function getEgt_nombre() {
        return $this->egt_nombre;
    }

    public function getEgt_estado() {
        return $this->egt_estado;
    }

    public function setEgt_id($egt_id): void {
        $this->egt_id = $egt_id;
    }

    public function setEgt_nombre($egt_nombre): void {
        $this->egt_nombre = $egt_nombre;
    }

    public function setEgt_estado($egt_estado): void {
        $this->egt_estado = $egt_estado;
    }

    //////////////////////////////   metodos //////////////////////
    //selecionar tramites
    public function egt_cargar_estados() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = " select ct_estado_gestion_tramite.* FROM ct_estado_gestion_tramite ";

        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
    }

}

?>