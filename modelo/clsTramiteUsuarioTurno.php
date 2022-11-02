<?php

Class clstramiteusuarioturno {

    private $tut_id;
    private $tut_fecha;
    private $tut_hora;
    private $tut_zonal_id;
    private $tu_id;

    /* GETS Y SETS */

    public function getTut_id() {
        return $this->tut_id;
    }

    public function getTut_hora() {
        return $this->tut_hora;
    }

    public function getTu_id() {
        return $this->tu_id;
    }

    public function setTut_id($tut_id): void {
        $this->tut_id = $tut_id;
    }

    public function setTut_hora($tut_hora): void {
        $this->tut_hora = $tut_hora;
    }

    public function setTu_id($tu_id): void {
        $this->tu_id = $tu_id;
    }

    public function getTut_zonal_id() {
        return $this->tut_zonal_id;
    }

    public function setTut_zonal_id($tut_zonal_id): void {
        $this->tut_zonal_id = $tut_zonal_id;
    }

    public function getTut_fecha() {
        return $this->tut_fecha;
    }

    public function setTut_fecha($tut_fecha): void {
        $this->tut_fecha = $tut_fecha;
    }

    public function tut_insertar() {
        $bd = Db::getInstance();
        $bd->carga_valores("'" . $this->tut_fecha . "'"
                . ",'" . $this->tut_hora . "'"
                . ",'" . $this->tut_zonal_id . "'"
                . ",'" . $this->tu_id . "'"); // valores a insertae
        $bd->carga_campos("tut_fecha,"
                . "tut_hora,"
                . "tut_zonal_id,"
                . "tu_id"); // campos a ser insertados
        if ($bd->insertar("ct_tramite_usuario_turno")) // insertar
            return $bd->lastID();  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    public function tut_turno() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM ct_tramite_usuario_turno "
                . " inner join ct_regional  on ct_tramite_usuario_turno.tut_zonal_id = ct_regional.reg_id "
                . " inner join ct_horario  on ct_tramite_usuario_turno.tut_hora = ct_horario.ho_codigo "
                . " WHERE tu_id = " . $this->tu_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}

?>
