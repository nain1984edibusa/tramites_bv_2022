<?php

Class clsareagestiontramite {

    //    definio los campos de la tabla 
    private $agt_id;
    private $agt_nombre;
    private $agt_estado;

    //////////////////////////////   funciones //////////////////////
    public function getAgt_id() {
        return $this->agt_id;
    }

    public function getAgt_nombre() {
        return $this->agt_nombre;
    }

    public function getAgt_estado() {
        return $this->agt_estado;
    }

    public function setAgt_id($agt_id): void {
        $this->agt_id = $agt_id;
    }

    public function setAgt_nombre($agt_nombre): void {
        $this->agt_nombre = $agt_nombre;
    }

    public function setAgt_estado($agt_estado): void {
        $this->agt_estado = $agt_estado;
    }

    //////////////////////////////   metodos //////////////////////
    //selecionar tramites
    public function agt_cargar_areas() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = " select ct_area_gestion_tramite.* FROM ct_area_gestion_tramite ";
        $res = $bd->ejecutar($sql);
//        $bd->cerrar();
        return $res;
    }
}

?>