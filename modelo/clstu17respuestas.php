<?php

Class clstu17respuestas extends clstramiterespuestas {

    //campos de la tabla 
    private $marco_legal;
    private $tuc_num_autorizacion; //iterador de numero de autorizacion 
    private $tuc_num_serie_autorizacion; //campo compuesto para la serie de autorizacion emitida por regional 

    //////////////////////////////   funciones get y set //////////////////////
    function getMarco_legal() {
        return $this->marco_legal;
    }

    function setMarco_legal($marco_legal) {
        $this->marco_legal = $marco_legal;
    }

    function getTuc_num_autorizacion() {
        return $this->tuc_num_autorizacion;
    }

    function setTuc_num_autorizacion($tuc_num_autorizacion) {
        $this->tuc_num_autorizacion = $tuc_num_autorizacion;
    }

    function getTuc_num_serie_autorizacion() {
        return $this->tuc_num_serie_autorizacion;
    }

    function setTuc_num_serie_autorizacion($tuc_num_serie_autorizacion) {
        $this->tuc_num_serie_autorizacion = $tuc_num_serie_autorizacion;
    }

    /*
     * 
     */

    public function tuc_insertar() {
        $bd = Db::getInstance();
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'" . $this->getTuc_tipo_contestacion() . "','"
                . $this->getTuc_rutaarchivo() . "','"
                . $this->getMarco_legal() . "','"
                . $this->getTuc_cumple() . "','"
                . $this->getTuc_observaciones() . "','"
                . $this->getUsu_ejecutor() . "', '"
                . $this->getTu_id() . "'"); // valores a insertae
        $bd->carga_campos("tuc_tipocontestacion,"
                . "tuc_rutaarchivo,"
                . "tuc_marcolegal,"
                . "tuc_cumple,"
                . "tuc_observaciones,"
                . "usu_ejecutor,"
                . "tu_id"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite17_respuestas")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function tuc_actualizar_respuesta($actualizador) {
        $bd = Db::getInstance();
        if ($actualizador == "aprobador") {
            $add = ", usu_aprobador='" . $this->getUsu_aprobador() . "' ";
        } elseif ($actualizador == "ejecutor") {
            $add = ", usu_ejecutor='" . $this->getUsu_ejecutor() . "' ";
        }
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql = "update _ct_tramite17_respuestas set tuc_tipocontestacion='" . $this->getTuc_tipo_contestacion() . "',tuc_rutaarchivo='" . $this->getTuc_rutaarchivo() . "',tuc_marcolegal='" . $this->getMarco_legal() . "', tuc_cumple='" . $this->getTuc_cumple() . "'" . $add . " WHERE tuc_id='" . $this->getTuc_id() . "'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    public function tuc_actualizar_respuesta_firma($actualizador) {
        $bd = Db::getInstance();
        if ($actualizador == "aprobador") {
            $add = ", usu_aprobador='" . $this->getUsu_aprobador() . "' ";
        } elseif ($actualizador == "ejecutor") {
            $add = ", usu_ejecutor='" . $this->getUsu_ejecutor() . "' ";
        }
        //$this->carga_rol_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $sql = "update _ct_tramite17_respuestas set tuc_rutaarchivo='" . $this->getTuc_rutaarchivo() . "'" . $add . " WHERE tu_id='" . $this->getTu_id() . "'";
        //echo $sql;
        //exit();
        $res = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $res;
    }

    //Ojo Revisar la ubicacion de la funcion
    public function obtener_lastAutorizacion($regional) {
        $bd = Db::getInstance();
        $sql = "select resp5.tuc_num_autorizacion from _ct_tramite17_respuestas as resp5
        inner join _ct_tramite17 as tr5 on resp5.tu_id = tr5.tu_id
        where tr5.reg_id = " . $regional . " order by resp5.tuc_num_autorizacion desc limit 1";
        //echo $sql;
        $lastAutorizacion = $bd->ejecutar($sql);
        return $lastAutorizacion;
    }

}

?>
