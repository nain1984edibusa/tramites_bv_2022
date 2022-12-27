<?php

Class clsgestiontramite {
    //    definio los campos de la tabla 
    private $gt_id;
    private $reg_id;
    private $agt_id;
    private $tra_id;
    private $gt_fecha_recepcion;
    private $gt_fecha_respuesta;
    private $egt_id;
    private $gt_tecnico_responsable;
    private $ti_id;
    private $gt_identificacion;
    private $gt_nombre;
    private $gt_email;
    private $gt_numero_celular;
    private $usu_int_id;

    //////////////////////////////   funciones //////////////////////

    public function getGt_id() {
        return $this->gt_id;
    }

    public function getReg_id() {
        return $this->reg_id;
    }

    public function getAgt_id() {
        return $this->agt_id;
    }

    public function getTra_id() {
        return $this->tra_id;
    }

    public function getGt_fecha_recepcion() {
        return $this->gt_fecha_recepcion;
    }

    public function getGt_fecha_respuesta() {
        return $this->gt_fecha_respuesta;
    }

    public function getEgt_id() {
        return $this->egt_id;
    }

    public function getTi_id() {
        return $this->ti_id;
    }

    public function getGt_tecnico_responsable() {
        return $this->gt_tecnico_responsable;
    }

    public function getGt_identificacion() {
        return $this->gt_identificacion;
    }

    public function getGt_nombre() {
        return $this->gt_nombre;
    }

    public function getGt_email() {
        return $this->gt_email;
    }

    public function getGt_numero_celular() {
        return $this->gt_numero_celular;
    }

    public function setGt_id($gt_id): void {
        $this->gt_id = $gt_id;
    }

    public function setReg_id($reg_id): void {
        $this->reg_id = $reg_id;
    }

    public function setAgt_id($agt_id): void {
        $this->agt_id = $agt_id;
    }

    public function setTra_id($tra_id): void {
        $this->tra_id = $tra_id;
    }

    public function setGt_fecha_recepcion($gt_fecha_recepcion): void {
        $this->gt_fecha_recepcion = $gt_fecha_recepcion;
    }

    public function setGt_fecha_respuesta($gt_fecha_respuesta): void {
        $this->gt_fecha_respuesta = $gt_fecha_respuesta;
    }

    public function setEgt_id($egt_id): void {
        $this->egt_id = $egt_id;
    }

    public function setTi_id($ti_id): void {
        $this->ti_id = $ti_id;
    }

    public function setGt_tecnico_responsable($gt_tecnico_responsable): void {
        $this->gt_tecnico_responsable = $gt_tecnico_responsable;
    }

    public function setGt_identificacion($gt_identificacion): void {
        $this->gt_identificacion = $gt_identificacion;
    }

    public function setGt_nombre($gt_nombre): void {
        $this->gt_nombre = $gt_nombre;
    }

    public function setGt_email($gt_email): void {
        $this->gt_email = $gt_email;
    }

    public function setGt_numero_celular($gt_numero_celular): void {
        $this->gt_numero_celular = $gt_numero_celular;
    }

    public function getUsu_int_id() {
        return $this->usu_int_id;
    }

    public function setUsu_int_id($usu_int_id): void {
        $this->usu_int_id = $usu_int_id;
    }

        //////////////////////////////   metodos //////////////////////
//insertar gestion tramites
    public function gt_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->getReg_id() . "', "
                . "'" . $this->getAgt_id() . "', "
                . "'" . $this->getTra_id() . "', "
                . "'" . $this->getGt_fecha_recepcion() . "', "
                . "'" . $this->getGt_tecnico_responsable() . "' ,"
                . "'" . $this->getTi_id() . "',"
                . "'" . $this->getGt_identificacion() . "' ,"
                . "'" . $this->getGt_nombre() . "' ,"
                . "'" . $this->getGt_email() . "' ,"
                . "'" . $this->getUsu_int_id() . "' ,"
                . "'" . $this->getGt_numero_celular() . "'");

        $bd->carga_campos("reg_id, "
                . "agt_id, "
                . "tra_id, "
                . "gt_fecha_recepcion, "
                . "gt_tecnico_responsable, "
                . "ti_id, "
                . "gt_identificacion, "
                . "gt_nombre, "
                . "gt_email, "
                . "usu_int_id, "
                . "gt_numero_celular");

        if ($bd->insertar("ct_gestion_tramite")) // insertar
            return $bd->lastID();
        else
            return 0;
//        $bd->cerrar();  // cerrar coneccion
    }

//selecionar tramites
    public function gt_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = " select gt.*,  ti.* ,  tr.* , ag.* , eg.* ,  r.* FROM ct_gestion_tramite gt "
                . " inner join ct_tipo_identificacion ti  on gt.ti_id = ti.ti_id "
                . " inner join ct_area_gestion_tramite ag  on gt.agt_id = ag.agt_id "
                . " inner join ct_estado_gestion_tramite eg  on gt.egt_id = eg.egt_id "
                . " inner join ct_regional r  on gt.reg_id = r.reg_id "
                . " inner join ct_tramites tr  on gt.tra_id = tr.tra_id "
                . " order by gt.gt_fecha_recepcion desc ";

        $res = $bd->ejecutar($sql);
//        $bd->cerrar();
        return $res;
    }
    
    //selecionar tramites
    public function gt_seleccionar_por_usuario() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = " select gt.*,  ti.* ,  tr.* , ag.* , eg.* ,  r.* FROM ct_gestion_tramite gt "
                . " inner join ct_tipo_identificacion ti  on gt.ti_id = ti.ti_id "
                . " inner join ct_area_gestion_tramite ag  on gt.agt_id = ag.agt_id "
                . " inner join ct_estado_gestion_tramite eg  on gt.egt_id = eg.egt_id "
                . " inner join ct_regional r  on gt.reg_id = r.reg_id "
                . " inner join ct_tramites tr  on gt.tra_id = tr.tra_id "
                . " WHERE usu_int_id = " . $this->usu_int_id . " "
                . " order by gt.gt_fecha_recepcion desc ";

        $res = $bd->ejecutar($sql);
//        $bd->cerrar();
        return $res;
    }
//    $sql = "DELETE FROM rg_regional WHERE reg_id = " . $this->reg_id;
    public function gt_cambiar_estado() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "update ct_gestion_tramite set egt_id ='" . $this->egt_id . "' , gt_fecha_respuesta ='" . $this->gt_fecha_respuesta . "' WHERE gt_id = '" . $this->gt_id . "'";
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
}
?>