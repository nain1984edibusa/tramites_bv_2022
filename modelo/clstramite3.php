<?php

Class clstramite3 extends clstramiteusuario {

    private $te_provincia;
    private $te_canton;
    private $te_parroquia;
    private $te_regional;
    private $te_direccion;
    private $te_cumple;
    private $te_observaciones;
    private $te_tipo_movimiento;
    private $te_fecha_desde;
    private $te_fecha_hasta;
    private $te_id_provincia_envio;
    private $te_id_canton_envio;
    private $te_ciudad_envio;
    private $te_direccion_envio;

    public function getTe_provincia() {
        return $this->te_provincia;
    }

    public function getTe_canton() {
        return $this->te_canton;
    }

    public function getTe_parroquia() {
        return $this->te_parroquia;
    }

    public function getTe_regional() {
        return $this->te_regional;
    }

    public function getTe_direccion() {
        return $this->te_direccion;
    }

    public function getTe_cumple() {
        return $this->te_cumple;
    }

    public function getTe_observaciones() {
        return $this->te_observaciones;
    }

    public function getTe_tipo_movimiento() {
        return $this->te_tipo_movimiento;
    }

    public function getTe_fecha_desde() {
        return $this->te_fecha_desde;
    }

    public function getTe_fecha_hasta() {
        return $this->te_fecha_hasta;
    }

    public function getTe_id_provincia_envio() {
        return $this->te_id_provincia_envio;
    }

    public function getTe_id_canton_envio() {
        return $this->te_id_canton_envio;
    }

    public function getTe_ciudad_envio() {
        return $this->te_ciudad_envio;
    }

    public function getTe_direccion_envio() {
        return $this->te_direccion_envio;
    }

    public function setTe_provincia($te_provincia): void {
        $this->te_provincia = $te_provincia;
    }

    public function setTe_canton($te_canton): void {
        $this->te_canton = $te_canton;
    }

    public function setTe_parroquia($te_parroquia): void {
        $this->te_parroquia = $te_parroquia;
    }

    public function setTe_regional($te_regional): void {
        $this->te_regional = $te_regional;
    }

    public function setTe_direccion($te_direccion): void {
        $this->te_direccion = $te_direccion;
    }

    public function setTe_cumple($te_cumple): void {
        $this->te_cumple = $te_cumple;
    }

    public function setTe_observaciones($te_observaciones): void {
        $this->te_observaciones = $te_observaciones;
    }

    public function setTe_tipo_movimiento($te_tipo_movimiento): void {
        $this->te_tipo_movimiento = $te_tipo_movimiento;
    }

    public function setTe_fecha_desde($te_fecha_desde): void {
        $this->te_fecha_desde = $te_fecha_desde;
    }

    public function setTe_fecha_hasta($te_fecha_hasta): void {
        $this->te_fecha_hasta = $te_fecha_hasta;
    }

    public function setTe_id_provincia_envio($te_id_provincia_envio): void {
        $this->te_id_provincia_envio = $te_id_provincia_envio;
    }

    public function setTe_id_canton_envio($te_id_canton_envio): void {
        $this->te_id_canton_envio = $te_id_canton_envio;
    }

    public function setTe_ciudad_envio($te_ciudad_envio): void {
        $this->te_ciudad_envio = $te_ciudad_envio;
    }

    public function setTe_direccion_envio($te_direccion_envio): void {
        $this->te_direccion_envio = $te_direccion_envio;
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
                . ",'" . $this->getTe_provincia() . "'"
                . ",'" . $this->getTe_canton() . "'"
                . ",'" . $this->getTe_parroquia() . "'"
                . ",'" . $this->getTe_regional() . "'"
                . ",'" . $this->getTe_direccion() . "'"
                . ",'" . $this->getTe_tipo_movimiento() . "'"
                . ",'" . $this->getTe_fecha_desde() . "'"
                . ",'" . $this->getTe_fecha_hasta() . "'"
                . ",'" . $this->getTe_id_provincia_envio() . "'"
                . ",'" . $this->getTe_id_canton_envio() . "'"
                . ",'" . $this->getTe_ciudad_envio() . "'"
                . ",'" . $this->getTe_direccion_envio() . "'"); // valores a insertae
        $bd->carga_campos("tu_codigo,"
                . "usu_extid,"
                . "usu_intid,"
                . "tra_id,"
                . "tu_fecha_ingreso,"
                . "tu_fecha_contcont,"
                . "tu_fecha_aprocont,"
                . "reg_id,"
                . "et_id,"
                . "te_provincia,"
                . "te_canton,"
                . "te_parroquia,"
                . "te_regional,"
                . "te_tipo_movimiento,"
                . "te_fecha_desde,"
                . "te_fecha_desde,"
                . "te_fecha_hasta,"
                . "te_id_provincia_envio,"
                . "te_id_canton_envio,"
                . "te_ciudad_envio,"
                . "te_direccion_envio"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite3")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function tra_seleccionar_bycodigo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select _ct_tramite4.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre, ct_pais.pai_nombre"
                . " FROM _ct_tramite4 "
                . " inner join ct_provincia ON _ct_tramite4.te_provincia=ct_provincia.pro_id "
                . "inner join ct_canton ON _ct_tramite4.te_canton=ct_canton.can_id "
                . "inner join ct_parroquia ON _ct_tramite4.te_parroquia=ct_parroquia.par_id "
                . "inner join ct_pais ON _ct_tramite4.te_codigo_pais_envio = ct_pais.pai_codigo "
                . " WHERE _ct_tramite4.tu_codigo='" . $this->getTu_codigo() . "'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    /* public function tra_reasignar(){ //varios estados
      $bd=Db::getInstance();
      $parametros ="usu_intid = '".$this->getUsu_iid()."', et_id = '".$this->getEt_id()."'";
      $bd->carga_valores("tu_id = ".$this->getTu_id());
      $bd->carga_campos($parametros);
      if($bd->actualizar("_ct_tramite4")) // insertar
      return 1;  // exito
      else
      return 0;  // error
      //$bd->cerrar();  // cerrar coneccion
      } */

    public function tra_enviarconval() { //varios estados
        $bd = Db::getInstance();
        $parametros = "te_provincia = '" . $this->getTe_provincia() . "', te_canton = '" . $this->getTe_canton() . "', te_parroquia = '" . $this->getTe_parroquia() . "', te_direccion = '" . $this->getTe_direccion() . "', te_codigo_inventario='" . $this->getTe_codigo_inventario() . "', te_regional = '" . $this->getTe_regional() . "', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = " . $this->getTu_id());
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite4")) // insertar
            return 1;  // exito
        else
            return 0;  // error
    }

    public function tra_validar_formsolicitud() { //varios estados
        $bd = Db::getInstance();
        $parametros = "te_cumple = '" . $this->getTe_cumple() . "', te_observaciones = '" . $this->getTe_observaciones() . "'";
        $bd->carga_valores("tu_codigo = " . $this->getTu_codigo());
        $bd->carga_campos($parametros);
        if ($bd->actualizar("_ct_tramite3")) // insertar
            return 1;  // exito
        else
            return 0;  // error
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
