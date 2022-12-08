<?php

Class clstramite7 extends clstramiteusuario {

    private $tr_cumple;
    private $tr_observaciones;
    private $tr_propietario;
    private $tr_objeto_solicitud;
    private $tr_provincia;
    private $tr_canton;
    private $tr_parroquia;
    private $tr_regional;
    private $tr_sector;
    private $tr_via_principal;
    private $tr_via_secundaria;
    private $tr_numero_predio;
    private $tr_numero_catastro;

    public function getTr_cumple() {
        return $this->tr_cumple;
    }

    public function getTr_observaciones() {
        return $this->tr_observaciones;
    }

    public function getTr_propietario() {
        return $this->tr_propietario;
    }

    public function getTr_objeto_solicitud() {
        return $this->tr_objeto_solicitud;
    }

    public function getTr_provincia() {
        return $this->tr_provincia;
    }

    public function getTr_canton() {
        return $this->tr_canton;
    }

    public function getTr_parroquia() {
        return $this->tr_parroquia;
    }

    public function getTr_regional() {
        return $this->tr_regional;
    }

    public function getTr_sector() {
        return $this->tr_sector;
    }

    public function getTr_via_principal() {
        return $this->tr_via_principal;
    }

    public function getTr_via_secundaria() {
        return $this->tr_via_secundaria;
    }

    public function getTr_numero_predio() {
        return $this->tr_numero_predio;
    }

    public function getTr_numero_catastro() {
        return $this->tr_numero_catastro;
    }

    public function setTr_cumple($tr_cumple): void {
        $this->tr_cumple = $tr_cumple;
    }

    public function setTr_observaciones($tr_observaciones): void {
        $this->tr_observaciones = $tr_observaciones;
    }

    public function setTr_propietario($tr_propietario): void {
        $this->tr_propietario = $tr_propietario;
    }

    public function setTr_objeto_solicitud($tr_objeto_solicitud): void {
        $this->tr_objeto_solicitud = $tr_objeto_solicitud;
    }

    public function setTr_provincia($tr_provincia): void {
        $this->tr_provincia = $tr_provincia;
    }

    public function setTr_canton($tr_canton): void {
        $this->tr_canton = $tr_canton;
    }

    public function setTr_parroquia($tr_parroquia): void {
        $this->tr_parroquia = $tr_parroquia;
    }

    public function setTr_regional($tr_regional): void {
        $this->tr_regional = $tr_regional;
    }

    public function setTr_sector($tr_sector): void {
        $this->tr_sector = $tr_sector;
    }

    public function setTr_via_principal($tr_via_principal): void {
        $this->tr_via_principal = $tr_via_principal;
    }

    public function setTr_via_secundaria($tr_via_secundaria): void {
        $this->tr_via_secundaria = $tr_via_secundaria;
    }

    public function setTr_numero_predio($tr_numero_predio): void {
        $this->tr_numero_predio = $tr_numero_predio;
    }

    public function setTr_numero_catastro($tr_numero_catastro): void {
        $this->tr_numero_catastro = $tr_numero_catastro;
    }

    public function tu_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->getTu_codigo() . "'"
                . ",'" . $this->getUsu_eid() . "'"
                . ",'" . $this->getUsu_iid() . "'"
                . ",'" . $this->getTra_id() . "'"
                . ",'" . $this->getTu_fecha_ingreso() . "'"
                . ",'" . $this->getTu_fecha_contcont() . "'"
                . ",'" . $this->getTu_fecha_aprocont() . "'"
                . ",'" . $this->getReg_id() . "'"
                . ",'" . $this->getEt_id() . "'"
                . ",'" . $this->tr_propietario . "'"
                . ",'" . $this->tr_objeto_solicitud . "'"
                . ",'" . $this->tr_provincia . "'"
                . ",'" . $this->tr_canton . "'"
                . ",'" . $this->tr_parroquia . "'"
                . ",'" . $this->tr_regional . "'"
                . ",'" . $this->tr_sector . "'"
                . ",'" . $this->tr_via_principal . "'"
                . ",'" . $this->tr_via_secundaria . "'"
                . ",'" . $this->tr_numero_predio . "'"
                . ",'" . $this->tr_numero_catastro . "'"); // valores a insertae
        $bd->carga_campos("tu_codigo,"
                . "usu_extid,"
                . "usu_intid,"
                . "tra_id,"
                . "tu_fecha_ingreso,"
                . "tu_fecha_contcont,"
                . "tu_fecha_aprocont,"
                . "reg_id,"
                . "et_id,"
                . "tr_propietario,"
                . "tr_objeto_solicitud,"
                . "tr_provincia,"
                . "tr_canton,"
                . "tr_parroquia,"
                . "tr_regional,"
                . "tr_sector,"
                . "tr_via_principal,"
                . "tr_via_secundaria,"
                . "tr_numero_predio,"
                . "tr_numero_catastro"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite7")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function tra_seleccionar_bycodigo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select _ct_tramite4.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre, ct_pais.pai_nombre, ct_nacionalidad.nac_nombre,  ct_regional.reg_ciudad, ct_regional.reg_direccion"
                . " FROM _ct_tramite4 "
                . " inner join ct_provincia ON _ct_tramite4.te_provincia=ct_provincia.pro_id "
                . "inner join ct_canton ON _ct_tramite4.te_canton=ct_canton.can_id "
                . "inner join ct_parroquia ON _ct_tramite4.te_parroquia=ct_parroquia.par_id "
                . "inner join ct_pais ON _ct_tramite4.te_codigo_pais_envio = ct_pais.pai_codigo "
                . "inner join ct_nacionalidad ON _ct_tramite4.te_pais_origen = ct_nacionalidad.nac_codigo "
                . "inner join ct_regional ON _ct_tramite4.reg_id = ct_regional.reg_id "
                . " WHERE _ct_tramite4.tu_codigo='" . $this->getTu_codigo() . "'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    public function tra_enviarconval() { //varios estados
        $bd = Db::getInstance();
        $parametros = "te_provincia = '" . $this->getTe_provincia() . "', te_canton = '" . $this->getTe_canton() . "', te_parroquia = '" . $this->getTe_parroquia() . "', te_direccion = '" . $this->getTe_direccion() . "', te_codigo_inventario='" . $this->getTe_codigo_inventario() . "', te_regional = '" . $this->getTe_regional() . "', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = " . $this->getTu_id());
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite4")) // insertar
            return 1;  // exito
        else
            return 0;  // error
//$bd->cerrar();  // cerrar coneccion
    }

    public function tra_validar_formsolicitud() { //varios estados
        $bd = Db::getInstance();
        $parametros = "te_cumple = '" . $this->getTe_cumple() . "', te_observaciones = '" . $this->getTe_observaciones() . "'";
        $bd->carga_valores("tu_codigo = " . $this->getTu_codigo());
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite4")) // insertar
            return 1;  // exito
        else
            return 0;  // error
//$bd->cerrar();  // cerrar coneccion
    }

    public function tra_contar_validacionrequisitos($estado) {
        $bd = Db::getInstance();
        $sql = "SELECT count(*) as total from _ct_tramite4 WHERE te_cumple='" . $estado . "' and  _ct_tramite4.tu_codigo='" . $this->getTu_codigo() . "'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res = mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];
    }

}
