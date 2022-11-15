<?php

Class clstramitetecnicoasignado {

    //defino los campos de la tabla usuarios
    private $tt_id;
    private $usu_id;
    private $tra_id;
    

    //////////////////////////////   funciones  creo mis constructores//////////////////////
    public function getTt_id() {
        return $this->tt_id;
    }

    public function getUsu_id() {
        return $this->usu_id;
    }

    public function getTra_id() {
        return $this->tra_id;
    }

    public function setTt_id($tt_id): void {
        $this->tt_id = $tt_id;
    }

    public function setUsu_id($usu_id): void {
        $this->usu_id = $usu_id;
    }

    public function setTra_id($tra_id): void {
        $this->tra_id = $tra_id;
    }
}
?>
