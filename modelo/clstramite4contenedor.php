<?php

Class clstramite4contenedor {

    //    definio los campos de la tabla 
    private $con_id;
    private $tu_id;
    private $obj_id;
    private $tc_id;
    private $con_numero;
    private $con_seguridad;

//////////////////////////////   funciones //////////////////////
    public function getCon_id() {
        return $this->con_id;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function getObj_id() {
        return $this->obj_id;
    }

    public function getTc_id() {
        return $this->tc_id;
    }

    public function getCon_numero() {
        return $this->con_numero;
    }

    public function getCon_seguridad() {
        return $this->con_seguridad;
    }

    public function setCon_id($con_id): void {
        $this->con_id = $con_id;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function setObj_id($obj_id): void {
        $this->obj_id = $obj_id;
    }

    public function setTc_id($tc_id): void {
        $this->tc_id = $tc_id;
    }

    public function setCon_numero($con_numero): void {
        $this->con_numero = $con_numero;
    }

    public function setCon_seguridad($con_seguridad): void {
        $this->con_seguridad = $con_seguridad;
    }

    public function con_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->getTu_id() . "'"
                . ",'" . $this->getObj_id() . "'"
                . ",'" . $this->getTc_id() . "'"
                . ",'" . $this->getCon_numero() . "'"
                . ",'" . $this->getCon_seguridad() . "'"); // valores a insertae
        $bd->carga_campos("tu_id,"
                . "obj_id,"
                . "tc_id,"
                . "con_numero,"
                . "con_seguridad"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite4_contenedor")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function con_actualizar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $parametros = "tc_id = '$this->tc_id', con_numero = '$this->con_numero', con_seguridad = '$this->con_seguridad'";
        $bd->carga_valores("con_id = " . $this->con_id);
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite4_contenedor"))
            return 1;
        else
            return 0;
        $bd->cerrar();
    }

    public function con_seleccionar_por_objeto() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select * FROM _ct_tramite4_contenedor WHERE tu_id = " . $this->tu_id . " and obj_id = " . $this->obj_id ;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}
