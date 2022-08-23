<?php

Class clsregional {

    private $reg_id;
    private $reg_nombre;
    private $reg_ciudad;
    private $reg_direccion;
    private $reg_provincia;
    private $reg_estado;

    //////////////////////////////   funciones //////////////////////

    public function carga_reg_id($reg_id) {
        $this->reg_id = $reg_id;
    }

    public function carga_reg_nombre($reg_nombre) {
        $this->reg_nombre = $reg_nombre;
    }

    public function carga_reg_direccion($reg_direccion) {
        $this->reg_direccion = $reg_direccion;
    }

    public function carga_reg_provincia($reg_provincia) {
        $this->reg_provincia = $reg_provincia;
    }

    public function carga_reg_ciudad($reg_ciudad) {
        $this->reg_ciudad = $reg_ciudad;
    }

    ////////   insertar cantones   //////////////////
    public function regional_insertar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $this->carga_reg_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en codigo
        $bd->carga_valores($this->reg_id . ",'" . $this->reg_nombre . "','" . $this->reg_direccion . "'"); // valores a insertae
        $bd->carga_campos("reg_id,reg_nombre,reg_direccion"); // campos a ser insertados
        if ($bd->insertar("rg_regional")) // insertar
            return 1;  // exito
        else
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }

    //////   actualizar cantones    ///////////////////
    public function regional_actualizar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();

        $parametros = "reg_nombre = '$this->reg_nombre',reg_ciudad = '$this->reg_ciudad',reg_direccion = '$this->reg_direccion',reg_provincia = '$this->reg_provincia'";
        $bd->carga_valores("reg_id = " . $this->reg_id);
        $bd->carga_campos($parametros);
        if ($bd->actualizar("rg_regional"))
            return 1;
        else
            return 0;
        $bd->cerrar();
    }

    //////   seleccionar cantones    ///////////////////
    public function regional_seleccionar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "select reg_id,reg_nombre,reg_ciudad,reg_direccion,reg_provincia FROM rg_regional WHERE reg_id = " . $this->reg_id;

        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    public function regional_seleccionartodo() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "SELECT * FROM ct_regional ";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    public function regionalSeleccionarActivos() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
//        $sql = "select usu_id, usu_nombre, usu_apellido, usu_direccion FROM ct_usuarios WHERE reg_id='".$regional."' and rol_id='".$perfil."' and usu_estado='ACTIVO'";
        $sql = "SELECT * FROM ct_regional WHERE reg_estado = 'ACT'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

    /////// ELIMINAR PAISES
    public function regional_eliminar() {
        // abro conexión a bases de datos
        $bd = Db::getInstance();
        $sql = "DELETE FROM rg_regional WHERE reg_id = " . $this->reg_id;
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }

}

?>
