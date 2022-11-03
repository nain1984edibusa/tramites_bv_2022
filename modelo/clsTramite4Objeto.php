<?php

Class clstramite4objeto {

    //    definio los campos de la tabla 
    private $obj_id;
    private $tu_id;
    private $tbc_id;
    private $eob_id;
    private $con_id;
    private $obj_cantidad;
    private $obj_tema;
    private $obj_autor;
    private $obj_tecnica;
    private $obj_largo;
    private $obj_ancho;
    private $obj_profundidad;

    //////////////////////////////   funciones //////////////////////

    public function getObj_id() {
        return $this->obj_id;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function getTbc_id() {
        return $this->tbc_id;
    }

    public function getEob_id() {
        return $this->eob_id;
    }

    public function getCon_id() {
        return $this->con_id;
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

    public function setObj_id($obj_id): void {
        $this->obj_id = $obj_id;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function setTbc_id($tbc_id): void {
        $this->tbc_id = $tbc_id;
    }

    public function setEob_id($eob_id): void {
        $this->eob_id = $eob_id;
    }

    public function setCon_id($con_id): void {
        $this->con_id = $con_id;
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
                . "'" . $this->getTbc_id() . "', "
                . "'" . $this->getEob_id() . "', "
                . "'" . $this->getCon_id() . "', "
                . "'" . $this->getObj_cantidad() . "', "
                . "'" . $this->getObj_tema() . "',"
                . "'" . $this->getObj_autor() . "',"
                . "'" . $this->getObj_tecnica() . "',"
                . "'" . $this->getObj_largo() . "',"
                . "'" . $this->getObj_ancho() . "',"
                . "'" . $this->getObj_profundidad() . "'");

        $bd->carga_campos("tu_id, "
                . "tbc_id, "
                . "eob_id, "
                . "con_id, "
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

    public function obj_actualizar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();

        $parametros = "con_id = '$this->con_id',eob_id = '$this->eob_id',obj_cantidad = '$this->obj_cantidad',obj_tema = '$this->obj_tema',obj_autor = '$this->obj_autor',obj_tecnica = '$this->obj_tecnica',obj_largo = '$this->obj_largo',obj_ancho = '$this->obj_ancho',obj_profundidad = '$this->obj_profundidad'";
        $bd->carga_valores("obj_id = " . $this->obj_id);
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite4_objeto"))
            return 1;
        else
            return 0;
        $bd->cerrar();
    }

    ////////   obtener objeto   //////////////////
    public function obj_seleccionar_objeto_por_id() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT _ct_tramite4_objeto.* , _ct_tramite4_tipo_bien_cultural.* FROM _ct_tramite4_objeto  "
                . " inner join _ct_tramite4_tipo_bien_cultural  on _ct_tramite4_objeto.tbc_id = _ct_tramite4_tipo_bien_cultural.tbc_id "
                . " WHERE obj_id = " . $this->obj_id;
        $rsprv = $bd->ejecutar($sql);

        $bd->cerrar();
        return $rsprv;
    }

    //////   seleccionar objeto por tramite    ///////////////////
//    public function obj_seleccionar_objeto_por_tramite() {
//        // abro conexión a bases de datos
//        $bd = Db::getInstance();
//        $sql = "SELECT * FROM _ct_tramite4_objeto "
//                . " inner join _ct_tramite4_tipo_bien_cultural  on _ct_tramite4_objeto.tbc_id = _ct_tramite4_tipo_bien_cultural.tbc_id "
//                . " inner join _ct_tramite4_estado_objeto  on _ct_tramite4_estado_objeto.eob_id = _ct_tramite4_objeto.eob_id "
//                . " WHERE tu_id = " . $this->tu_id;
//        $rsprv = $bd->ejecutar($sql);
//
//        $bd->cerrar();
//        return $rsprv;
//    }

    public function obj_seleccionar_objeto_por_tramite() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = " SELECT * FROM _ct_tramite4_objeto  o 
            inner join _ct_tramite4_tipo_bien_cultural b on o.tbc_id = b.tbc_id  
        inner join _ct_tramite4_estado_objeto e on e.eob_id = o.eob_id  
        inner join _ct_tramite4_contenedor c on c.obj_id = o.obj_id
        WHERE o.tu_id = " . $this->tu_id;
        $rsprv = $bd->ejecutar($sql);

        $bd->cerrar();
        return $rsprv;
    }

    

    public function eo_seleccionartodo() {
    // abro conexión a bases de datos
    $bd = Db::getInstance();
    $sql = "SELECT * FROM clstramite4estadoobjeto ";
    $rsprv = $bd->ejecutar($sql);

    $bd->cerrar();
    return $rsprv;
}

}

?>