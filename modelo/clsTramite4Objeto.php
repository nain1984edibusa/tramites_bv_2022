<?php

Class clstramite4objeto {

    //    definio los campos de la tabla 
    private $obj_codigo;
    private $tu_id;
    private $tbc_codigo;
    private $eob_codigo;
    private $con_codigo;
    private $obj_cantidad;
    private $obj_tema;
    private $obj_autor;
    private $obj_tecnica;
    private $obj_largo;
    private $obj_ancho;
    private $obj_profundidad;

    //////////////////////////////   funciones //////////////////////

    public function getObj_codigo() {
        return $this->obj_codigo;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function getTbc_codigo() {
        return $this->tbc_codigo;
    }

    public function getEob_codigo() {
        return $this->eob_codigo;
    }

    public function getCon_codigo() {
        return $this->con_codigo;
    }

    public function getObj_cantidad() {
        return $this->obj_cantidad;
    }

    public function getObj_tema() {
        return $this->obj_tema;
    }

    public function getObj_autor() {
        return $this->obj_autor;
    }

    public function getObj_tecnica() {
        return $this->obj_tecnica;
    }

    public function getObj_largo() {
        return $this->obj_largo;
    }

    public function getObj_ancho() {
        return $this->obj_ancho;
    }

    public function getObj_profundidad() {
        return $this->obj_profundidad;
    }

    public function setObj_codigo($obj_codigo): void {
        $this->obj_codigo = $obj_codigo;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function setTbc_codigo($tbc_codigo): void {
        $this->tbc_codigo = $tbc_codigo;
    }

    public function setEob_codigo($eob_codigo): void {
        $this->eob_codigo = $eob_codigo;
    }

    public function setCon_codigo($con_codigo): void {
        $this->con_codigo = $con_codigo;
    }

    public function setObj_cantidad($obj_cantidad): void {
        $this->obj_cantidad = $obj_cantidad;
    }

    public function setObj_tema($obj_tema): void {
        $this->obj_tema = $obj_tema;
    }

    public function setObj_autor($obj_autor): void {
        $this->obj_autor = $obj_autor;
    }

    public function setObj_tecnica($obj_tecnica): void {
        $this->obj_tecnica = $obj_tecnica;
    }

    public function setObj_largo($obj_largo): void {
        $this->obj_largo = $obj_largo;
    }

    public function setObj_ancho($obj_ancho): void {
        $this->obj_ancho = $obj_ancho;
    }

    public function setObj_profundidad($obj_profundidad): void {
        $this->obj_profundidad = $obj_profundidad;
    }

    ////////   insertar objeto   //////////////////
    public function obj_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->getTu_id() . "', "
                . "'" . $this->getTbc_codigo() . "', "
                . "'" . $this->getEob_codigo() . "', "
                . "'" . $this->getCon_codigo() . "', "
                . "'" . $this->getObj_cantidad() . "', "
                . "'" . $this->getObj_tema() . "',"
                . "'" . $this->getObj_autor() . "',"
                . "'" . $this->getObj_tecnica() . "',"
                . "'" . $this->getObj_largo() . "',"
                . "'" . $this->getObj_ancho() . "',"
                . "'" . $this->getObj_profundidad() . "'");

        $bd->carga_campos("tu_id, "
                . "tbc_codigo, "
                . "eob_codigo, "
                . "con_codigo, "
                . "obj_cantidad, "
                . "obj_tema, "
                . "obj_autor, "
                . "obj_tecnica, "
                . "obj_largo, "
                . "obj_ancho, "
                . "obj_profundidad");

        if ($bd->insertar("_ct_tramite4_objeto")) // insertar
            return $bd->lastID();
        else
            return 0;
        $bd->cerrar();  // cerrar coneccion
    }

    ////////   obtener objeto   //////////////////
    public function obj_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select obj_codigo"
                . ", tu_id "
                . ", tbc_codigo "
                . ", eob_codigo "
                . ", con_codigo "
                . ", obj_cantidad "
                . ", obj_tema "
                . ", obj_autor "
                . ", obj_tecnica "
                . ", obj_largo "
                . ", obj_ancho "
                . ", obj_profundidad "
                . "FROM _ct_tramite4_objeto ";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    //////   actualizar género    ///////////////////
    public function gen_actualizar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();

        $parametros = "gen_nombre = '$this->gen_nombre'";
        $bd->carga_valores("gen_codigo = " . $this->gen_codigo);
        $bd->carga_campos($parametros);
        if ($bd->actualizar("ct_genero"))
            return 1;
        else
            return 0;
        $bd->cerrar();
    }

    //////   seleccionar objeto por tramite    ///////////////////
    public function obj_seleccionar_objeto_por_tramite() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select obj_codigo"
                . ", tu_id "
                . ", tbc_codigo "
                . ", eob_codigo "
                . ", con_codigo "
                . ", obj_cantidad "
                . ", obj_tema "
                . ", obj_autor "
                . ", obj_tecnica "
                . ", obj_largo "
                . ", obj_ancho "
                . ", obj_profundidad "
                . "FROM _ct_tramite4_objeto "
                . "WHERE tu_id = " . $this->tu_id;
        $rsprv = $bd->ejecutar($sql);
        
        
        $bd->cerrar();
        return $rsprv;
    }

    /////// ELIMINAR género
    public function gen_eliminar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "DELETE FROM ct_genero WHERE gen_codigo = " . $this->gen_codigo;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}

?>