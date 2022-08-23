<?php
	 
Class clsferiadosanio extends clsferiado{	 
    //defino los campos de la tabla usuarios
    private $fea_id;        
    private $fea_fecha;
    private $fea_anio;
    
    function getFea_id() {
        return $this->fea_id;
    }

    function getFea_fecha() {
        return $this->fea_fecha;
    }

    function getFea_anio() {
        return $this->fea_anio;
    }

    function setFea_id($fea_id): void {
        $this->fea_id = $fea_id;
    }

    function setFea_fecha($fea_fecha): void {
        $this->fea_fecha = $fea_fecha;
    }

    function setFea_anio($fea_anio): void {
        $this->fea_anio = $fea_anio;
    }

                	
    ////////   insertar valores    //////////////////
    public function fea_insertar(){
    // abro conexión a bases de datos
        $bd=Db::getInstance();
        //$this->carga_usu_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->getFea_fecha()."','".$this->getFea_anio()."','".$this->getFer_id()."'"); // valores a insertae
        $bd->carga_campos("fea_fecha,fea_anio,fer_id"); // campos a ser insertados
        if($bd->insertar("ct_feriados_anio")) {// insertar
            return 1;  // exito
            //echo "carga exitosa"; 
        }
        else 
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
	
    //////   actualizar usuarios    ///////////////////
    public function fea_actualizar(){
        // abro conexi�n a bases de datos
        $bd=Db::getInstance();

        $parametros ="fea_fecha = '".$this->getFea_fecha()."', "
                . "fea_anio = '".$this->getFea_anio()."',"
                . "fer_id = '".$this->getFer_id()."'";                                    
        $bd->carga_valores("fer_id = '".$this->getFer_id()."'");
        $bd->carga_campos($parametros);
       // echo $parametros;

        if($bd->actualizar("ct_feriados_anio"))
          return 1;
        else 
          return 0;  
        $bd->cerrar();
    }
	
    /////// ELIMINAR 
    public function fea_eliminar(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "DELETE FROM ct_feriados_anio WHERE fer_id = '".$this->getFer_id()."'";
        $bd->ejecutar($sql);
        //$bd->cerrar();
        //return $rsprv;
    }
    
    public function seleccion_todo() {
        $bd=Db::getInstance();
        $sql = "SELECT *FROM ct_feriados_anio where fer_id = '".$this->getFer_id()."'";
        $resultQuery = $bd->ejecutar($sql);
        return $resultQuery;        
    }
	

}
?>