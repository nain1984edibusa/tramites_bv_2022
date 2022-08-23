<?php

Class clsNacionalidad {

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

//    
//    ////////   insertar género   //////////////////
//    public function gen_insertar() {
//        // abro conexión a bases de datos
//        $bd = Db::getInstance();
//        $this->carga_gen_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
//        $bd->carga_valores($this->gen_codigo . ",'" . $this->gen_nombre . "'"); // valores a insertae
//        $bd->carga_campos("gen_codigo,gen_nombre"); // campos a ser insertados
//        if ($bd->insertar("ct_genero")) // insertar
//            return 1;  // exito
//        else
//            return 0;  // error
//        $bd->cerrar();  // cerrar coneccion
//    }
//
//    //////   actualizar género    ///////////////////
//    public function gen_actualizar() {
//        // abro conexión a bases de datos
//        $bd = Db::getInstance();
//
//        $parametros = "gen_nombre = '$this->gen_nombre'";
//        $bd->carga_valores("gen_codigo = " . $this->gen_codigo);
//        $bd->carga_campos($parametros);
//        if ($bd->actualizar("ct_genero"))
//            return 1;
//        else
//            return 0;
//        $bd->cerrar();
//    }

    //////   seleccionar género    ///////////////////
    public function gen_seleccionar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select nac_codigo, nac_nombre FROM ct_nacionalidad WHERE nac_codigo = " . $this->nac_codigo;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }

    /////// ELIMINAR género
    public function gen_eliminar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "DELETE FROM ct_nacionalidad WHERE nac_codigo = " . $this->nac_codigo;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    //////   seleccionar género por provincia    ///////////////////
    public function gen_seleccionarpagina($inicio, $pagina) {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select nac_codigo, nac_nombre FROM ct_nacionalidad ORDER BY nac_codigo LIMIT ' . $inicio . ',' . $pagina;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }

    //////   seleccionar género por provincia    ///////////////////
    public function nac_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select nac_codigo, nac_nombre FROM ct_nacionalidad ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    /////////////////////////////    fin de provicnias      ///////////////////////
}

?>