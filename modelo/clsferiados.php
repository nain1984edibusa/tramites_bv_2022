<?php
	 
Class clsferiado{	 
    //defino los campos de la tabla usuarios
    private $fer_id;
    private $fer_nombre; //EN LOS USUARIOS EXTERNOS, EL MISMO QUE LA CÉDULA
    private $fer_tipo;
    private $red_id;
    private $fer_fecha_dia;
    private $fer_fecha_mes;
    

    function getFer_id() {
        return $this->fer_id;
    }

    function getFer_nombre() {
        return $this->fer_nombre;
    }

    function getFer_tipo() {
        return $this->fer_tipo;
    }

    function getRed_id() {
        return $this->red_id;
    }

    function getFer_fecha_dia() {
        return $this->fer_fecha_dia;
    }

    function getFer_fecha_mes() {
        return $this->fer_fecha_mes;
    }

    function setFer_id($fer_id): void {
        $this->fer_id = $fer_id;
    }

    function setFer_nombre($fer_nombre): void {
        $this->fer_nombre = $fer_nombre;
    }

    function setFer_tipo($fer_tipo): void {
        $this->fer_tipo = $fer_tipo;
    }

    function setRed_id($red_id): void {
        $this->red_id = $red_id;
    }

    function setFer_fecha_dia($fer_fecha_dia): void {
        $this->fer_fecha_dia = $fer_fecha_dia;
    }

    function setFer_fecha_mes($fer_fecha_mes): void {
        $this->fer_fecha_mes = $fer_fecha_mes;
    }

            	
    ////////   insertar valores    //////////////////
    public function fer_insertar(){
    // abro conexión a bases de datos
        $bd=Db::getInstance();
        //$this->carga_usu_id($bd->lastID()); // sacar el siguiente registro de la tabla y lo cargo en id
        $bd->carga_valores("'".$this->getFer_nombre()."','".$this->getFer_tipo()."','".$this->getRed_id()."','".$this->getFer_fecha_dia()."','".$this->getFer_fecha_mes()."'"); // valores a insertae
        $bd->carga_campos("fer_nombre,fer_tipo,reg_id,fer_fecha_dia,fer_fecha_mes"); // campos a ser insertados
        
        //mysqli_query($bd, $query)
        //$last_id = mysqli_insert_id($bd);
        
        if($bd->insertar("ct_feriados")) {// insertar
            return $bd->lastID();  // exito
            //echo "carga exitosa"; 
        }
        else 
            return 0;  // error
        $bd->cerrar();  // cerrar coneccion
    }
	
    //////   actualizar usuarios    ///////////////////
    public function fer_actualizar(){
        // abro conexi�n a bases de datos
        $bd=Db::getInstance();

        $parametros ="fer_nombre = '".$this->getFer_nombre()."', fer_tipo = '".$this->getFer_tipo()."',reg_id ='".$this->getRed_id()."',fer_fecha_dia='".$this->getFer_fecha_dia()."',fer_fecha_mes='".$this->getFer_fecha_mes()."'";
        $bd->carga_valores("fer_id = '".$this->getFer_id()."'");
        $bd->carga_campos($parametros);
       // echo $parametros;

        if($bd->actualizar("ct_feriados"))
          return 1;
        else 
          return 0;  
        $bd->cerrar();
    }

    /////// ELIMINAR 
    public function fer_eliminar(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "DELETE FROM ct_feriados WHERE usu_id = fer_id = ' ".$this->getFer_id()."'";
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }


    public function fer_seleccionartodo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = 'SELECT *FROM ct_feriados';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    public function fer_seleccionarByCodigo(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = 'SELECT *FROM ct_feriados fer 
                INNER JOIN ct_feriados_anio fea
                ON fer.fer_id = fea.fer_id WHERE fer.fer_id = '.$this->getFer_id().';';
        $rsprv = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $rsprv;
    }
    
    public function extraerFechasInicioFin(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "(SELECT fer.fer_nombre, fea.fea_fecha FROM ct_feriados as fer   
                JOIN ct_feriados_anio as fea
                ON fer.fer_id = fea.fer_id AND fer.fer_id = '".$this->getFer_id()."' 
                ORDER BY fea.fea_fecha ASC LIMIT 1)
                UNION
                (SELECT fer.fer_nombre, fea.fea_fecha FROM ct_feriados as fer   
                JOIN ct_feriados_anio as fea
                ON fer.fer_id = fea.fer_id AND fer.fer_id = '".$this->getFer_id()."' 
                ORDER BY fea.fea_fecha DESC LIMIT 1)";
        //echo $sql;
        $resultQuery = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $resultQuery;
    }
    public function extraerFechaInicio(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "SELECT fea_fecha FROM ct_feriados_anio where fer_id = '".$this->getFer_id()."' ORDER BY fea_fecha ASC LIMIT 1
                ";
        //echo $sql;
        $resultQuery = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $resultQuery;
    }
    public function extraerFechaFin(){
        // abro conexión a bases de datos
        $bd=Db::getInstance();
        $sql = "SELECT fea_fecha FROM ct_feriados_anio where fer_id = '".$this->getFer_id()."' ORDER BY fea_fecha DESC LIMIT 1";
        //echo $sql;
        $resultQuery = $bd->ejecutar($sql);
        //$bd->cerrar();
        return $resultQuery;
    }

}
?>