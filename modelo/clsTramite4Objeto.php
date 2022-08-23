<?php

Class clsTramite4Objeto {

    //    definio los campos de la tabla 
    private $obj_codigo;
    private $tbc_codigo;
    private $eob_codigo;
    private $con_codigo;
    private $obj_cantidad;
    private $obj_tema;
    private $obj_autor;
    private $obj_tecnica;
    private $obj_largo;
    private $obj_ancho;
    private $obj_profundidad;

    //////////////////////////////   funciones //////////////////////

    public function carga_gen_codigo($obj_codigo) {
        $this->obj_codigo = $obj_codigo;
    }

    public function carga_gen_nombre($gen_nombre) {
        $this->gen_nombre = $gen_nombre;
    }

    public function carga_gen_fechcreacion($gen_fechcreacion) {
        $this->gen_fechcreacion = $gen_fechcreacion;
    }

    public function carga_gen_fechmodifica($gen_fechmodifica) {
        $this->gen_fechmodifica = $gen_fechmodifica;
    }

    public function carga_gen_usucreacion($gen_usucreacion) {
        $this->gen_usucreacion = $gen_usucreacion;
    }

    public function carga_gen_usumodificacion($gen_usumodificacion) {
        $this->gen_usumodificacion = $gen_usumodificacion;
    }

    public function carga_gen_nombreaplicacion($gen_nombreaplicacion) {
        $this->gen_nombreaplicacion = $gen_nombreaplicacion;
    }

    ////////   insertar género   //////////////////
    public function obj_insertar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $this->carga_gen_codigo($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
        $bd->carga_valores($this->obj_codigo . ",'" . $this->tbc_codigo . "'"); // valores a insertae
        $bd->carga_campos("obj_codigo,tbc_codigo"); // campos a ser insertados
        if ($bd->insertar("_ct_tramite4_objeto")) // insertar
            return 1;  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    //////   actualizar género    ///////////////////
    public function gen_actualizar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();

        $parametros = "gen_nombre = '$this->gen_nombre'";
        $bd->carga_valores("gen_codigo = " . $this->gen_codigo);
        $bd->carga_campos($parametros);
        if ($bd->actualizar("ct_genero"))
            return 1;
        else
            return 0;
        $bd->cerrar();
    }

    //////   seleccionar género    ///////////////////
    public function gen_seleccionar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select gen_codigo, gen_nombre FROM ct_genero WHERE gen_codigo = " . $this->gen_codigo;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }

    /////// ELIMINAR género
    public function gen_eliminar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "DELETE FROM ct_genero WHERE gen_codigo = " . $this->gen_codigo;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    //////   seleccionar género por provincia    ///////////////////
    public function gen_seleccionarpagina($inicio, $pagina) {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select gen_codigo, gen_nombre FROM ct_genero ORDER BY gen_codigo LIMIT ' . $inicio . ',' . $pagina;
        $rsprv = $bd->ejecutar($sql);
        $bd->cerrar();
        return $rsprv;
    }

    //////   seleccionar género por provincia    ///////////////////
    public function gen_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = 'select gen_codigo, gen_nombre FROM ct_genero  ';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    /////////////////////////////    fin de provicnias      ///////////////////////
}

?>