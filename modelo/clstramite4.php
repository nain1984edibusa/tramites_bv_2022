<?php

Class clstramite4 extends clstramiteusuario {

    private $te_provincia;
    private $te_canton;
    private $te_parroquia;
    private $te_regional;
    private $te_pais_origen;
    private $te_direccion;
    private $te_cumple;
    private $te_observaciones;
    private $te_fecha_envio;
    private $te_direccion_envio;
    private $te_codigo_pais_evio;
    private $te_ciudad_envio;
    private $te_viaja_con_paquete;
    private $te_metodo_envio;

    function getTe_provincia() {
        return $this->te_provincia;
    }

    function getTe_canton() {
        return $this->te_canton;
    }

    function getTe_parroquia() {
        return $this->te_parroquia;
    }

    function getTe_regional() {
        return $this->te_regional;
    }

    function getTe_direccion() {
        return $this->te_direccion;
    }

    function getTe_cumple() {
        return $this->te_cumple;
    }

    function getTe_observaciones() {
        return $this->te_observaciones;
    }

    function setTe_provincia($te_provincia) {
        $this->te_provincia = $te_provincia;
    }

    function setTe_canton($te_canton) {
        $this->te_canton = $te_canton;
    }

    function setTe_parroquia($te_parroquia) {
        $this->te_parroquia = $te_parroquia;
    }

    function setTe_regional($te_regional) {
        $this->te_regional = $te_regional;
    }

    function setTe_direccion($te_direccion) {
        $this->te_direccion = $te_direccion;
    }

    function setTe_cumple($te_cumple) {
        $this->te_cumple = $te_cumple;
    }

    function setTe_observaciones($te_observaciones) {
        $this->te_observaciones = $te_observaciones;
    }

    function getTe_fecha_envio() {
        return $this->te_fecha_envio;
    }

    function setTe_fecha_envio($te_fecha_envio): void {
        $this->te_fecha_envio = $te_fecha_envio;
    }

    function getTe_direccion_envio() {
        return $this->te_direccion_envio;
    }

    function getTe_codigo_pais_evio() {
        return $this->te_codigo_pais_evio;
    }

    function getTe_ciudad_envio() {
        return $this->te_ciudad_envio;
    }

    function getTe_viaja_con_paquete() {
        return $this->te_viaja_con_paquete;
    }

    function getTe_metodo_envio() {
        return $this->te_metodo_envio;
    }

    function setTe_direccion_envio($te_direccion_envio): void {
        $this->te_direccion_envio = $te_direccion_envio;
    }

    function setTe_codigo_pais_evio($te_codigo_pais_evio): void {
        $this->te_codigo_pais_evio = $te_codigo_pais_evio;
    }

    function setTe_ciudad_envio($te_ciudad_envio): void {
        $this->te_ciudad_envio = $te_ciudad_envio;
    }

    function setTe_viaja_con_paquete($te_viaja_con_paquete): void {
        $this->te_viaja_con_paquete = $te_viaja_con_paquete;
    }

    function setTe_metodo_envio($te_metodo_envio): void {
        $this->te_metodo_envio = $te_metodo_envio;
    }

    public function getTe_pais_origen() {
        return $this->te_pais_origen;
    }

    public function setTe_pais_origen($te_pais_origen): void {
        $this->te_pais_origen = $te_pais_origen;
    }

    public function tu_insertar() {
        $bd = Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'" . $this->getTu_codigo() . "','" . $this->getUsu_eid() . "','" . $this->getUsu_iid() . "','" . $this->getTra_id() . "','" . $this->getTu_fecha_ingreso() . "','" . $this->getTu_fecha_contcont() . "','" . $this->getTu_fecha_aprocont() . "','" . $this->getReg_id() . "','" . $this->getEt_id() . "','" . $this->te_provincia . "','" . $this->te_canton . "','" . $this->te_parroquia . "','" . $this->te_regional . "','" . $this->te_pais_origen . "','" . $this->te_direccion . "','" . $this->te_fecha_envio . "','" . $this->te_direccion_envio . "','" . $this->te_codigo_pais_envio . "','" . $this->te_ciudad_envio . "'"); // valores a insertae
        $bd->carga_campos("tu_codigo,usu_extid,usu_intid,tra_id,tu_fecha_ingreso,tu_fecha_contcont,tu_fecha_aprocont,reg_id,et_id,te_provincia,te_canton,te_parroquia,te_regional, te_pais_origen,te_direccion,te_fecha_envio,te_direccion_envio,te_codigo_pais_envio,te_ciudad_envio"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite4")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function tra_seleccionar_bycodigo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select _ct_tramite4.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre FROM _ct_tramite4 "
                . " inner join ct_provincia ON _ct_tramite4.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite4.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite4.te_parroquia=ct_parroquia.par_id "
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
