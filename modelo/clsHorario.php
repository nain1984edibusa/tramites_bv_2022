<?php

Class clsHorario {

    //    definio los campos de la tabla 
    private $ho_codigo;
    private $ho_hora;
    private $ho_estado;

    //////////////////////////////   funciones //////////////////////

    public function getHo_codigo() {
        return $this->ho_codigo;
    }

    public function getHo_hora() {
        return $this->ho_hora;
    }

    public function setHo_codigo($ho_codigo): void {
        $this->ho_codigo = $ho_codigo;
    }

    public function setHo_hora($ho_hora): void {
        $this->ho_hora = $ho_hora;
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

    //////   seleccionar tipo bien cultural    ///////////////////
    public function horario_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select ho_codigo, ho_hora FROM ct_horario ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function horarioSeleccionarActivos() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM ct_horario WHERE ho_estado = 'ACT'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    /////////////////////////////    fin de provicnias      ///////////////////////
}

?>