<?php
Class clstramite17 extends clstramiteusuario{
    public function tu_insertar(){
        $bd=Db::getInstance();                        
        $bd->carga_valores( "'".$this->getTu_codigo()."', "
                . "'".$this->getUsu_eid()."', "
                . "'".$this->getUsu_iid()."', "
                . "'".$this->getTra_id()."', "
                . "'".$this->getTu_fecha_ingreso()."', "
                . "'".$this->getTu_fecha_contcont()."',"
                . "'".$this->getTu_fecha_aprocont()."', "
                . "'".$this->getReg_id()."',"
                . "'".$this->getEt_id()."' ,"
                . "'".$this->getTu_estado()."'");
 
         $bd->carga_campos( "tu_codigo, "
                . "usu_extid, "
                . "usu_intid, "
                . "tra_id, "
                . "tu_fecha_ingreso, "
                . "tu_fecha_contcont, "
                . "tu_fecha_aprocont, "
                . "reg_id, "
                . "et_id, "
                . "tu_estado");
         
            if($bd->insertar("_ct_tramite17")) // insertar
                return $bd->lastID();
            else 
                return 0;
            $bd->cerrar();  // cerrar coneccion



    }
    public function tra_seleccionar_13bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        //$sql = "select _ct_tramite13.*, ct_provincia.pro_nombre, ct_canton.can_nombre, ct_parroquia.par_nombre FROM _ct_tramite8 "
        //        ." inner join ct_provincia ON _ct_tramite13.te_provincia=ct_provincia.pro_id inner join ct_canton ON _ct_tramite8.te_canton=ct_canton.can_id inner join ct_parroquia ON _ct_tramite8.te_parroquia=ct_parroquia.par_id "
        //        . " WHERE _ct_tramite8.tu_codigo='".$this->getTu_codigo()."'";
        
        
        $sql = "SELECT *FROM _ct_tramite13 as tr13
                INNER JOIN _ct_tramite13_requisitos AS tr13_req
                ON tr13.tu_id = tr13_req.tu_id
                INNER JOIN ct_parroquia as parr
                ON tr13.te_parroquia = parr.par_id
                INNER JOIN ct_canton as can
                ON can.can_id = parr.can_id
                INNER JOIN ct_provincia as prov
                ON prov.pro_id = can.pro_id
                WHERE tr13.tu_codigo = '".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }
    
        
    public function tur_seleccionAll(){
        $bd=Db::getInstance();
        $sql = "SELECT *FROM _ct_tramite13 as tr13
                INNER JOIN _ct_tramite13_requisitos AS tr13_req
                ON tr13.tu_id = tr13_req.tu_id
                INNER JOIN _ct_tramite13_respuestas as tr13resp
                ON tr13resp.tu_codigo = tr13.tu_codigo
                INNER JOIN _ct_tramite_13_resp_anexos as tr13anx
                ON tr13anx.fk_ct_tramite13_resp_id = tr13resp.tu_resp_id
                WHERE tr13.tu_codigo = '".$this->getTu_codigo()."'";
        $res = $bd->ejecutar($sql);
        $bd->cerrar();
        return $res;
        
    }

    public function tra_seleccionar_bycodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "select _ct_tramite17.* FROM _ct_tramite17 WHERE _ct_tramite17.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    public function tra_contar_validacionrequisitos($estado){
        $bd=Db::getInstance();
        $sql="SELECT count(*) as total from _ct_tramite17 WHERE te_cumple='".$estado."' and  _ct_tramite17.tu_codigo='".$this->getTu_codigo()."'";
        //echo $sql;
        $ttdisp = $bd->ejecutar($sql);
        $res= mysqli_fetch_array($ttdisp);
        //$bd->cerrar();
        return $res["total"];      
    }
    
     public function tra_enviarconval(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_provincia = '".$this->getTe_provincia()."', te_canton = '".$this->getTe_canton()."', te_parroquia = '".$this->getTe_parroquia()."', te_direccion = '".$this->getTe_direccion()."', te_codigo_inventario='".$this->getTe_codigo_inventario()."', te_regional = '".$this->getTe_regional()."', te_cumple = 'PENDIENTE'";
        $bd->carga_valores("tu_id = ".$this->getTu_id());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite17")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
    
    
    public function tra_validar_formsolicitud(){ //varios estados
        $bd=Db::getInstance();
        $parametros ="te_cumple = '".$this->getTe_cumple()."', te_observaciones = '".$this->getTe_observaciones()."'";
        $bd->carga_valores("tu_codigo = ".$this->getTu_codigo());
        $bd->carga_campos($parametros);
        if($bd->actualizar("_ct_tramite13")) // insertar
          return 1;  // exito
        else 
          return 0;  // error
        //$bd->cerrar();  // cerrar coneccion
    }
}

