<?php

Class clsnacionalidad {
    //    definio los campos de la tabla 
    private $nac_codigo;
    private $nac_nombre;

    //////////////////////////////   funciones //////////////////////

    public function getNac_codigo() {
        return $this->nac_codigo;
    }

    public function getNac_nombre() {
        return $this->nac_nombre;
    }

    public function setNac_codigo($nac_codigo): void {
        $this->nac_codigo = $nac_codigo;
    }

    public function setNac_nombre($nac_nombre): void {
        $this->nac_nombre = $nac_nombre;
    }

    //////////////////////////////   metodos //////////////////////
    //////   seleccionar nacionalidades   ///////////////////
    public function nac_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select nac_codigo, nac_nombre FROM ct_nacionalidad ";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
}
?>