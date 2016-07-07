<?php
//require_once ("../require/conexion_class.php");

class measurement {
    private $_conexion;
    
    public function __construct(){
        $this->_conexion = new conexion();
    }
    
    public function pushMeasure ($idSensor, $value){
        $sql = "INSERT INTO Measurement (`id_measurement`, `id_sensor`, `date`, `value`) VALUES (NULL, ".$idSensor.", CURRENT_TIMESTAMP, ".$value.");";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}

?>
